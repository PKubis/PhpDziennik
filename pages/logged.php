<?php
  session_start();
  if (!isset($_SESSION["logged"]) || $_SESSION["logged"]["session_id"] != session_id() || session_status() != 2){
    $_SESSION["error"] = "Zaloguj się!";
    header("location: ./");
  }else{
    switch ($_SESSION["logged"]["role_id"]){
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
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php
    require_once "./views/navbar.php";
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
	<?php
	require_once "./views/$role/aside.php";
	?>

  <!-- Content Wrapper. Contains page content -->
	<?php
	require_once "./views/$role/content.php";
	?>

  <!-- /.content-wrapper -->

  <!-- Main Footer -->
	<?php
	require_once "./views/footer.php";
	?>
    <?php
    // Sprawdzenie, czy parametr selectedUserId został przekazany
    if (isset($_GET['selectedUserId'])) {
        // Pobranie wartości parametru selectedUserId
        $selectedUserId = $_GET['selectedUserId'];

        // Wyświetlanie pustego widoku dla wybranego użytkownika
        echo "Widok dla użytkownika o ID: $selectedUserId";
    } else {
        // Wyświetlanie komunikatu o braku określonego użytkownika
        echo "Nie znaleziono użytkownika.";
    }
    ?>
    echo '<button class="btn btn-info btn-sm btn-details" data-user-id="' . $student['userId'] . '">Szczegóły</button>';


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<!-- Pozostała część kodu HTML w pliku logged.php -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-details').click(function() {
            var userId = $(this).data('userId');

            // Wykonaj żądanie AJAX, aby pobrać szczegółowe informacje o użytkowniku
            $.ajax({
                url: 'pojedynczy.php',
                method: 'GET',
                data: { userId: userId },
                success: function(response) {
                    // Wyświetl pobrane szczegółowe informacje o użytkowniku
                    $('#user-details').html(response);
                },
                error: function() {
                    // Wyświetl komunikat błędu, jeśli wystąpił problem z pobraniem danych
                    $('#user-details').html('Wystąpił błąd podczas pobierania informacji o użytkowniku.');
                }
            });
        });
    });
</script>


</body>
</html>

<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../plugins/raphael/raphael.min.js"></script>
<script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>
</body>
</html>
