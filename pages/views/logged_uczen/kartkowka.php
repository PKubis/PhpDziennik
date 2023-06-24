<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <span href="index3.html" class="brand-link">
		<img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">AdminLTE 3</span>
	</span>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                echo '<img src="../dist/img/avatar3.png'.$_SESSION["logged"]["logo"].'" class="img-circle elevation-2" alt="User Image">';
                ?>
            </div>
            <div class="info">
                <span href="#" class="d-block"><?php echo $_SESSION["logged"]["firstName"]." ".$_SESSION["logged"]["lastName"] ?></span>
            </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-book-open alt"></i>
                        <p>
                            Dzienniczek
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../pages/views/logged_uczen/kartkowka.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kartkówka</p>
                            </a>
                        </li>

                </li>
                <li class="nav-item">
                    <a href="./calendar_admin.html" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sprawdzian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Odpowiedź</p>
                    </a>
                <li class="nav-item">
                    <a href="./index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Wszystko</p>
                    </a>
                </li>
            </ul>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>