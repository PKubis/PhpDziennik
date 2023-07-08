<nav class="main-header navbar navbar-expand navbar-dark">
	<!-- Left navbar links -->
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
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="logged.php" class="nav-link">Home</a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
            <a href="/views/<?php echo $role; ?>/" class="nav-link">Kontakt</a>

        </li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="/../../scripts/logout.php" class="nav-link">Wyloguj</a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<!-- Navbar Search -->


		<!-- Messages Dropdown Menu -->


		<!-- Notifications Dropdown Menu -->

			</a>
		</li>
	</ul>
</nav>