<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "connect.php";

    $userId = $_POST["userId"];
    $kartkowkaOcena = $_POST["kartkowkaOcena"];
    $sprawdzianOcena = $_POST["sprawdzianOcena"];
    $ocena = $_POST["ocena"];

    // Update grades in the database
    $sql = "UPDATE kartkowka SET ocena='$kartkowkaOcena' WHERE user_id=$userId";
    $conn->query($sql);

    $sql = "UPDATE sprawdzian SET ocena='$sprawdzianOcena' WHERE user_id=$userId";
    $conn->query($sql);

    $sql = "UPDATE odpowiedz SET ocena='$ocena' WHERE user_id=$userId";
    $conn->query($sql);

    if ($conn->affected_rows > 0) {
        $_SESSION["success"] = "Oceny zostały zaktualizowane.";
    } else {
        $_SESSION["error"] = "Błąd podczas aktualizacji ocen.";
    }

    $conn->close();
    header("location: ../db_export/5_dbtable_usun_add_update.php");
    exit();
}
?>