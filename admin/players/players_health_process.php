
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

    $id = mysqli_real_escape_string($conn, $_POST["player_id"]);
    //$name = mysqli_real_escape_string($conn, $_POST["name"]);
    //$registration_number = mysqli_real_escape_string($conn, $_POST["registration_number"]);
    $blood_group = mysqli_real_escape_string($conn, $_POST["blood_group"]);
    $drug_allergies = mysqli_real_escape_string($conn, $_POST["drug_allergies"]);
    $chronic_illness = mysqli_real_escape_string($conn, $_POST["chronic_illness"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);

    // Ellenőrizzük, hogy van-e már egészségügyi rekord az adott játékoshoz
    $checkHealthRecordQuery = "SELECT * FROM players_health WHERE player_id = $id";
    $checkHealthRecordResult = mysqli_query($conn, $checkHealthRecordQuery);
    if (mysqli_num_rows($checkHealthRecordResult) == 0) {
        // Ha még nincs egészségügyi rekord, beszúrjuk az adatokat
        $insertHealthRecordQuery = "INSERT INTO players_health (player_id, blood_group, drug_allergies, chronic_illness, edit_date) VALUES ($id, '$blood_group', '$drug_allergies', '$chronic_illness', '$date')";
        if (mysqli_query($conn, $insertHealthRecordQuery)) {
            // Beszúrás sikeres, folytathatjuk az adatok frissítésével vagy más teendőkkel
        } else {
            // Ha a beszúrás sikertelen, hibát jelezhetünk
            die("Hiba az egészségügyi adatok beszúrásakor: " . mysqli_error($conn));
        }
    }

    // Ezután frissítjük az egészségügyi adatokat
    $sqlUpdatePlayersHealth = "UPDATE players_health SET blood_group = '$blood_group', drug_allergies = '$drug_allergies', chronic_illness = '$chronic_illness', edit_date='$date' WHERE player_id = $id";

    if (mysqli_query($conn, $sqlUpdatePlayersHealth)) {
        session_start();
        $_SESSION["update"] = "A játékos egészségügyi adatai sikeresen módosítva!";
        header("Location:../panels/players_panel.php");
    } else {
        mysqli_rollback($conn);
        die("A játékos egészségügyi adatai sikertelnül módosítva: " . mysqli_error($conn));
    }
}
?>