<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dziennik Nauczyciela:</h1>
                    <div class="info">
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <?php
    session_start();
    if (!isset($_SESSION["logged"]) || $_SESSION["logged"]["session_id"] != session_id() || session_status() != 2) {
        $_SESSION["error"] = "Zaloguj się!";
        header("location: ./");
    } else {
        switch ($_SESSION["logged"]["role_id"]) {
            case 1:
                $role = "logged_uczen";
                break;
            case 2:
                $role = "logged_nauczyciel";
                break;
            case 3:
                $role = "logged_admin";
                break;
        }
    }


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

    </head>
    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content1-center align-items-center">
            <img class="animation__wobble" src="../../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="128" width="128">
        </div>

        <!-- Navbar -->
        <?php
        require_once __DIR__ . "/navbar.php";
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        require_once __DIR__ . "/../$role/aside_admin.php";
        ?>

        <!-- Content Wrapper. Contains page content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">


                                    </div>

                                    <!-- /.card-header -->
                                    <table class="card-body">

                                        <form method="post" action="">
                                            <div class="form-group">


                                            </div>

                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>

        <!doctype html>
        <html lang="pl">
        <head>

            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="../../../css/table.css">
            <title>Użytkownicy</title>
        </head>
        <body>
        <h4>Podgląd nauczycieli</h4>
        <?php
        require_once "../../../scripts/connect.php";

        $sql = "SELECT u.firstName, u.lastName, u.email, r.role AS role\n"

            . "FROM users u\n"

            . "JOIN roles r ON u.role_id = r.id\n"

            . "WHERE u.role_id = 2;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>Imię</th>";
            echo "<th>Nazwisko</th>";
            echo "<th>Rola</th>";
            echo "<th>Email</th>";
            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['firstName'] . "</td>";
                echo "<td>" . $row['lastName'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Brak rekordów do wyświetlenia";
        }
        ?>

        </table>
        <?php
        if (isset($_GET["userIdUpdate"])) {
            $userId = $_GET["userIdUpdate"];
            $sql = "SELECT u.*, k.ocena AS ocena_kartkowki, s.ocena AS ocena_sprawdzianu, o.ocena AS ocena_odpowiedzi
        FROM users AS u
        LEFT JOIN kartkowka AS k ON u.id = k.user_id AND k.ocena BETWEEN 1 AND 6
        LEFT JOIN sprawdzian AS s ON u.id = s.user_id AND s.ocena BETWEEN 1 AND 6
        LEFT JOIN odpowiedz AS o ON u.id = o.user_id AND o.ocena BETWEEN 1 AND 6
        WHERE u.id = $userId";
            $result = $conn->query($sql);
            $user = $result->fetch_assoc();

            echo <<< EDITUSERFORM
        <h4>Aktualizacja użytkownika</h4><form action="../scripts/update_user.php?userIdUpdate=$userId" method="post">
        <input type="hidden" name="userId" value="$userId">
        <input type="text" name="imie" placeholder="Podaj imię" value="{$user['firstName']}" readonly><br><br>
        <input type="text" name="nazwisko" placeholder="Podaj nazwisko" value="{$user['lastName']}" readonly><br><br>
        <input type="text" name="ocena_kartkowki" placeholder="Podaj ocenę kartkówki" value="{$user['ocena_kartkowki']}" autofocus><br><br>
        <input type="text" name="ocena_sprawdzianu" placeholder="Podaj ocenę sprawdzianu" value="{$user['ocena_sprawdzianu']}"><br><br>
        <input type="text" name="ocena_odpowiedzi" placeholder="Podaj ocenę odpowiedzi" value="{$user['ocena_odpowiedzi']}"><br><br>
        <input type="email" name="email" placeholder="Podaj adres e-mail" value="{$user['email']}" readonly><br><br>
        <input type="submit" value="Aktualizuj użytkownika" onclick="updateUser()"></form>
        EDITUSERFORM;
        }else {
        }

        $conn->close();
        ?><script>
            function goBack() {
                history.back();
            }
            // Obsługa zdarzenia kliknięcia przycisku "Usuń"
            const deleteButtons = document.querySelectorAll(".delete-button");
            deleteButtons.forEach(button => {
                button.addEventListener("click", (event) => {
                    event.preventDefault();
                    const userId = event.target.dataset.userId;
                    deleteUser(userId);
                });
            });

            // Funkcja do otwierania formularza edycji użytkownika
            function openEditUserForm(userId) {
                window.location.href = `../../../pages/views/logged_nauczyciel/pojedynczy.php?userIdUpdate=${userId}`;
            }
            // Funkcja do aktualizacji użytkownika
            function updateUser() {
                var ocena_kartkowki = document.getElementsByName("ocena_kartkowki")[0].value;
                var ocena_sprawdzianu = document.getElementsByName("ocena_sprawdzianu")[0].value;
                var ocena_odpowiedzi = document.getElementsByName("ocena_odpowiedzi")[0].value;
                if (ocena_kartkowki >= 1 && ocena_kartkowki <= 6 && ocena_sprawdzianu >= 1 && ocena_sprawdzianu <= 6 && ocena_odpowiedzi >= 1 && ocena_odpowiedzi <= 6) {
                    alert("Użytkownik został zaktualizowany!");
                    window.location.href = `../../../pages/views/logged_nauczyciel/pojedynczy.php?userIdUpdate`;
                } else {
                    alert("Błąd aktualizacji: Wprowadzona ocena musi być w przedziale od 1 do 6.");
                    window.location.href = `../../../pages/views/logged_nauczyciel/pojedynczy.php?userIdUpdate`;
                }
            }
        </script>
        </body>
        </html>

            </div>
        </div>




    </body>
    </html>

    <?php
    require_once "../footer.php";
    ?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.js"></script>

<!-- Ajax script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-details').click(function () {
            var userId = $(this).data('userId');

            // Wykonaj żądanie AJAX, aby pobrać szczegółowe informacje o użytkowniku
            $.ajax({
                url: 'pojedynczy.php',
                method: 'GET',
                data: {
                    userId: userId
                },
                success: function (response) {
                    // Wyświetl pobrane szczegółowe informacje o użytkowniku
                    $('#user-details').html(response);
                },
                error: function () {
                    // Wyświetl komunikat błędu, jeśli wystąpił problem z pobraniem danych
                    $('#user-details').html('Wystąpił błąd podczas pobierania informacji o użytkowniku.');
                }
            });
        });
    });
</script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../../../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../../../plugins/raphael/raphael.min.js"></script>
<script src="../../../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../../../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../../../plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../../../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../../dist/js/pages/dashboard2.js"></script>
</div>
</div>
</div>
</section>
</div>
</section>
</div>


</body>
</html>



<!-- /.content-wrapper -->

<!-- Main Footer -->


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.js"></script>

<!-- Ajax script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../../../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../../../plugins/raphael/raphael.min.js"></script>
<script src="../../../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../../../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../../../plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../../../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../../dist/js/pages/dashboard2.js"></script>
</body>
</html>