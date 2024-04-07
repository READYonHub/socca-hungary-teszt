<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../headers/header.php");
    ?>
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
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

    <!--Táblázat-->
    <table class="news-table" id="news-table-data">
        <thead>
            <tr>
                <th style="width:15%;">Létrehozás dátuma</th>
                <th style="width:15%;">Cím</th>
                <th style="width:45%;">Hír tartalma</th>
                <th style="width:25%;">Művelet</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            include('../../connect.php');
            $sqlSelect = "SELECT * FROM news";
            $result = mysqli_query($conn, $sqlSelect);
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $data["date"] ?></td>
                    <td><?php echo $data["title"] ?></td>
                    <td><?php echo $data["summary"] ?></td>
                    <td class="actions">
                        <a class="action" href="news_check.php?id=<?php echo $data["id"] ?>">Nézet</a>
                        <a class="action" href="news_edit.php?id=<?php echo $data["id"] ?>">Szerk.</a>
                        <a class="action" href="news_delete.php?id=<?php echo $data["id"] ?>">Törlés</a>
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
    
</div>
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

    .news-table {
        border-collapse: collapse;
        margin-top: 10px;
    }

    .news-table,
    th,
    td {
        padding: 10px;
    }

    .news-table tr:nth-child(even) {
        background-color: #303030;
    }

    .news-table,
    th {
        border: 2px solid transparent;
    }

    .news-container {
        background-color: #252525;
        color: #fff;
        width: 100vw;
        padding: 30px;
    }
</style>

<?php
//include("../headers/visibility.php");
?>
<?php
include("../headers/footer.php");
?>