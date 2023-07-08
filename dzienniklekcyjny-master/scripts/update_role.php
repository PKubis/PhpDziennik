<?php
session_start();

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        echo "<script>history.back();</script>";
        $_SESSION['error'] = "Wypełnij wszystkie pola, np. $key";
        exit();
    }
}

require_once '../scripts/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $firstName = $_POST['imie'];
    $lastName = $_POST['nazwisko'];
    $role = $_POST['role'];
    $ocena_kartkowki = $_POST['ocena_kartkowki'];
    $ocena_sprawdzianu = $_POST['ocena_sprawdzianu'];
    $ocena_odpowiedzi = $_POST['ocena_odpowiedzi'];
    $email = $_POST['email'];

    // Sprawdzenie czy wprowadzone oceny mieszczą się w przedziale od 1 do 6
    if ($ocena_kartkowki < 1 || $ocena_kartkowki > 6 || $ocena_sprawdzianu < 1 || $ocena_sprawdzianu > 6 || $ocena_odpowiedzi < 1 || $ocena_odpowiedzi > 6) {
        $_SESSION['error'] = "Wprowadź oceny w przedziale od 1 do 6.";
        header("location: ../pages/logged.php");
        exit();
    }

    // Aktualizacja użytkownika w bazie danych
    $updateUserSql = "UPDATE users
                      SET firstName='$firstName', lastName='$lastName', email='$email', role_id='$role'
                      WHERE id=$userId";
    if ($conn->query($updateUserSql) === TRUE) {
        // Aktualizacja oceny kartkówki
        $updateKartkowkaSql = "UPDATE kartkowka
                               SET ocena=$ocena_kartkowki
                               WHERE user_id=$userId";
        $conn->query($updateKartkowkaSql);

        // Aktualizacja oceny sprawdzianu
        $updateSprawdzianSql = "UPDATE sprawdzian
                                SET ocena=$ocena_sprawdzianu
                                WHERE user_id=$userId";
        $conn->query($updateSprawdzianSql);

        // Aktualizacja oceny odpowiedzi
        $updateOdpowiedzSql = "UPDATE odpowiedz
                               SET ocena=$ocena_odpowiedzi
                               WHERE user_id=$userId";
        $conn->query($updateOdpowiedzSql);

        $_SESSION['success'] = "Użytkownik został zaktualizowany.";
    } else {
        $_SESSION['error'] = "Błąd podczas aktualizacji użytkownika: " . $conn->error;
    }

    $conn->close();
    header("location: ../pages/logged.php");
    exit();
}
?>