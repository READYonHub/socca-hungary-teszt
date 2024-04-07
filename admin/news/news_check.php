<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../headers/header.php");
    ?>

<div class="pev-container">
    <a href="./news_existing.php" class="back-btn">Vissza</a>

    <?php
    $id = $_GET["id"];
    if ($id) {
        include("../../connect.php");
        $sqlSelectPost = "SELECT * FROM news WHERE id = $id";
        $result = mysqli_query($conn, $sqlSelectPost);
        while ($data = mysqli_fetch_array($result)) {
    ?>
            <h1><?php echo  $data['title']; ?></h1>
            <p><?php echo $data['date']; ?></p>
            <p><?php echo $data['content']; ?></p>
    <?php
        }
    } else {
        echo "Post Not Found";
    }
    ?>
</div>

<style>
    .back-btn {
        color: gray;
        text-decoration: none;
        width: min-content;
    }

    .back-btn:hover {
        text-decoration: underline;
    }

    .pev-container {
        display: flex;
        padding: 30px;
        background-color: #252525;
        flex-direction: column;
        gap: 15px;
        color: #fff;
        width: 100vw;
    }
</style>

<?php
include("../headers/footer.php");
?>