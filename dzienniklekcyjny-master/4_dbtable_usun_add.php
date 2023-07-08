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
if (isset($_GET["userIdDelete"])) {
    if ($_GET["userIdDelete"] == 0) {
        echo "<h4>Nie usunięto użytkownika!</h4>";
    } else {
        echo "<h4>Usunięto użytkownika o id={$_GET['userIdDelete']}</h4>";
    }
}
if (isset($_SESSION["error"])) {
    echo "<h4>{$_SESSION['error']}</h4>";
    unset($_SESSION["error"]);
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

if ($result->num_rows == 0) {
    echo "<tr><td colspan='4'>Brak rekordów do wyświetlenia</td></tr>";
} else {
    while ($user = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$user['imie']}</td>";
        echo "<td>{$user['nazwisko']}</td>";
        echo "<td>{$user['role']}</td>";
        echo "<td><a href='../scripts/usun.php?userIdDelete=".$user['id']."'>Usuń</a></td>";
        echo "</tr>";
    }
}
echo "</table>";



    echo "</table>";

    if (isset($_GET["addUser"])){
        echo <<< ADDUSERFORM
            <h4>Dodawanie użytkownika</h4>
            <form action="../scripts/add_user.php" method="post">
                <input type="text" name="imie" placeholder="Podaj imię" autofocus><br><br>
                <input type="text" name="nazwisko" placeholder="Podaj nazwisko"><br><br>
                <input type="text" name="hasło" placeholder="Podaj hasło"<br><br>
                <label for="role">Rola:</label>
                <select name="role" id="role" required>
                    <option value="" selected disabled>Wybierz rolę</option>
                    <option value="student">Student</option>
                    <option value="teacher">Nauczyciel</option>
                    <option value="admin">Administrator</option>
                </select><br><br>
                <input type="submit" value="Dodaj użytkownika">
            </form>
ADDUSERFORM;
    }else{
        echo '<a href="./4_dbtable_usun_add.php?addUser=1">Dodaj użytkownika</a>';
    }

    $conn->close();

    ?>
</body>
</html>