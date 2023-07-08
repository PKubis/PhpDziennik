<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dzienniczek Ucznia:</h1>
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
                                    <h3 class="card-title">Wszystkie oceny</h3>
                                </div>
                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                    <link rel="stylesheet" href="../css/table.css">
                                    <title>Użytkownicy</title>
                                </head>
                                <body>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <h4>Mój podgląd ocen</h4>
                                    <?php
                                    require_once "../scripts/connect.php";

                                    // Sprawdzenie, czy zalogowany użytkownik ma rolę "logged_nauczyciel" lub "logged_uczen"
                                    if ($_SESSION["logged"]["role_id"] == 1 ) {
                                        $loggedUserId = $_SESSION["logged"]["userId"];

                                        $sql = "SELECT
                                                    u.id,
                                                    u.firstName AS imie,
                                                    u.lastName AS nazwisko,
                                                    u.email,
                                                    k.ocena AS ocena_kartkowki,
                                                    s.ocena AS ocena_sprawdzianu,
                                                    o.ocena AS ocena_odpowiedzi,
                                                    AVG((k.ocena + s.ocena + o.ocena)/3) AS srednia
                                                FROM
                                                    users u
                                                LEFT JOIN
                                                    kartkowka k ON u.id = k.user_id
                                                LEFT JOIN
                                                    sprawdzian s ON u.id = s.user_id
                                                LEFT JOIN
                                                    odpowiedz o ON u.id = o.user_id
                                                WHERE
                                                    u.id = $loggedUserId
                                                GROUP BY
                                                    u.id";

                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            echo "<table>";
                                            echo "<tr>
                                                    <th>Imię</th>
                                                    <th>Nazwisko</th>
                                                    <th>Kartkówka</th>
                                                    <th>Sprawdzian</th>
                                                    <th>Odpowiedź</th>
                                                    <th>Średnia</th>
                                                    <th>Email</th>
                                                 
                                                </tr>";
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["imie"] . "</td>";
                                                echo "<td>" . $row["nazwisko"] . "</td>";
                                                echo "<td>" . $row["ocena_kartkowki"] . "</td>";
                                                echo "<td>" . $row["ocena_sprawdzianu"] . "</td>";
                                                echo "<td>" . $row["ocena_odpowiedzi"] . "</td>";
                                                echo "<td>" . round($row["srednia"], 2) . "</td>";
                                                echo "<td>" . $row["email"] . "</td>";

                                                echo "</tr>";
                                            }
                                            echo "</table>";
                                        } else {
                                            echo "<p>Brak danych do wyświetlenia.</p>";
                                        }
                                    } else {
                                        echo "<p>Nie masz uprawnień do wyświetlenia tych informacji.</p>";
                                    }
                                    ?>

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
<footer class="main-footer">
    <strong>Iza, Marcin, Piotr <a href="https://github.com/kurasmarcin/dzienniklekcyjny/tree/master" target="_blank">Nasze Repozytorium</a>. </strong> Praca dzięki Admin_LTE. <div class="float-right d-none d-sm-inline-block">
        <b>Wersja</b> 5.8.9
    </div>
</footer>
</div>
<!-- ./wrapper -->
</body>
</html>
