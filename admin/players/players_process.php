
<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    if (isset($_POST["create"])) {
        include("../../connect.php");

        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $registration_number = mysqli_real_escape_string($conn, $_POST["registration_number"]);
        $status = mysqli_real_escape_string($conn, $_POST["status"]);
        $date = mysqli_real_escape_string($conn, $_POST["date"]);
        $sqlInsert = "INSERT INTO players_data(name, registration_number, status) VALUES ('$name', '$registration_number','$status' )";
        if (mysqli_query($conn, $sqlInsert)) {
            session_start();
            $_SESSION["create"] = "Player added successfully";
            header("Location:../panels/players_panel.php");
        } else {
            die("Data is not inserted!");
        }
    }
    ?>

<?php
if (isset($_POST["update"])) {
    include("../../connect.php");
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $registration_number = mysqli_real_escape_string($conn, $_POST["registration_number"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
    // $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $id = mysqli_real_escape_string($conn, $_POST["player_id"]);
    $sqlUpdate = "UPDATE players_data SET name = '$name', registration_number = '$registration_number', status = '$status' WHERE player_id = $id";
    if (mysqli_query($conn, $sqlUpdate)) {
        session_start();
        $_SESSION["update"] = "Post udpated successfully";
        header("Location:../panels/players_panel.php");
    } else {
        die("Data is not updated!");
    }
}
?>