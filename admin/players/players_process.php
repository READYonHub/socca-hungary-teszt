<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
}

if (isset($_POST["create"])) {
    include("../../connect.php");

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $registration_number = mysqli_real_escape_string($conn, $_POST["registration_number"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
    $date = mysqli_real_escape_string($conn, $_POST["validity_date"]);
    $profile_pic = time() . $_FILES["profile_pic"]["name"]; // Corrected index


    // név ellenőrzés
    if (isset($name)) {
        $nev_OK = 0;
        // ha név tartalmaz 3-nál több szóközt
        if (preg_match('/^\s*(?:\S+\s+){3,}\S*$/', $name)) {
?>
            <script>
                alert("Hiba: A név nem tartalmazhat 3-nál több szóközt!");
                window.location.href = "./players_create.php";
            </script>
        <?php
            $nev_OK = 0;
        }

        // csak kis- és nagybetűket tartalmaz
        elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) { ?>
            <script>
                alert("Hiba: A név csak kisbetűket és nagybetűket tartalmazhat!");
                window.location.href = "./players_create.php";
            </script>
        <?php
            $nev_OK = 0;
        }

        // minden ok
        else {
            $nev_OK = 1;
        }
    }

    //sorszám ellenőrzés
    if (isset($registration_number)) {
        $sql = "SELECT * FROM players_data WHERE registration_number = '$registration_number'";
        $sorszam_egyezes = mysqli_query($conn, $sql);
        $sorszam_OK = 0;
        if (mysqli_num_rows($sorszam_egyezes) > 0) {
            $sorszam_OK = 1;
            //ha létezik már a sorszám
        ?>
            <script>
                alert("Ez a sorszám már használatban van!");
                window.location.href = "./players_create.php";
            </script>
        <?php
        }
    }

    //validity_date ellenőrzés
    if (isset($date)) {
        $ervenyesseg_OK = 0;

        // Az aktuális dátum timestampje
        $today_timestamp = strtotime(date("Y-m-d"));

        // A megadott dátum timestampje
        $selected_date_timestamp = strtotime($date);

        // Az aktuális dátumtól egy évvel korábbi timestamp
        $min_validity_date_timestamp = strtotime('-1  year', $today_timestamp);

        // Az aktuális dátumhoz 24 év hozzáadása
        $max_validity_date_timestamp = strtotime('+24 year', $today_timestamp);

        if ($selected_date_timestamp < $min_validity_date_timestamp) {
            $ervenyesseg_OK = 0;
        ?>
            <script>
                alert("Hiba: A megadott érvényesség dátuma túl korai!");
                window.location.href = "./players_create.php";
            </script>
        <?php
        } elseif ($selected_date_timestamp > $max_validity_date_timestamp) {
            $ervenyesseg_OK = 0;
        ?>
            <script>
                alert("Hiba: A megadott érvényesség dátuma túl késői!");
                window.location.href = "./players_create.php";
            </script>
            <?php
        } else {
            $ervenyesseg_OK = 1;
        }
    }

    //Kép feltöltés és ellenőrzés
    if (isset($profile_pic) && $nev_OK == 1 && $sorszam_OK == 0 && $ervenyesseg_OK == 1) {

        if (move_uploaded_file(
            $_FILES["profile_pic"]["tmp_name"], // Corrected index
            $_SERVER["DOCUMENT_ROOT"] . '/socca-hungary-teszt/admin/images/palyers_profile_pic/' . $profile_pic
        )) {

            $pic_uploaded = 0;
            $target_file    =   $_SERVER['DOCUMENT_ROOT'] . '/socca-hungary-teszt/admin/images/palyers_profile_pic/' . $profile_pic;
            $imageFileType  =   strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $picname        =   basename($_FILES["profile_pic"]["name"]);
            $photo          =   time() . $picname;
            if (
                $imageFileType != "jpg" && $imageFileType != "jpeg" &&
                $imageFileType != "png"
            ) {
                $pic_uploaded = 0;  ?>
                <script>
                    alert("Csak a .jpg/.jpeg/.png típusú képeket tölthetsz fel!");
                </script>
            <?php
            } else if ($_FILES["profile_pic"]["size"] > 5000000) {
                $pic_uploaded = 0; ?>
                <script>
                    alert("A kép mérete meghaladja a maximum méretet!");
                </script>
<?php } else {
                $pic_uploaded = 1;
            }
        }
    }


    if ($pic_uploaded == 1 && $nev_OK == 1 && $sorszam_OK == 0 && $ervenyesseg_OK == 1) {

        $sqlInsert = "INSERT INTO players_data(name, registration_number, status, validity_date, profile_pic) VALUES ('$name', '$registration_number','$status','$date', '$profile_pic')";

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