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
    .n-container {
        display: flex;
        flex-direction: column;
        background-color: #252525;
        width: 100vw;
        gap: 10px;
        padding: 30px;
        color: #fff;
    }

    .n-container h1 {
        margin-bottom: 10px;
    }

    .n-container input {
        padding: 10px;
        max-width: 400px;
        border-radius: 8px;
        border: none;
    }

    .n-container textarea {
        padding: 10px;
        max-width: 400px;
        border-radius: 8px;
        border: none;
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

    .n-container input[type="submit"] {
        padding: 10px;
        border: none;
        border-radius: 4px;
        font-weight: bold;
    }

    .n-container input[type="submit"]:hover {
        filter: brightness(.9);
    }
</style>

<form action="./news_process.php" method="post" class="n-container" autocomplete="off">

    <h1>Hír létrehozása</h1>

    <label for="title">Cím:</label>
    <input type="text" name="title" id="title" placeholder="Cím..." required>

    <label for="content">Tartalom:</label>
    <textarea name="content" id="content" cols="30" rows="10" placeholder="Tartalom..." required></textarea>

    <label for="summary">Összefoglaló:</label>
    <textarea name="summary" id="summary" cols="30" rows="10" placeholder="Összefoglaló..." required></textarea>
    <br>

    <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">

    <input type="submit" value="Létrehozás" name="create">
</form>

<?php
include("../headers/footer.php");
?>