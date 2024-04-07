<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
}
include("../headers/header.php");
?>
<div class="posts-list w-100 p-5">
    <div class="news-container">
        <?php
        if (isset($_SESSION["create"])) {
        ?>
            <div class="message">
                <?php
                echo $_SESSION["create"];
                ?>
            </div>
        <?php
            unset($_SESSION["create"]);
        }
        ?>
        <?php
        if (isset($_SESSION["update"])) {
        ?>
            <div class="message">
                <?php
                echo $_SESSION["update"];
                ?>
            </div>
        <?php
            unset($_SESSION["update"]);
        }
        ?>
        <?php
        if (isset($_SESSION["delete"])) {
        ?>
            <div class="message">
                <?php
                echo $_SESSION["delete"];
                ?>
            </div>
        <?php
            unset($_SESSION["delete"]);
        }
        ?>
        <!-- JQUERY -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

        <!--Táblázat-->
        <table class="table table-bordered" id="players-table-data"> <!-- Egyedi azonosító hozzáadása -->
            <thead>
                <tr>
                    <!--<th style="width:15%;">létrehozás dátuma</th>-->
                    <th style="width:15%;">Játékos neve</th>
                    <th style="width:45%;">Játékos Sorszáma</th>
                    <th style="width:45%;">Játékos Státusz</th>
                    <th style="width:25%;">Művelet</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../../connect.php');
                $sqlSelect = "SELECT * FROM players_data";
                $result = mysqli_query($conn, $sqlSelect);
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $data["name"] ?></td>
                        <td><?php echo $data["registration_number"] ?></td>
                        <td><?php echo $data["status"] ?></td>
                        <td>
                            <a class="btn btn-info" href="players_check.php?id=<?php echo $data["player_id"] ?>">View</a>
                            <a class="btn btn-warning" href="players_health_edit.php?id=<?php echo $data["player_id"] ?>">Edit</a>
                            <a class="btn btn-danger" href="players_health_delete.php?id=<?php echo $data["player_id"] ?>">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <!--JQUERY-->
        <script>
            $(document).ready(function() {
                $('#players-table-data').DataTable(); // A megfelelő azonosítót használjuk a DataTables inicializálásakor
            });
        </script>
    </div>
</div>
<?php
//include("../headers/visibility.php");
?>
<?php
include("../headers/footer.php");
?>