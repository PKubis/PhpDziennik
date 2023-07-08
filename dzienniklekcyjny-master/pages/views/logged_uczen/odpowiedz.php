<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard 2</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../css/table.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="../../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dzienniczek Ucznia:</h1>
                        <div class="info">
                            <?php echo $_SESSION["logged"]["firstName"] . " " . $_SESSION["logged"]["lastName"] ?>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">
                                        <h4>Mój podgląd ocen</h4>
                                        <?php
                                        require_once "../../../scripts/connect.php";

                                        // Sprawdzenie, czy zalogowany użytkownik ma rolę "logged_nauczyciel" lub "logged_uczen"
                                        if ($_SESSION["logged"]["role_id"] == 1) {
                                            $loggedUserId = $_SESSION["logged"]["userId"];

                                            $sql = "SELECT u.firstName, u.lastName, o.ocena, o.data_modyfikacji
                FROM users u
                JOIN odpowiedz o ON u.id = o.user_id
                WHERE u.id = $loggedUserId;";

                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                echo "<table>";
                                                echo "<tr>
                                                    <th>Imię</th>
                                                    <th>Nazwisko</th>
                                                    <th>Odpowiedź</th>
                                                 <th>Data wystawienia</th>
                                                </tr>";
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row["firstName"] . "</td>";
                                                    echo "<td>" . $row["lastName"] . "</td>";
                                                    echo "<td>" . $row["ocena"] . "</td>";
                                                    echo "<td>" . $row["data_modyfikacji"] . "</td>";


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
                                        <?php
                                        require_once __DIR__ . "/../logged_uczen/aside_uczen.php";
                                        ?>
                                        <?php
                                        require_once __DIR__ . "/navbar.php";
                                        ?>
                                    </div>
                                </div><!-- /.card -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>Iza, Marcin, Piotr <a href="https://github.com/kurasmarcin/dzienniklekcyjny/tree/master" target="_blank">Nasze Repozytorium</a>. </strong> Praca dzięki Admin_LTE.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Wersja</b> 5.8.9
                </div>
            </footer>
        </section><!-- /.content -->
    </div><!-- /.wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- jQuery -->
    <script src="../../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../../dist/js/demo.js"></script>
</body>

</html>