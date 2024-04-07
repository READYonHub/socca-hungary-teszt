<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
}

$pic_uploaded = 0;
if (isset($_POST["create"])) {
    include("../../connect.php");

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $registration_number = mysqli_real_escape_string($conn, $_POST["registration_number"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $profile_pic = time() . $_FILES["profile_pic"]["name"]; // Corrected index

    if (move_uploaded_file(
        $_FILES["profile_pic"]["tmp_name"], // Corrected index
        $_SERVER["DOCUMENT_ROOT"] . '/socca-hungary-teszt/admin/images/palyers_profile_pic/' . $profile_pic
    )) {

        $target_file    =   $_SERVER['DOCUMENT_ROOT'] . '/socca-hungary-teszt/admin/images/palyers_profile_pic/' . $profile_pic;
        $imageFileType  =   strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $picname        =   basename($_FILES["profile_pic"]["name"]);
        $photo          =   time() . $picname;
        if (
            $imageFileType != "jpg" && $imageFileType != "jpeg" &&
            $imageFileType != "png"
        ) { ?>
            <script>
                alert("Csak a .jpg/.jpeg/.png típusú képeket tölthetsz fel!");
            </script>
        <?php
        } else if ($_FILES["profile_pic"]["size"] > 5000000) { ?>
            <script>
                alert("A kép mérete meghaladja a maximum méretet!");
            </script>
<?php } else {
            $pic_uploaded = 1;
        }
    }
    if ($pic_uploaded == 1) {

        $sqlInsert = "INSERT INTO players_data(name, registration_number, status, profile_pic) VALUES ('$name', '$registration_number','$status', '$profile_pic' )";
        if (mysqli_query($conn, $sqlInsert)) {
            session_start();
            $_SESSION["create"] = "Player added successfully";
            header("Location:../panels/players_panel.php");
        } else {
            die("Data is not inserted!");
        }
    }
}

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