<?php
session_start();



require_once '../scripts/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $firstName = $_POST['imie'];
    $lastName = $_POST['nazwisko'];
    $ocena_kartkowki = $_POST['ocena_kartkowki'];
    $ocena_sprawdzianu = $_POST['ocena_sprawdzianu'];
    $ocena_odpowiedzi = $_POST['ocena_odpowiedzi'];
    $email = $_POST['email'];

    // Sprawdzenie czy wprowadzone oceny mieszczą się w przedziale od 1 do 6 lub są równa null
    if (($ocena_kartkowki != null && ($ocena_kartkowki < 1 || $ocena_kartkowki > 6)) ||
        ($ocena_sprawdzianu != null && ($ocena_sprawdzianu < 1 || $ocena_sprawdzianu > 6)) ||
        ($ocena_odpowiedzi != null && ($ocena_odpowiedzi < 1 || $ocena_odpowiedzi > 6))) {
        $_SESSION['error'] = "Wprowadź oceny w przedziale od 1 do 6 lub zostaw pole oceny puste.";
        header("location: ../pages/logged.php");
        exit();
    }


    // Aktualizacja użytkownika w bazie danych
    $updateUserSql = "UPDATE users
                      SET firstName='$firstName', lastName='$lastName', email='$email' 
                      WHERE id=$userId";
    if ($conn->query($updateUserSql) === TRUE) {
        // Pobranie dotychczasowych ocen i dat modyfikacji
        $getOcenySql = "SELECT kartkowka.ocena AS ocena_kartkowki, sprawdzian.ocena AS ocena_sprawdzianu, odpowiedz.ocena AS ocena_odpowiedzi
                        FROM users
                        LEFT JOIN kartkowka ON users.id = kartkowka.user_id
                        LEFT JOIN sprawdzian ON users.id = sprawdzian.user_id
                        LEFT JOIN odpowiedz ON users.id = odpowiedz.user_id
                        WHERE users.id = $userId";
        $result = $conn->query($getOcenySql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ocena_kartkowki_dotychczasowa = $row['ocena_kartkowki'];
            $ocena_sprawdzianu_dotychczasowa = $row['ocena_sprawdzianu'];
            $ocena_odpowiedzi_dotychczasowa = $row['ocena_odpowiedzi'];

            // Aktualizacja oceny kartkówki, jeśli różni się od dotychczasowej
            if ($ocena_kartkowki != $ocena_kartkowki_dotychczasowa) {
                $updateKartkowkaSql = "UPDATE kartkowka
                                       SET ocena=$ocena_kartkowki, data_modyfikacji=NOW()
                                       WHERE user_id=$userId";
                $conn->query($updateKartkowkaSql);
            }

            // Aktualizacja oceny sprawdzianu, jeśli różni się od dotychczasowej
            if ($ocena_sprawdzianu != $ocena_sprawdzianu_dotychczasowa) {
                $updateSprawdzianSql = "UPDATE sprawdzian
                                        SET ocena=$ocena_sprawdzianu, data_modyfikacji=NOW()
                                        WHERE user_id=$userId";
                $conn->query($updateSprawdzianSql);
            }

            // Aktualizacja oceny odpowiedzi, jeśli różni się od dotychczasowej
            if ($ocena_odpowiedzi != $ocena_odpowiedzi_dotychczasowa) {
                $updateOdpowiedzSql = "UPDATE odpowiedz
                                       SET ocena=$ocena_odpowiedzi, data_modyfikacji=NOW()
                                       WHERE user_id=$userId";
                $conn->query($updateOdpowiedzSql);
            }

            // Jeśli wszystkie oceny są takie same, nie zmieniaj daty modyfikacji
            if ($ocena_kartkowki == $ocena_kartkowki_dotychczasowa &&
                $ocena_sprawdzianu == $ocena_sprawdzianu_dotychczasowa &&
                $ocena_odpowiedzi == $ocena_odpowiedzi_dotychczasowa) {
                $updateUserSql = "UPDATE users
                                  SET firstName='$firstName', lastName='$lastName', email='$email' 
                                  WHERE id=$userId";
                $conn->query($updateUserSql);
            }

            $_SESSION['success'] = "Użytkownik został zaktualizowany.";
        }
    } else {
        $_SESSION['error'] = "Błąd podczas aktualizacji użytkownika: " . $conn->error;
    }

    $conn->close();
    header("location: ../pages/logged.php");
    exit();
}
?>
