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
<table>
    <tr>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Rola</th>
    </tr>

    <?php
    require_once "../scripts/connect.php";
    $sql = "SELECT id, username as 'imie',lastname as 'nazwisko', role FROM users;";
    $result = $conn->query($sql);
    while($user = $result->fetch_assoc()){
        echo <<< TABLEUSERS
      <tr>
        <td>$user[imie]</td>
        <td>$user[nazwisko]</td>
        <td>$user[role]</td>
     
      </tr>
TABLEUSERS;
    }
    echo "</table>";
    $conn->close();
    ?>
</body>
</html>

