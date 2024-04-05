<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ./login.php");
} ?><?php
    include("templates/header.php");
    ?>


<div class="container p-4 mt-4">
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

    <div class="row">
        <div class="col-3 p-4 mt-4">
            <button type="button" class="btn btn-primary">
                <a href="./news/news_create.php" class="text-light text-decoration-none">Új Hír</a>
            </button>
        </div>
        <div class="col-3 p-4 mt-4">
            <button type="button" class="btn btn-warning">
                <a href="./news/news_existing.php" class="text-light text-decoration-none">Meglévő hírek módosítása</a>
            </button>
        </div>
        <div class="col-3 p-4">
            <button type="button" class="btn "></button>
        </div>
        <div class="col-3 p-4">
            <button type="button" class="btn"></button>
        </div>
    </div>
</div>

<?php
include("./templates/visibility.php");
?>
<?php
include("templates/footer.php");
?>