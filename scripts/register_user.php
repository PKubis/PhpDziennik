<?php
session_start();

foreach ($_POST as $value) {
    if (empty($value)) {
        $_SESSION["error"] = "Wypełnij wszystkie pola!";
        echo "<script>history.back()</script>";
        exit();
    }
}

$error = 0;

if (!isset($_POST["terms"])) {
    $_SESSION["error"] = "Potwierdź, że nie jesteś robotem!";
    $error = 1;
}

if (empty($_POST["pass1"]) || empty($_POST["pass2"])) {
    $_SESSION["error"] = "Wprowadź hasło w oba pola!";
    $error = 1;
}

$password = $_POST["pass1"];

if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password)) {
    $_SESSION["error"] = "Hasło musi mieć co najmniej 8 znaków i zawierać co najmniej jedną dużą literę, jedną małą literę i jedną cyfrę!";
    $error = 1;
}

if ($_POST["pass1"] != $_POST["pass2"]) {
    $_SESSION["error"] = "Hasła są różne!";
    $error = 1;
}

if ($error != 0) {
    echo "<script>history.back()</script>";
    exit();
}

require_once "./connect.php";

try {
    $stmt = $conn->prepare("INSERT INTO `users` (`id`, `email`, `firstName`, `lastName`,  `password`, `created_at`) VALUES (?, ?, ?, ?, ?, current_timestamp())");

    $pass = password_hash($_POST["pass1"], PASSWORD_ARGON2ID);

    $stmt->bind_param("sssss", $_POST["id"], $_POST["email1"], $_POST["firstName"], $_POST["lastName"],  $pass);

    $stmt->execute();

    if ($stmt->affected_rows == 1) {
        $user_id = $stmt->insert_id;

        // Insert record into odpowiedz table
        $stmt_odpowiedz = $conn->prepare("INSERT INTO odpowiedz (user_id, ocena,data_modyfikacji) VALUES (?, NULL, NULL)");
        $stmt_odpowiedz->bind_param("i", $user_id);
        $stmt_odpowiedz->execute();

        // Insert record into sprawdzian table
        $stmt_sprawdzian = $conn->prepare("INSERT INTO sprawdzian (user_id, ocena,  data_modyfikacji) VALUES (?, NULL, NULL)");
        $stmt_sprawdzian->bind_param("i", $user_id);
        $stmt_sprawdzian->execute();

        // Insert record into kartkowka table
        $stmt_kartkowka = $conn->prepare("INSERT INTO kartkowka (user_id, ocena,  data_modyfikacji) VALUES (?, NULL, NULL)");
        $stmt_kartkowka->bind_param("i", $user_id);
        $stmt_kartkowka->execute();

        $_SESSION["success"] = "Prawidłowo dodano użytkownika $_POST[firstName] $_POST[lastName]";
        header("location: ../pages");
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION["error"] = "Błędne dane: " . $e->getMessage();
    echo "<script>history.back()</script>";
    exit();
}
?>