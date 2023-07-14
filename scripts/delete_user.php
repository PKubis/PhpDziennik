<?php
require_once "../scripts/connect.php";
session_start();

if (isset($_GET['userIdDelete'])) {
    $id = $_GET['userIdDelete'];

    // Sprawdzenie, czy użytkownik o ID 8 jest usuwany
    if ($id == 8) {
        header("location: ../db_export/5_dbtable_usun_add_update.php?userDelete=0");
        exit();
    }


    $deleteKartkowkaSql = "DELETE FROM kartkowka WHERE user_id = $id";
    $conn->query($deleteKartkowkaSql);


    $deleteOdpowiedzSql = "DELETE FROM odpowiedz WHERE user_id = $id";
    $conn->query($deleteOdpowiedzSql);

    $deleteSprawdzianSql = "DELETE FROM sprawdzian WHERE user_id = $id";
    $conn->query($deleteSprawdzianSql);

    $deleteUserSql = "DELETE FROM users WHERE id = $id";
    if ($conn->query($deleteUserSql) === TRUE) {
        if ($conn->affected_rows != 0) {
            unset($_SESSION['users'][$id]);

            echo "<h4>Użytkownik  został usunięty.</h4>";
        } else {
            echo "<h4>Nie udało się usunąć użytkownika.</h4>";
        }
    }

    header("location: ../pages/logged.php?userDelete=$id");
    exit();
} else {
    header("location: ../pages/logged.php?userDelete=0");
    exit();
}

$conn->close();
?>
