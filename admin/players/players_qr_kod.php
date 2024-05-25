<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit; // Fontos az exit, hogy ne folytatódjon a kód futása
}

include("../headers/header.php");
?>
<style>
    .action {
        display: flex;
        text-decoration: none;
        color: #aaa;
    }

    .actions {
        display: flex;
        width: 100%;
        justify-content: center;
        align-items: center;
        gap: 15px;
    }

    .message {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: center;
        background-color: transparent;
        font-weight: bold;
        position: absolute;
        bottom: 0;
        right: 0;
        margin: 20px;
        padding: 10px;
        background-color: rgb(0, 200, 0);
        border-radius: 8px;
    }

    .p-table {
        border-collapse: collapse;
        margin-top: 10px;
    }

    .p-table tr:nth-child(even) {
        background-color: #303030;
    }

    .player-table-main-container {
        background-color: #252525;
        color: #fff;
        width: 100vw;
        padding: 30px;
    }

    #playersTable .playerRow:hover {
        color: orange;
        background-color: black;
    }
</style>
<div class="player-table-main-container">
    <!--JQUERY-->
    <?php include('../lib/jquery/players_qr_jquery.php'); ?>

    <table class="p-table" id="playersTable">
        <thead>
            <tr>
                <!--<th style="width:15%;">létrehozás dátuma</th>-->
                <th style="width:15%;">Játékos neve</th>
                <th style="width:5%;">Játékos Sorszáma</th>
                <th style="width:5%;">QR-kód generálás</th>
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
                    <td class="actions">
                        <a class="action" href="../qr/qr_code_generator_algoritmus.php?type=data&player_id=<?php echo $data["player_id"] ?>">QR kód generálás</a>
                    </td>

                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

</div>

<?php
include("../headers/footer.php");
?>