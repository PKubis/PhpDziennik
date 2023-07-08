<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dziennik Nauczyciela:</h1>
                    <div class="info">
                        <span href="#" class="accent-green"> <?php echo $_SESSION["logged"]["firstName"]." ".$_SESSION["logged"]["lastName"] ?> </span>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"></ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Podgląd</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!doctype html>
                                    <html lang="pl">
                                    <head>
                                        <meta charset="UTF-8">
                                        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                        <link rel="stylesheet" href="../css/table.css">
                                        <title>Użytkownicy</title>
                                    </head>
                                    <body>
                                    <h4>Wszyscy Uczniowie</h4>
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
                                            <th>Kartkówka</th>
                                            <th>Sprawdzian</th>
                                            <th>Odpowiedź</th>
                                            <th>Średnia</th>
                                            <th>Email</th>
                                            <th>Akcje</th>
                                        </tr>
                                        <?php
                                        require_once "../scripts/connect.php";

                                        $userId = $_SESSION["logged"]["userId"]; // Pobieramy ID zalogowanego użytkownika

                                        $sql = "SELECT\n"
                                            . "  u.id,\n"
                                            . "  u.firstName AS imie,\n"
                                            . "  u.lastName AS nazwisko,\n"
                                            . "  u.email,\n"
                                            . "  k.ocena AS ocena_kartkowki,\n"
                                            . "  s.ocena AS ocena_sprawdzianu,\n"
                                            . "  o.ocena AS ocena_odpowiedzi,\n"
                                            . "  AVG((k.ocena + s.ocena + o.ocena)/3) AS srednia\n"
                                            . "FROM\n"
                                            . "  users u\n"
                                            . "LEFT JOIN\n"
                                            . "  kartkowka k ON u.id = k.user_id\n"
                                            . "LEFT JOIN\n"
                                            . "  sprawdzian s ON u.id = s.user_id\n"
                                            . "LEFT JOIN\n"
                                            . "  odpowiedz o ON u.id = o.user_id\n"
                                            . "WHERE\n"
                                            . "  u.id = $userId\n"  // Wykorzystujemy ID zalogowanego użytkownika
                                            . "GROUP BY\n"
                                            . "  u.id";

                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["imie"] . "</td>";
                                                echo "<td>" . $row["nazwisko"] . "</td>";
                                                echo "<td>" . $row["ocena_kartkowki"] . "</td>";
                                                echo "<td>" . $row["ocena_sprawdzianu"] . "</td>";
                                                echo "<td>" . $row["ocena_odpowiedzi"] . "</td>";
                                                echo "<td>" . round($row["srednia"], 2) . "</td>";
                                                echo "<td>" . $row["email"] . "</td>";
                                                echo "<td><a href='edit.php?userId=" . $row["id"] . "'>Edytuj</a> | <a href='delete.php?userId=" . $row["id"] . "'>Usuń</a></td>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>

                                    </table>
                                    <p><a href="add.php">Dodaj użytkownika</a></p>
                                    </body>
                                    </html>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<?php
require_once "../footer.php";
?>
</footer>
</div>
<!-- ./wrapper -->
</body>
</html>
