<?php
session_start(); // Munkamenet kezdése

include("../../../connect.php"); // Adatbázis kapcsolat létrehozása

// Ellenőrizzük, hogy a szükséges SESSION változók léteznek-e és nem üresek
if (isset($_SESSION['player_id'], $_SESSION['name'], $_SESSION['registration_number'])) {
    $player_id = $_SESSION['player_id']; // Játékos azonosítójának kiolvasása a SESSION-ből
    include("../../constans.php");
    
    // SQL lekérdezés összeállítása a játékos adatainak lekérdezésére
    $sql = "SELECT * FROM `players_data`
            WHERE `player_id` = {$player_id}";

    // Lekérdezés végrehajtása
    $result = mysqli_query($conn, $sql);

    // Ellenőrizzük, hogy van-e eredmény a lekérdezésben
    if (mysqli_num_rows($result) == 1) {
        // Ha van eredmény, akkor kinyerjük az adatokat
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $registration_number = $row['registration_number'];
        // A validity_date stringből DateTime objektummá alakítása
        $validity_date = new DateTime($row['validity_date']);
        $validity_date = $validity_date->format('Y-m-d'); // Újra formázás stringgé
        $status = $row['status'];
        $player_profile_pic = $row['profile_pic'];

        // Játékos képének az elérési útvonala
        $player_profile_pic_path = "http://".$domain."/socca-hungary-teszt/admin/images/palyers_profile_pic/" . $player_profile_pic;

        // Sablon beolvasása
        $template = file_get_contents("player_data.html");

        // Elemek cseréje a sablonban
        $template = str_replace("{{name}}", $name, $template);
        $template = str_replace("{{registration_number}}", $registration_number, $template);
        $template = str_replace("{{validity_date}}", $validity_date, $template);
        $template = str_replace("{{status}}", $status, $template);
        $template = str_replace("{{player_profile_pic}}", $player_profile_pic_path, $template);

        // Sablon kiírása
        echo $template;
    } else {
        // Nincs találat
        echo "Nincs ilyen játékos az adatbázisban.";
    }
} else {
    // Hiányzó vagy érvénytelen adatok
    echo "Hiányzó vagy érvénytelen adatok!";
}

mysqli_close($conn); // Adatbázis kapcsolat bezárása
