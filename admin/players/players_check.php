<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
<?php
include("../templates/players_header.php");
?>

<div class="post w-100 bg-light p-5">
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

<?php
include("../templates/footer.php");
?>