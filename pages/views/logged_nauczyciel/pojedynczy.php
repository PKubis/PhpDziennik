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
    <
    <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="../../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php
    require_once __DIR__ . "/navbar.php";
    ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    require_once __DIR__ . "/../$role/aside1.php";
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="user-details"></div> <!-- Wyświetlanie szczegółów użytkownika -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
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
</body>
</html>
<?php
function getUserDetailsFromDatabase($conn, $userId)
{
    // Tutaj umieść kod do połączenia z bazą danych i pobrania szczegółowych informacji o użytkowniku
    // Przykład:

    // Zapytanie SQL do pobrania szczegółowych informacji o użytkowniku
    $sql = "SELECT firstName, lastName, email FROM users WHERE id = '$userId'";
    $result = $conn->query($sql);

    // Sprawdzenie czy zapytanie zwróciło wyniki
    if ($result->num_rows > 0) {
        // Pobranie danych użytkownika
        $row = $result->fetch_assoc();
        $userDetails = array(
            'firstName' => $row['firstName'],
            'lastName' => $row['lastName'],
            'email' => $row['email']
        );
    } else {
        // Użytkownik o podanym userId nie został znaleziony
        $userDetails = array();
    }

    return $userDetails;
}

require_once "../../../scripts/connect.php";

// Pobierz wartość parametru userId
$userId = $_GET['userId'];

// Połączenie z bazą danych
$conn = new mysqli("localhost", "root", "", "dziennik_db25");

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Wywołaj funkcję getUserDetailsFromDatabase() i przypisz wynik do zmiennej
$userDetails = getUserDetailsFromDatabase($conn, $userId);

// Zamknięcie połączenia z bazą danych
$conn->close();

// Wygeneruj odpowiedź HTML zawierającą informacje o użytkowniku
$html = '<p>Imię: ' . $userDetails['firstName'] . '</p>';
$html .= '<p>Nazwisko: ' . $userDetails['lastName'] . '</p>';
$html .= '<p>Email: ' . $userDetails['email'] . '</p>';

echo $html;
?>