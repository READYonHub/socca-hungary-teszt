
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
            header("Location:../players_panel.php");
        } else {
            die("Data is not inserted!");
        }
    }
    ?>

<?php
if (isset($_POST["update"])) {
    include("../../connect.php");
    //$name = mysqli_real_escape_string($conn, $_POST["name"]);
    //$registration_number = mysqli_real_escape_string($conn, $_POST["registration_number"]);
    $blood_group = mysqli_real_escape_string($conn, $_POST["blood_group"]);
    $drug_allergies = mysqli_real_escape_string($conn, $_POST["drug_allergies"]);
    $chronic_illness = mysqli_real_escape_string($conn, $_POST["chronic_illness"]);
    // $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $id = mysqli_real_escape_string($conn, $_POST["player_id"]);

    $sqlUpdatePlayersHealth = "UPDATE players_health SET blood_group = '$blood_group', drug_allergies = '$drug_allergies', chronic_illness = '$chronic_illness' WHERE player_id = $id";

    if (mysqli_query($conn, $sqlUpdatePlayersHealth)) {

        session_start();
        $_SESSION["update"] = "Post updated successfully";
        header("Location:../players_panel.php");
    } else {
        mysqli_rollback($conn);
        die("Data is not updated in players_health table!");
    }
}
?>