<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Panel Administracyjny:</h1>
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
                                    <h3 class="card-title">Oceny</h3>
                                </div>
                                <!-- /.card-header -->
                                <table class="card-body">
                                    <!doctype html>
                                    <html lang="pl">
                                    <head>
                                        <meta charset="UTF-8">
                                        <meta name="viewport"
                                              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                        <link rel="stylesheet" href="../css/table.css">
                                        <title>Użytkownicy</title>
                                    </head>
                                    <body>
                                    <h4>Użytkownicy</h4>
                                    <?php
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
                                            <th>Rola</th>
                                            <th>Kartkówka</th>
                                            <th>Sprawdzian</th>
                                            <th>Odpowiedź</th>
                                            <th>Średnia</th>
                                            <th>Email</th>
                                            <th>Akcje</th>
                                        </tr>
                                        <?php
                                        require_once "../scripts/connect.php";
                                        $sql = "SELECT\n"
                                            . "  u.id,\n"
                                            . "  u.firstName AS imie,\n"
                                            . "  u.lastName AS nazwisko,\n"
                                            . "  u.role_id AS role,\n"
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
                                            . "  odpowiedz AS o ON u.id = o.user_id\n";


                                        $result = $conn->query($sql);
                                        if ($result->num_rows == 0) {
                                            echo "<tr><td colspan='8'>Brak rekordów do wyświetlenia</td></tr>";
                                        } else {
                                            while ($user = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $user['imie'] . "</td>";
                                                echo "<td>" . $user['nazwisko'] . "</td>";
                                                echo "<td>" . $user['role'] . "</td>";
                                                echo "<td>" . (isset($user['ocena_kartkowki']) ? $user['ocena_kartkowki'] : "") . "</td>";
                                                echo "<td>" . (isset($user['ocena_sprawdzianu']) ? $user['ocena_sprawdzianu'] : "") . "</td>";
                                                echo "<td>" . (isset($user['ocena_odpowiedzi']) ? $user['ocena_odpowiedzi'] : "") . "</td>";
                                                echo "<td>" . $user['srednia_ocen'] . "</td>";
                                                echo "<td>" . $user['email'] . "</td>";
                                                echo "<td><button class='delete-button' data-user-id='" . $user['id'] . "'>Usuń</button></td>";
                                                echo "<td><button class='edit-button' data-user-id='" . $user['id'] . "'>Aktualizuj</button></td>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>

                                    </table>

                                    <hr>

                                    <?php
                                    if (isset($_GET["addUser"])) {
                                        echo <<< ADDUSERFORM
        <h4>Dodawanie użytkownika</h4>
        <form action="../scripts/add_user.php" method="post">
            <input type="text" name="imie" placeholder="Podaj imię" autofocus><br><br>
            <input type="text" name="nazwisko" placeholder="Podaj nazwisko"><br><br>
            <input type="password" name="haslo" placeholder="Podaj hasło"><br><br>
            <input type="email" name="email" placeholder="Podaj adres e-mail"><br><br>
            <input type="submit" value="Dodaj użytkownika">
        </form>
ADDUSERFORM;

                                    } else if (isset($_GET["userIdUpdate"])) {
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
        <h4>Aktualizacja użytkownika</h4>
<form action="../scripts/update_user_admin.php?userIdUpdate=$userId " method="post">
            <input type="hidden" name="userId" value="$userId">
            <input type="text" name="imie" placeholder="Podaj imię" value="{$user['firstName']}" autofocus><br><br>
            <input type="text" name="nazwisko" placeholder="Podaj nazwisko" value="{$user['lastName']}"><br><br>
            <label for="roleSelect">Wybierz rolę:</label>
            <select id="roleSelect" name="role" value="{$user['role_id']}">
             <option value="1">Uczeń</option>
            <option value="2">Nauczyciel</option>
            <option value="3">Admin</option>
             </select> <br><br>
            <input type="text" name="ocena_kartkowki" placeholder="Podaj ocenę kartkówki" value="{$user['ocena_kartkowki']}" optional><br><br>
            <input type="text" name="ocena_sprawdzianu" placeholder="Podaj ocenę sprawdzianu" value="{$user['ocena_sprawdzianu']}" optional><br><br>
            <input type="text" name="ocena_odpowiedzi" placeholder="Podaj ocenę odpowiedzi" value="{$user['ocena_odpowiedzi']}" optional><br><br>
            <input type="email" name="email" placeholder="Podaj adres e-mail" value="{$user['email']}"><br><br>
            <input type="submit" value="Aktualizuj użytkownika">
             
        </form>
EDITUSERFORM; }else {
                                        echo '<a href="./logged.php?addUser=1">Dodaj użytkownika</a>';
                                    }

                                    $conn->close();
                                    ?>

                                    <script>
                                        // Obsługa zdarzenia kliknięcia przycisku "Usuń"
                                        const deleteButtons = document.querySelectorAll(".delete-button");
                                        deleteButtons.forEach(button => {
                                            button.addEventListener("click", (event) => {
                                                event.preventDefault();
                                                const userId = event.target.dataset.userId;
                                                deleteUser(userId);
                                            });
                                        });

                                        // Obsługa zdarzenia kliknięcia przycisku "Aktualizuj"
                                        const editButtons = document.querySelectorAll(".edit-button");
                                        editButtons.forEach(button => {
                                            button.addEventListener("click", (event) => {
                                                event.preventDefault();
                                                const userId = event.target.dataset.userId;
                                                openEditUserForm(userId);
                                            });
                                        });

                                        // Funkcja do usuwania użytkownika
                                        function deleteUser(userId) {
                                            if (confirm("Czy na pewno chcesz usunąć tego użytkownika?")) {
                                                window.location.href = `../scripts/delete_user.php?userIdDelete=${userId}`;
                                            }
                                        }

                                        // Funkcja do otwierania formularza edycji użytkownika
                                        function openEditUserForm(userId) {
                                            window.location.href = `../pages/logged.php?userIdUpdate=${userId}`;
                                        }
                                    </script>

                                    </body>
                                    </html>

                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <!-- /.content -->
</div>
</section>
</div>