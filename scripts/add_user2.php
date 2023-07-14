<?php
session_start();

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        echo "<script>history.back();</script>";
        $_SESSION["error"] = "Wypełnij wszystkie pola np. $key";
        exit();
    }
}

require_once "../scripts/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $haslo = $_POST["haslo"];
    $email = $_POST["email"];
    $role_id = 2;
    $hashedPassword = password_hash($haslo, PASSWORD_DEFAULT);


    $sql = "INSERT INTO users (firstName, lastName, email, password, role_id) VALUES ('$imie', '$nazwisko', '$email', '$hashedPassword','2')";
    $result = $conn->query($sql);

    if ($conn->affected_rows != 0) {
        $_SESSION["error"] = "Prawidłowo dodano użytkownika $imie $nazwisko";
    } else {
        $_SESSION["error"] = "Nie dodano użytkownika!";
    }

    header("location: ../pages/logged.php");
}

$conn->close();
?>
