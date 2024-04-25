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

        .news-table tr:nth-child(even) {
            background-color: #303030;
        }

        .news-container {
            background-color: #252525;
            color: #fff;
            width: 100vw;
            padding: 30px;
        }

        #news-table-data .playerRow:hover {
            color: orange;
            background-color: black;
        }
    </style>
    <!-- JQUERY -->
    <?php include('../lib/jquery/news_jquery.php'); ?>

    <!--Táblázat-->
    <table class="news-table" id="news-table-data">
        <thead>
            <tr>
                <th>Létrehozás dátuma</th>
                <th>Cím</th>
                <th>Hír tartalma</th>
                <th>Művelet</th>
            </tr>
        </thead>
        <tbody>

            <?php
            include('../../connect.php');
            $sqlSelect = "SELECT * FROM news";
            $result = mysqli_query($conn, $sqlSelect);
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr class="playerRow">
                    <td><?php echo $data["date"] ?></td>
                    <td><?php echo $data["title"] ?></td>
                    <td><?php echo strlen($data["summary"]) > 100 ? substr($data["summary"], 0, 100) . "..." : $data["summary"] ?></td>
                    <td class="actions">
                        <a class="action" href="news_check.php?id=<?php echo $data["id"] ?>">Nézet</a>
                        <a class="action" href="news_edit.php?id=<?php echo $data["id"] ?>">Szerk.</a>
                        <a class="action" onclick="return confirm('Biztosan törli a hírt?');" href="news_delete.php?id=<?php echo $data["id"] ?>">Törlés</a>
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