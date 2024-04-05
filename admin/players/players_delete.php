
<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
<?php
$id = $_GET["id"];
if ($id) {
    include("../../connect.php");
    $sqlDelete = "DELETE FROM players_data WHERE player_id = $id";
    if (mysqli_query($conn, $sqlDelete)) {
        session_start();
        $_SESSION["delete"] = "Player deleted successfully";
        header("Location:players_existing.php");
    } else {
        die("Something is not write. Data is not deleted");
    }
} else {
    echo "Player not found";
}
