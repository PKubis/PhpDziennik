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
        <th>Kartkówka</th>
        <th>Sprawdzian</th>
        <th>Odpowiedź</th>
        <th>Średnia</th>
        <th>Email</th>
    </tr>

    <?php
    require_once "../scripts/connect.php";
    $sql = "SELECT\n"

        . "  u.firstName AS imie,\n"

        . "  u.lastName AS nazwisko,\n"

        . "  u.email,\n"

        . "  k.ocena AS ocena_kartkowki,\n"

        . "  s.ocena AS ocena_sprawdzianu,\n"

        . "  o.ocena AS ocena_odpowiedzi,\n"

        . "  ROUND((COALESCE(k.ocena, 0) + COALESCE(s.ocena, 0) + COALESCE(o.ocena, 0)) / (\n"

        . "    CASE WHEN k.ocena IS NULL THEN 0 ELSE 1 END +\n"

        . "    CASE WHEN s.ocena IS NULL THEN 0 ELSE 1 END +\n"

        . "    CASE WHEN o.ocena IS NULL THEN 0 ELSE 1 END\n"

        . "  ), 1) AS srednia_ocen\n"

        . "FROM\n"

        . "  users AS u\n"

        . "LEFT JOIN\n"

        . "  kartkowka AS k ON u.id = k.user_id\n"

        . "LEFT JOIN\n"

        . "  sprawdzian AS s ON u.id = s.user_id\n"

        . "LEFT JOIN\n"

        . "  odpowiedz AS o ON u.id = o.user_id\n"

        . "WHERE\n"

        . "  u.role_id = 1;";
    $result = $conn->query($sql);
    while($user = $result->fetch_assoc()){
        echo <<< TABLEUSERS
      <tr>
        <td>$user[imie]</td>
        <td>$user[nazwisko]</td>
        <td>$user[ocena_kartkowki]</td>
        <td>$user[ocena_sprawdzianu]</td>
        <td>$user[ocena_odpowiedzi]</td>
        <td>$user[srednia_ocen]</td>
        <td>$user[email]</td>
     
      </tr>
TABLEUSERS;
    }
    echo "</table>";
    $conn->close();
    ?>
</body>
</html>

