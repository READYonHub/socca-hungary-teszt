<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../headers/header.php");
    ?>

<?php
$id = $_GET['id'];
if ($id) {
    include("../../connect.php");
    $sqlEdit = "SELECT * FROM news WHERE id = $id";
    $result = mysqli_query($conn, $sqlEdit);
} else {
    echo "Nincs ilyen poszt";
}

?>
<form action="./news_process.php" method="post" class="news-container">
    <?php
    while ($data = mysqli_fetch_array($result)) {
    ?>
        <input type="text" name="title" id="" placeholder="Cím" value="<?php echo $data['title']; ?>">
        <textarea name="summary" cols="30" rows="10" placeholder="Összefoglaló"><?php echo $data['summary']; ?></textarea>
        <textarea name="content" cols="30" rows="10" placeholder="Poszt"><?php echo $data['content']; ?></textarea>
        <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" value="Elküldés" name="update">
    <?php
    }
    ?>
</form>

<style>
    .news-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
        padding: 30px;
        background-color: #252525;
        width: 100vw;
    }

    .news-container input,
    textarea {
        font-size: 14pt;
        border: none;
        padding: 10px;
        border-radius: 8px;
        max-width: 800px;
        resize: vertical;
    }
</style>

<?php
include("../headers/footer.php");
?>