<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../headers/header.php");
    ?>
<div class="player-table-main-container">

    <!-- JQUERY -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

    <!--Táblázat-->
    <table class="p-table" id="news-table-data">
        <thead>
            <tr>
                <!--<th style="width:15%;">létrehozás dátuma</th>-->
                <th>Játékos neve</th>
                <th>Játékos Sorszáma</th>
                <th>Játékos Státusz</th>
                <th>Művelet</th>
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
                    <td class="actions">
                        <a class="action" href="players_check.php?id=<?php echo $data["player_id"] ?>">View</a>
                        <a class="action" href="players_edit.php?id=<?php echo $data["player_id"] ?>">Edit</a>
                        <a class="action" href="players_delete.php?id=<?php echo $data["player_id"] ?>">Delete</a>
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
            $('#news-table-data').DataTable();
        });
    </script>

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
    </style>

</div>
<?php
//include("../headers/visibility.php");
?>
<?php
include("../headers/footer.php");
?>