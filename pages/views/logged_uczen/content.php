<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dziennik ucznia:</h1>
                    <div class="info">
                        <span href="#" class="accent-green"><?php echo $_SESSION["logged"]["firstName"]." ".$_SESSION["logged"]["lastName"] ?></span>
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
                                    <h3 class="card-title">Podgląd</h3>
                                </div>
                                <!-- /.card-header -->
                                <table class="card-body">
                                    <thead>
                                    <tr>
                                        <th>Imie</th>
                                        <th>Nazwisko</th>
                                        <th>kartkówka</th>
                                        <th>sprawdzian</th>
                                        <th>odpowiedź</th>
                                        <th>Średnia</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    require_once "../scripts/connect.php";

                                    if (isset($_POST['userId'])) {
                                        $userId = $_POST['userId'];

                                    $sql = "SELECT\n"
                                        . "  u.id,\n"
                                        . "  u.firstName AS imie,\n"
                                        . "  u.lastName AS nazwisko,\n"
                                        . "  u.email,\n"
                                        . "  k.ocena AS ocena_kartkowki,\n"
                                        . "  s.ocena AS ocena_sprawdzianu,\n"
                                        . "  o.ocena AS ocena_odpowiedzi,\n"
                                        . "  ROUND((COALESCE(k.ocena, 0) + COALESCE(s.ocena, 0) + COALESCE(o.ocena, 0)) / (\n"
                                        . "    CASE WHEN k.ocena IS NULL THEN 0 ELSE 1 END +\n"
                                        . "    CASE WHEN s.ocena IS NULL THEN 0 ELSE 1 END +\n"
                                        . "    CASE WHEN o.ocena IS NULL THEN 0 ELSE 1 END\n"
                                        . "  ), 1) AS srednia_ocen\n"
                                        . "FROM\n"
                                        . "  users AS u\n"
                                        . "LEFT JOIN\n"
                                        . "  kartkowka AS k ON u.id = k.user_id\n"
                                        . "LEFT JOIN\n"
                                        . "  sprawdzian AS s ON u.id = s.user_id\n"
                                        . "LEFT JOIN\n"
                                        . "  odpowiedz AS o ON u.id = o.user_id\n"
                                        . "WHERE\n"
                                        . "  u.id = $userId;";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows == 0) {
                                        echo "<tr><td colspan='8'>Brak rekordów do wyświetlenia</td></tr>";
                                    } else {
                                        while ($user = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $user['imie'] . "</td>";
                                            echo "<td>" . $user['nazwisko'] . "</td>";
                                            echo "<td>" . (isset($user['ocena_kartkowki']) ? $user['ocena_kartkowki'] : "") . "</td>";
                                            echo "<td>" . (isset($user['ocena_sprawdzianu']) ? $user['ocena_sprawdzianu'] : "") . "</td>";
                                            echo "<td>" . (isset($user['ocena_odpowiedzi']) ? $user['ocena_odpowiedzi'] : "") . "</td>";
                                            echo "<td>" . $user['srednia_ocen'] . "</td>";
                                            echo "<td>" . $user['email'] . "</td>";
                                            echo "<td><button class='delete-button' data-user-id='" . $user['id'] . "'>Usuń</button></td>";
                                            echo "<td><button class='edit-button' data-user-id='" . $user['id'] . "' onclick='openEditUserForm(" . $user['id'] . ")'>Aktualizuj</button></td>";
                                            echo "</tr>";
                                        }
                                    }}
                                    ?>

                                    <!-- Formularz do wprowadzania ID użytkownika -->
                                    <form method="POST">
                                        <label for="userId">ID użytkownika:</label>
                                        <input type="text" name="userId" id="userId">
                                        <button type="submit">Pokaż oceny</button>
                                    </form>
                                </table>
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
