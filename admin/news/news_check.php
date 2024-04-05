<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../templates/news_header.php");
    ?>

<div class="post w-100 bg-light p-5">
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

<?php
include("../templates/footer.php");
?>