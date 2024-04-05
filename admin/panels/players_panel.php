<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ./login.php");
} ?>
<?php
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

    <div class="row">
        <div class="col-3 p-4 mt-4">
            <button type="button" class="btn btn-primary">
                <a href="./players/players_create.php" class="text-light text-decoration-none">Új Játékos</a>
            </button>
        </div>
        <div class="col-3 p-4 mt-4">
            <button type="button" class="btn btn-warning">
                <a href="./players/players_existing.php" class="text-light text-decoration-none">Meglévő játékosok módosítása</a>
            </button>
        </div>
        <div class="col-3 p-4 mt-4">
            <button type="button" class="btn btn-info">
                <a href="./players/players_health.php" class="text-light text-decoration-none">Játékosok egészségügyi adatai</a>
            </button>
        </div>
        <div class="col-3 p-4 mt-4">
            <button type="button" class="btn btn-dark">
                <a href="./players/players_qr_kod.php" class="text-light text-decoration-none">Játékos QR-kód létrehozása</a>
            </button>
        </div>
    </div>
</div>

<?php
include("./templates/visibility.php");
?>
<?php
include("templates/footer.php");
?>