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
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

    <!--Táblázat-->
    <table class="p-table" id="news-table-data">
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

        .p-table {
            border-collapse: collapse;
            margin-top: 10px;
            width: 100%;
            /* Ensure the table takes up the full width */
        }

        .p-table,
        th,
        td {
            padding: 10px;
            border: 2px solid transparent;
            /* Add border style to table cells */
        }

        .p-table tr:nth-child(even) {
            background-color: #303030;
            /* Background color for even rows */
        }

        .player-table-main-container {
            display: flex;
            background-color: #252525;
            width: 100vw;
            padding: 30px;
            color: #fff;
            overflow-x: auto;
            /* Add horizontal scrollbar if table overflows */
        }
    </style>

</div>
<?php
//include("../headers/visibility.php");
?>
<?php
include("../headers/footer.php");
?>