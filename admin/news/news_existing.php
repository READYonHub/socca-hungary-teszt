<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../templates/news_header.php");
    ?>
<div class="posts-list w-100 p-5">
    <?php
    if (isset($_SESSION["create"])) {
    ?>
        <div class="alert alert-success">
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
        <div class="alert alert-success">
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
        <div class="alert alert-success">
            <?php
            echo $_SESSION["delete"];
            ?>
        </div>
    <?php
        unset($_SESSION["delete"]);
    }
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:15%;">létrehozás dátuma</th>
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
                    <td>
                        <a class="btn btn-info" href="news_check.php?id=<?php echo $data["id"] ?>">View</a>
                        <a class="btn btn-warning" href="news_edit.php?id=<?php echo $data["id"] ?>">Edit</a>
                        <a class="btn btn-danger" href="news_delete.php?id=<?php echo $data["id"] ?>">Delete</a>
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