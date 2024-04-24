<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../headers/header.php");
    ?>
<div class="player-health-container">
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

        .p-health-table tr:nth-child(even) {
            background-color: #303030;
        }

        .player-health-container {
            background-color: #252525;
            width: 100vw;
            padding: 30px;
            color: #fff;
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

        #players-table-data .playerRow:hover {
            color: orange;
            background-color: black;
        }
    </style>
    <!-- JQUERY -->
    <?php include('../lib/jquery/players_health_jquery.php'); ?>

    <!--Táblázat-->
    <table class="p-health-table" id="players-table-data">
        <thead>
            <tr>
                <!--<th style="width:15%;">létrehozás dátuma</th>-->
                <th>Játékos neve</th>
                <th>Játékos Sorszáma</th>
                <th>Játékos Egészségügyi adatai</th>
                <th>Játékos Gyógyszer allergia</th>
                <th>Játékos Krónikus Betegségei</th>
                <th>Művelet</th>
            </tr>
        </thead>
        <tbody>

            <?php
            include('../../connect.php');
            $sqlSelect  =   "SELECT pd.player_id, pd.name, pd.registration_number, ph.blood_group, ph.drug_allergies, ph.chronic_illness
                             FROM players_data pd
                             LEFT JOIN players_health ph
                             ON pd.player_id = ph.player_id;

            ";
            $result = mysqli_query($conn, $sqlSelect);
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr class="playerRow">
                    <td><?php echo $data["name"] ?></td>
                    <td><?php echo $data["registration_number"] ?></td>
                    <td><?php echo $data["blood_group"] ?></td>
                    <td><?php echo $data["drug_allergies"] ?></td>
                    <td><?php echo $data["chronic_illness"] ?></td>
                    <td class="actions">
                        <a class="action" href="players_health_check.php?id=<?php echo $data["player_id"] ?>">View</a>
                        <a class="action" href="players_health_edit.php?id=<?php echo $data["player_id"] ?>">Edit</a>
                        <a class="action" href="players_health_delete.php?id=<?php echo $data["player_id"] ?>">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>

</div>

<?php
//include("../headers/visibility.php");
?>
<?php
include("../headers/footer.php");
?>