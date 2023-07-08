<!DOCTYPE html>
<html lang="pl" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<h4>Użytkownicy z bazy</h4>
<?php
require_once '../scripts/connect.php';
$sql = "SELECT * FROM `users`;";
$result = $conn->query($sql);
//$user = $result->fetch_assoc();
//echo $user["username"];

while ($user = $result->fetch_assoc()) {
    echo <<< USER
      Imię i nazwisko: $user[username] $user[lastname]<br>
USER;
}
$conn->close();
?>
</body>
</html>
