<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
}

//------------------------------------Játékos létrehozás-------------------------------
if (isset($_POST["create"])) {
    include("../../connect.php");

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $registration_number = mysqli_real_escape_string($conn, $_POST["registration_number"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
    $date = mysqli_real_escape_string($conn, $_POST["validity_date"]);
    $suspension_end_date    =   mysqli_real_escape_string($conn, $_POST["suspension_end_date"]);
    $profile_pic = time() . $_FILES["profile_pic"]["name"];

    //-----------------------ELLENŐRZÉSEK------------------------------------

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
        elseif (!preg_match('/^[\p{L}\s]+$/u', $name)) { ?>
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

        // Az aktuális dátumtól egy nappal korábbi timestamp
        $min_validity_date_timestamp = strtotime('-1  day', $today_timestamp);

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

    //suspension_end_date ellenőrzés
    if (isset($suspension_end_date)) {
        $eltiltas_vege_OK = 0;

        // Az aktuális dátum timestampje
        $today_timestamp_end = strtotime(date("Y-m-d"));

        // A megadott dátum timestampje
        $selected_date_timestamp_end = strtotime($suspension_end_date);

        // A megengedett minimum dátum: az aktuális dátum
        $min_suspension_end_date_timestamp_end = strtotime('-1 day', $today_timestamp_end);

        // A megengedett maximum dátum: az aktuális dátumhoz fél év hozzáadása
        $max_suspension_end_date_timestamp_end = strtotime('+6 month', $today_timestamp_end);

        if ($selected_date_timestamp_end < $min_suspension_end_date_timestamp_end) {
        ?>
            <script>
                alert("Hiba: A megadott eltiltás dátuma túl korai!");
                window.location.href = "./players_create.php";
            </script>
        <?php
        } elseif ($selected_date_timestamp_end > $max_suspension_end_date_timestamp_end) {
        ?>
            <script>
                alert("Hiba: A megadott eltiltás dátuma túl késői!");
                window.location.href = "./players_create.php";
            </script>
            <?php
        } else {
            if (!(isset($_POST["suspension_end_date"]) && !empty($_POST["suspension_end_date"]))) {
                $suspension_end_date = NULL;
                $eltiltas_vege_OK = 1;
            } else {

                $eltiltas_vege_OK = 1;
            }
        }
    }


    //Kép feltöltés és ellenőrzés
    if (isset($profile_pic) && $nev_OK == 1 && $sorszam_OK == 0 && $ervenyesseg_OK == 1 && $eltiltas_vege_OK == 1) {

        if (move_uploaded_file(
            $_FILES["profile_pic"]["tmp_name"],
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
    //--------------------------------------JÁTÉKOS LÉTREHOZÁSA-------------------------------------
    if ($pic_uploaded == 1 && $nev_OK == 1 && $sorszam_OK == 0 && $ervenyesseg_OK == 1 && $eltiltas_vege_OK == 1) {

        $sqlInsert = "INSERT INTO players_data(name, registration_number, status, validity_date, suspension_end_date, profile_pic) VALUES ('$name', '$registration_number','$status','$date','$suspension_end_date', '$profile_pic')";

        if (mysqli_query($conn, $sqlInsert)) {
            session_start();
            $_SESSION["create"] = "Player added successfully";
            header("Location:../panels/players_panel.php");
        } else {
            die("Data is not inserted!");
        }
    }
}
//------------------------------------------Játékos módosítás-------------------------------------

if (isset($_POST["update"])) {
    include("../../connect.php");
    $id_edit = mysqli_real_escape_string($conn, $_POST["player_id"]);
    $name_edit = mysqli_real_escape_string($conn, $_POST["name"]);
    $registration_number_edit = mysqli_real_escape_string($conn, $_POST["registration_number"]);
    $status_edit = mysqli_real_escape_string($conn, $_POST["status"]);
    $date_edit = mysqli_real_escape_string($conn, $_POST["validity_date"]);
    $suspension_end_date_edit    =   mysqli_real_escape_string($conn, $_POST["suspension_end_date"]);

    //-----------------------ELLENŐRZÉSEK------------------------------------
    $profile_pic_edit = null;

    if (!empty($_FILES['new_profile_pic']['name'])) {
        // Ha új képet választott ki a felhasználó
        $profile_pic_edit = time() . $_FILES["new_profile_pic"]["name"];

        // Kép feltöltése és ellenőrzése
        $target_file = $_SERVER['DOCUMENT_ROOT'] . '/socca-hungary-teszt/admin/images/players_profile_pic/' . $profile_pic_edit;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (
            $imageFileType != "jpg" && $imageFileType != "jpeg" &&
            $imageFileType != "png"
        ) {
            exit("Csak a .jpg/.jpeg/.png típusú képeket tölthetsz fel!");
        } elseif ($_FILES["new_profile_pic"]["size"] > 5000000) {
            exit("A kép mérete meghaladja a maximum méretet!");
        } elseif (!move_uploaded_file($_FILES["new_profile_pic"]["tmp_name"], $target_file)) {
            exit("A kép feltöltése sikertelen.");
        }

        // név ellenőrzés
        if (isset($name_edit)) {
            $nev_edit_OK = 0;
            // ha név tartalmaz 3-nál több szóközt
            if (preg_match('/^\s*(?:\S+\s+){3,}\S*$/', $name_edit)) {
            ?>
                <script>
                    alert("Hiba: A név nem tartalmazhat 3-nál több szóközt!");
                    window.location.href = "./players_edit.php";
                </script>
            <?php
                $nev_edit_OK = 0;
            }

            // csak kis- és nagybetűket tartalmaz
            elseif (!preg_match('/^[\p{L}\s]+$/u', $name_edit)) { ?>
                <script>
                    alert("Hiba: A név csak kisbetűket és nagybetűket tartalmazhat!");
                    window.location.href = "./players_edit.php";
                </script>
            <?php
                $nev_edit_OK = 0;
            }

            // minden ok
            else {
                $nev_edit_OK = 1;
            }
        }

        //sorszám ellenőrzés
        if (isset($registration_number_edit)) {
            $sql = "SELECT * FROM players_data WHERE registration_number = '$registration_number_edit'";
            $sorszam_egyezes = mysqli_query($conn, $sql);
            $sorszam_OK = 0;

            if (mysqli_num_rows($sorszam_egyezes) > 0 && $sorszam_egyezes != $sorszam_egyezes) {
                $sorszam_OK = 1;
                //ha létezik már a sorszám
            ?>
                <script>
                    alert("Ez a sorszám már használatban van!");
                    window.location.href = "./players_edit.php";
                </script>
            <?php
            }
        }

        //validity_date ellenőrzés
        if (isset($date_edit)) {
            $ervenyesseg_OK = 0;

            // Az aktuális dátum timestampje
            $today_timestamp = strtotime(date("Y-m-d"));

            // A megadott dátum timestampje
            $selected_date_timestamp = strtotime($date_edit);

            // Az aktuális dátumtól egy nappal korábbi timestamp
            $min_validity_date_timestamp = strtotime('-1 day', $today_timestamp);

            // Az aktuális dátumhoz 24 év hozzáadása
            $max_validity_date_timestamp = strtotime('+24 year', $today_timestamp);

            if ($selected_date_timestamp < $min_validity_date_timestamp) {
                $ervenyesseg_OK = 0;
            ?>
                <script>
                    alert("Hiba: A megadott érvényesség dátuma túl korai!");
                    //window.location.href = "./players_edit.php";
                    history.back();
                </script>
            <?php
            } elseif ($selected_date_timestamp > $max_validity_date_timestamp) {
                $ervenyesseg_OK = 0;
            ?>
                <script>
                    alert("Hiba: A megadott érvényesség dátuma túl késői!");
                    //window.location.href = "./players_edit.php"; 
                    history.back();
                </script>
            <?php
            } else {
                $ervenyesseg_OK = 1;
            }
        }

        //suspension_end_date ellenőrzés
        if (isset($suspension_end_date_edit)) {
            $eltiltas_vege_OK = 0;

            // Az aktuális dátum timestampje
            $today_timestamp_edit = strtotime(date("Y-m-d"));

            // A megadott dátum timestampje
            $selected_date_timestamp_edit = strtotime($suspension_end_date_edit);

            // A megengedett minimum dátum: az aktuális dátum
            $min_suspension_end_date_timestamp_edit = strtotime('-1 day', $today_timestamp_edit);

            // A megengedett maximum dátum: az aktuális dátumhoz fél év hozzáadása
            $max_suspension_end_date_timestamp_edit = strtotime('+6 month', $today_timestamp_edit);

            if ($selected_date_timestamp_edit < $min_suspension_end_date_timestamp_edit && $selected_date_timestamp_edit != NULL) {
            ?>
                <script>
                    alert("Hiba: A megadott eltiltás dátuma túl korai!");
                    //window.location.href = "./players_edit.php";
                    history.back();
                </script>
            <?php
            } elseif ($selected_date_timestamp_edit > $max_suspension_end_date_timestamp_edit) {
            ?>
                <script>
                    alert("Hiba: A megadott eltiltás dátuma túl késői!");
                    //window.location.href = "./players_edit.php";
                    history.back();
                </script>
                <?php
            } else {
                $eltiltas_vege_OK = 1;
            }
        }

        //Kép feltöltés és ellenőrzés
        $pic_uploaded_edit = 0;
        if (isset($profile_pic_edit) && $nev_edit_OK == 1 && $sorszam_OK == 0 && $ervenyesseg_OK == 1 && $eltiltas_vege_OK == 1) {

            if (move_uploaded_file(
                $_FILES["new_profile_pic"]["tmp_name"],
                $_SERVER["DOCUMENT_ROOT"] . '/socca-hungary-teszt/admin/images/palyers_profile_pic/' . $profile_pic_edit
            )) {

                $target_file    =   $_SERVER['DOCUMENT_ROOT'] . '/socca-hungary-teszt/admin/images/palyers_profile_pic/' . $profile_pic_edit;
                $imageFileType  =   strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $picname        =   basename($_FILES["new_profile_pic"]["name"]);
                $photo          =   time() . $picname;
                if (
                    $imageFileType != "jpg" && $imageFileType != "jpeg" &&
                    $imageFileType != "png"
                ) {
                    $pic_uploaded_edit = 0;  ?>
                    <script>
                        alert("Csak a .jpg/.jpeg/.png típusú képeket tölthetsz fel!");
                    </script>
                <?php
                } else if ($_FILES["new_profile_pic"]["size"] > 5000000) {
                    $pic_uploaded_edit = 0; ?>
                    <script>
                        alert("A kép mérete meghaladja a maximum méretet!");
                    </script>
<?php }
            } else {
                $pic_uploaded_edit = 1;
            }
        }

        //---------------------MÓDOSÍTÁS FELTÖLTÉS  ---------------------------------------------
        // Ha a profil képet és az ellenőrzéseket sikeresen lefuttattuk
        if ($profile_pic_edit !== null) {
            $sqlUpdate = "UPDATE players_data SET name = '$name_edit', registration_number = '$registration_number_edit', status = '$status_edit', validity_date = '$date_edit', suspension_end_date = '$suspension_end_date_edit', profile_pic = '$profile_pic_edit' WHERE player_id = $id_edit";
        } else {
            $sqlUpdate = "UPDATE players_data SET name = '$name_edit', registration_number = '$registration_number_edit', status = '$status_edit', validity_date = '$date_edit', suspension_end_date = '$suspension_end_date_edit' WHERE player_id = $id_edit";
        }

        if (mysqli_query($conn, $sqlUpdate)) {
            $_SESSION["update"] = "Player updated successfully";
            header("Location:../panels/players_panel.php");
            exit();
        } else {
            exit("A játékos adatai nem lettek módosítva!");
        }
    }
}
?>