<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dziennik Nauczyciela:</h1>
                    <div class="info">
                        <span href="#" class="accent-green"><?php echo $_SESSION["logged"]["firstName"] . " " . $_SESSION["logged"]["lastName"]; ?></span>
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
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
                                    <h3 class="card-title">Oceny</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <h4>Użytkownicy</h4>
                                    <?php
                                    if (isset($_GET["addUser"])) {
                                        echo <<<ADDUSERFORM
                                        <h4>Dodawanie użytkownika</h4>
                                        <form action="../scripts/add_user.php" method="post">
                                            <input type="text" name="imie" placeholder="Podaj imię" autofocus><br><br>
                                            <input type="text" name="nazwisko" placeholder="Podaj nazwisko"><br><br>
                                            <input type="password" name="haslo" placeholder="Podaj hasło"><br><br>
                                            <input type="email" name="email" placeholder="Podaj adres e-mail"><br><br>
                                            <input type="submit" value="Dodaj użytkownika">
                                        </form>
ADDUSERFORM;
                                    } else {
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
                                            require_once "../../../scripts/connect.php";
                                            $sql = "SELECT
                                                        u.id,
                                                        u.firstName AS imie,
                                                        u.lastName AS nazwisko,
                                                        u.email,
                                                        k.ocena AS ocena_kartkowki,
                                                        s.ocena AS ocena_sprawdzianu,
                                                        o.ocena AS ocena_odpowiedzi,
                                                        AVG((k.ocena + s.ocena + o.ocena) / 3) AS srednia
                                                    FROM
                                                        users u
                                                        LEFT JOIN kartkowki k ON u.id = k.user_id
                                                        LEFT JOIN sprawdziany s ON u.id = s.user_id
                                                        LEFT JOIN odpowiedzi o ON u.id = o.user_id
                                                    GROUP BY
                                                        u.id,
                                                        u.firstName,
                                                        u.lastName,
                                                        u.email
                                                    ORDER BY
                                                        u.lastName ASC";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row["imie"] . "</td>";
                                                    echo "<td>" . $row["nazwisko"] . "</td>";
                                                    echo "<td>" . $row["ocena_kartkowki"] . "</td>";
                                                    echo "<td>" . $row["ocena_sprawdzianu"] . "</td>";
                                                    echo "<td>" . $row["ocena_odpowiedzi"] . "</td>";
                                                    echo "<td>" . $row["srednia"] . "</td>";
                                                    echo "<td>" . $row["email"] . "</td>";
                                                    echo "<td><a href=\"../scripts/delete_user.php?id=" . $row["id"] . "\">Usuń</a></td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan=\"8\">Brak użytkowników</td></tr>";
                                            }
                                            $conn->close();
                                            ?>
                                        </table>
                                        <a href="?addUser=1">Dodaj użytkownika</a>
                                        <?php
                                    }
                                    ?>
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
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
