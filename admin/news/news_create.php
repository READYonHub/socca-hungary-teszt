<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../headers/header.php");
    ?>
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
    .news-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
        padding: 30px;
        background-color: #252525;
        width: 100vw;
    }

    .news-container input {
        font-size: 14pt;
        border: none;
        padding: 10px;
        border-radius: 4px;
        max-width: 800px;
    }

    .news-container textarea {
        padding: 8px;
        border-radius: 4px;
        border: none;
        max-width: 800px;
        resize: vertical;
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

<form action="./news_process.php" method="post" class="news-container" autocomplete="off">
    <input type="text" name="title" id="" placeholder="Cím" required>
    <textarea name="summary" cols="30" rows="10" placeholder="Összefoglaló" required></textarea>
    <textarea name="content" cols="30" rows="10" placeholder="Poszt" required></textarea>
    <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">

    <input type="submit" value="Elküldés" name="create">
</form>

<?php
include("../headers/footer.php");
?>