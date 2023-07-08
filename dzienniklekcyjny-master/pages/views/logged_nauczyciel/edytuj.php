<?php
require_once "../scripts/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'];
    $kartkowka = $_POST['kartkowka'];
    $sprawdzian = $_POST['sprawdzian'];
    $odpowiedz = $_POST['odpowiedz'];

    // Aktualizacja ocen w bazie danych
    $updateQuery = "UPDATE kartkowka SET ocena = :kartkowka WHERE user_id = :userId";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':kartkowka', $kartkowka);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    $updateQuery = "UPDATE sprawdzian SET ocena = :sprawdzian WHERE user_id = :userId";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':sprawdzian', $sprawdzian);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    $updateQuery = "UPDATE odpowiedz SET ocena = :odpowiedz WHERE user_id = :userId";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':odpowiedz', $odpowiedz);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    // Przekierowanie z powrotem do strony z ocenami
    header("Location: ./content.php");
    exit();
}

$conn = null;
?>
