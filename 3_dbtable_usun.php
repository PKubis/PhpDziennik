<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/table.css">
    <title>Użytkownicy</title>
</head>
<body>
<h4>Użytkownicy</h4>
<?php
if (isset($_GET["userDelete"])){
    if ($_GET["userDelete"] == 0){
        echo "<h4>Nie usunięto użytkownika!</h4>";
    }else{
        echo "<h4>Usunięto użytkownika o id=$_GET[userDelete]</h4>";
    }
}
?>
<table>
    <tr>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Rola</th>
        <th>Akcje</th>
    </tr>
    <?php
    require_once "../scripts/connect.php";
    $sql = "SELECT id, username as 'imie', lastname as 'nazwisko', role FROM users;";
    $result = $conn->query($sql);

    if ($result->num_rows == 0){
        echo "<tr><td colspan='3'>Brak rekordów do wyświetlenia</td></tr>";
    }else{
        while($user = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$user['imie']."</td>";
            echo "<td>".$user['nazwisko']."</td>";
            echo "<td>".$user['role']."</td>";
            echo "<td><a href='../scripts/usun.php?userIdDelete=".$user['id']."'>Usuń</a></td>";
            echo "</tr>";
        }
    }

    $conn->close();
    ?>
</table>
</body>
</html>