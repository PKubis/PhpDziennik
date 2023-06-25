<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <span href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">NAUCZYCIEL</span>
    </span>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                require_once "../../../scripts/connect.php";

                echo '<img src="../../../dist/img/avatar3.png' . $_SESSION["logged"]["logo"] . '" class="img-circle elevation-2" alt="User Image">';
                ?>
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION["logged"]["firstName"] . " " . $_SESSION["logged"]["lastName"] ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-book-open alt"></i>
                        <p>
                            Dziennik
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php
                        require_once "../../../scripts/connect.php";

                        function yourFunction($conn) {
                            $sql = "SELECT * FROM users WHERE role_id = 1;";
                            $result = $conn->query($sql);

                            if ($result && $result->num_rows > 0) {
                                // Wyświetlanie uczniów
                                while ($row = $result->fetch_assoc()) {
                                    $firstName = $row['firstName'];
                                    $lastName = $row['lastName'];
                                    $selectedUserId = $row['id'];
                                    echo '<li class="nav-item">';
                                    echo '<a href="../logged_nauczyciel/pojedynczy.php?userId=' . $selectedUserId . '" class="nav-link">';
                                    echo '<i class="far fa-circle nav-icon"></i>';
                                    echo '<p>' . $firstName . ' ' . $lastName . '</p>';
                                    echo '</a>';
                                    echo '</li>';
                                }
                            } else {
                                echo '<li class="nav-item">';
                                echo '<p>Brak uczniów w bazie.</p>';
                                echo '</li>';
                            }
                        }

                        yourFunction($conn);
                        ?>

                        <script>
                            function showUserDetails(userId) {
                                window.location.href = `logged.php?userId=${userId}`;
                            }
                        </script>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
