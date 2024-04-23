<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
<?php
include("../headers/header.php");
?>

<div class="players-view-container">
    <a href="./players_existing.php" class="back-btn">Vissza</a>

    <?php
    $id = $_GET["id"];
    if ($id) {
        include("../../connect.php");
        $sqlSelectPost = "SELECT * FROM players_data WHERE player_id = $id";
        $result = mysqli_query($conn, $sqlSelectPost);
        while ($data = mysqli_fetch_array($result)) {
    ?>
            <h1><?php echo  $data['name']; ?></h1>
            <p><?php echo $data['registration_number']; ?></p>
            <p><?php echo $data['status']; ?></p>
    <?php
        }
    } else {
        echo "Player Not Found";
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

    .players-view-container {
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