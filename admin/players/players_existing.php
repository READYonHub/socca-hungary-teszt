<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
<?php
include("../headers/header.php");
?>

<?php
if (isset($_SESSION["create"])) {
?>
    <div class="message-g">
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
    <div class="message-g">
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
    <div class="message-r">
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

    .message-g {
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

    .message-r {
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
        background-color: rgb(200, 0, 0);
        border-radius: 8px;
    }

    .p-table {
        border-collapse: collapse;
        margin-top: 10px;
        text-align: left;
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

    #players-table-data .playerRow:hover {
        color: orange;
        background-color: black;
    }

    /* .p-table th:not(:last-child),
    .p-table td:not(:last-child) {
        border-right: 1px solid #ccc;
    }*/
</style>

<!-- JQUERY -->
<?php include('../lib/jquery/players_jquery.php') ?>

<div class="player-table-main-container">

    <!--Táblázat-->
    <table class="p-table" id="players-table-data">
        <thead>
            <!--<th style="width:15%;">létrehozás dátuma</th>-->
            <th>Játékos neve</th>
            <th>Játékos Sorszáma</th>
            <th>Játékos Státusz</th>
            <th>Művelet</th>
        </thead>
        <tbody>

            <?php
            include('../../connect.php');
            $sqlSelect = "SELECT * FROM players_data";
            $result = mysqli_query($conn, $sqlSelect);
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr class="playerRow">
                    <td><?php echo $data["name"] ?></td>
                    <td><?php echo $data["registration_number"] ?></td>
                    <td><?php echo $data["status"] ?></td>
                    <td class="actions">
                        <a class="action" href="players_check.php?id=<?php echo $data["player_id"] ?>">View</a>
                        <a class="action" href="players_edit.php?id=<?php echo $data["player_id"] ?>">Edit</a>
                        <a class="action" onclick="return confirm('Biztosan törli a játékost?');" href="players_delete.php?id=<?php echo $data["player_id"] ?>">Delete</a>
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