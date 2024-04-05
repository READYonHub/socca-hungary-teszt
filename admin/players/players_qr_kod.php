<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../templates/players_header.php");
    ?>

<style>
    #playersTable .playerRow:hover {
        color: orange;
        background-color: black;
        font-weight: bold;
    }
</style>

<div class="posts-list w-100 p-5">
    <table class="table table-bordered" id="playersTable">
        <thead>
            <tr>
                <!--<th style="width:15%;">létrehozás dátuma</th>-->
                <th style="width:15%;">Játékos neve</th>
                <th style="width:5%;">Játékos Sorszáma</th>
                <th style="width:5%;">QR-kód</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../../connect.php');
            $sqlSelect  =   "SELECT pd.player_id, pd.name, pd.registration_number
                             FROM players_data pd
                             LEFT JOIN players_health ph
                             ON pd.player_id = ph.player_id;";
            $result = mysqli_query($conn, $sqlSelect);
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr class="playerRow">
                    <td><?php echo $data["name"] ?></td>
                    <td><?php echo $data["registration_number"] ?></td>
                    <td><a class="btn btn-dark" href="../qr/qr_code_generator_algoritmus.php?player_id=<?php echo $data["player_id"] ?>">QR kód generálás</a></td>

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