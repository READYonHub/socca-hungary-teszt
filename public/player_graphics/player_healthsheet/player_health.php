<?php
session_start(); // Munkamenet kezdése

include("../../../connect.php"); // Adatbázis kapcsolat létrehozása

// Ellenőrizzük, hogy a szükséges SESSION változók léteznek-e és nem üresek
if (isset($_SESSION['player_id'], $_SESSION['name'], $_SESSION['record_id'])) {
    $player_id = $_SESSION['player_id']; // Játékos azonosítójának kiolvasása a SESSION-ből
    include("../../../admin/constans.php");

    // SQL lekérdezés összeállítása a játékos adatainak lekérdezésére
    $sql = "SELECT pd.name, ph.blood_group, ph.drug_allergies 
        FROM players_health ph 
        INNER JOIN players_data pd 
        ON pd.player_id = ph.player_id 
        WHERE ph.player_id = {$player_id} 
        LIMIT 1";

    // Lekérdezés végrehajtása
    $result = mysqli_query($conn, $sql);

    // Ellenőrizzük, hogy van-e eredmény a lekérdezésben
    if (mysqli_num_rows($result) == 1) {
        // Ha van eredmény, akkor kinyerjük az adatokat
        $row = mysqli_fetch_assoc($result);

        $name               = $row['name'];
        $blood_group        = $row['blood_group'];
        $drug_allergies     = $row['drug_allergies'];
        //$chronic_illness    = $row['chronic_illness'];

        // Sablon beolvasása
        $template = file_get_contents("player_health.html");

        // Elemek cseréje a sablonban
        $template = str_replace("{{name}}",                 $name,              $template);
        $template = str_replace("{{blood_group}}",          $blood_group,       $template);
        $template = str_replace("{{drug_allergies}}",       $drug_allergies,    $template);
        //$template = str_replace("{{chronic_illness}}",      $chronic_illness,     $template);


        unset($_SESSION);

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
