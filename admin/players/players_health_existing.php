<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../templates/players_header.php");
    ?>
<div class="posts-list w-100 p-5">

    <table class="table table-bordered">
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

</div>
<?php
include("../templates/visibility.php");
?>
<?php
include("../templates/footer.php");
?>