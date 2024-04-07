<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../headers/header.php");
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

    .news-container input, textarea {
        font-size: 14pt;
        border: none;
        padding: 10px;
        border-radius: 8px;
        max-width: 800px;
        resize: vertical;
    }
</style>

<form action="./news_process.php" method="post" class="news-container">
    <input type="text" name="title" id="" placeholder="Cím">
    <textarea name="summary" cols="30" rows="10" placeholder="Összefoglaló"></textarea>
    <textarea name="content" cols="30" rows="10" placeholder="Poszt"></textarea>
    <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">

    <input type="submit" value="Elküldés" name="create">
</form>

<?php
include("../headers/footer.php");
?>