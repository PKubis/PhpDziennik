<?php
session_start();

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        echo "<script>history.back();</script>";
        $_SESSION["error"] = "Wypełnij wszystkie pola, np. $key";
        exit();
    }
}

require_once "../scripts/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["imie"];
    $lastName = $_POST["nazwisko"];
    $password = $_POST["haslo"];
    $email = $_POST["email"];


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$hashedPassword')";
    $conn->query($sql);

    if ($conn->affected_rows != 0) {

        $userId = $conn->insert_id;


        $kartkowkaSql = "INSERT INTO kartkowka (user_id, data_modyfikacji) VALUES ('$userId', NULL)";
        $conn->query($kartkowkaSql);


        $sprawdzianSql = "INSERT INTO sprawdzian (user_id, data_modyfikacji) VALUES ('$userId', NULL)";
        $conn->query($sprawdzianSql);


        $odpowiedzSql = "INSERT INTO odpowiedz (user_id, data_modyfikacji) VALUES ('$userId', NULL)";
        $conn->query($odpowiedzSql);

        if ($conn->affected_rows != 0) {
            $_SESSION["error"] = "Prawidłowo dodano użytkownika $firstName $lastName";
        }
    } else {
        $_SESSION["error"] = "Nie dodano użytkownika!";
    }
}


$sql = "SELECT id, firstName, lastName FROM users";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Imię</th><th>Nazwisko</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["firstName"] . "</td>";
        echo "<td>" . $row["lastName"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Brak danych do wyświetlenia.";
}

$conn->close();

header("location: ../pages/logged.php");
exit();
?>
