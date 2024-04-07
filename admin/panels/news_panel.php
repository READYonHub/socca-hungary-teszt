<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ./login.php");
} ?><?php
    include("../headers/header.php");
    ?>
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

<div class="news-container">
    <h1>Műveletek</h1>
    <div class="news-actions">
        <a href="../news/news_create.php" class="text-light text-decoration-none">Új Hír</a>
        <a href="../news/news_existing.php" class="text-light text-decoration-none">Meglévő hírek módosítása</a>
    </div>
</div>

<style>
    .news-container {
        display: flex;
        flex-direction: column;
        padding: 30px;
        background-color: #252525;
        width: 100vw;
    }

    .news-actions {
        display: flex;
        flex-direction: column;
        margin-top: 30px;
        gap: 15px;
    }

    .news-container a {
        background-color: #d0d0d7;
        padding: 10px;
        color: #000;
        text-decoration: none;
        border-radius: 8px;
        max-width: 300px;
    }

    .news-container a:hover {
        filter: brightness(.9);
    }

    .news-container h1 {
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
</style>

<?php
//include("./templates/visibility.php");
?>
<?php
//include("templates/footer.php");
include("../headers/footer.php");
?>