<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;

$id = $_GET["player_id"]; // A GET paraméterből kinyerjük a játékos azonosítóját
$type = $_GET["type"]; // Az adatok alapján QR kód generálás típusa
<<<<<<< HEAD
=======
$ip = "192.168.1.181";

>>>>>>> e941a7f479aa282ceb56ca3fe6036a0f72f03b65
require "vendor/autoload.php";

include("../constans.php");
$url    =   "http://".$domain."/socca-hungary-teszt/admin/player_graphics/player_graphics_process.php?hi=";

if ($id && $type) { // Ellenőrizzük, hogy a GET paraméterek megfelelőek-e
    require_once("../../connect.php"); // Adatbázis kapcsolat létrehozása

    // Lekérdezés összeállítása az adott játékos adatainak lekérdezésére
    if ($type === 'health') {
        // Ha az egészségügyi adatokat használjuk a QR kód generálásához
        $sql = "SELECT pd.player_id, pd.name, pd.registration_number, ph.record_id, ph.blood_group, ph.drug_allergies, ph.chronic_illness
                FROM players_data pd
                LEFT JOIN players_health ph
                ON pd.player_id = ph.player_id
                WHERE pd.player_id = {$id}";
    } else {
        // Ha az általános adatokat használjuk a QR kód generálásához
        $sql = "SELECT player_id, name, registration_number
                FROM players_data
                WHERE player_id = {$id}";
    }

    // Lekérdezés végrehajtása
    $result = mysqli_query($conn, $sql);

    // Ellenőrizzük, hogy van-e eredmény a lekérdezésben
    if (mysqli_num_rows($result) > 0) {
        // Ha van eredmény, akkor kinyerjük az adatokat és létrehozzuk a QR kódot
        $row = mysqli_fetch_assoc($result);

        // QR kód adatok összeállítása az adatok alapján
        if ($type === 'health') {
            // Ha az egészségügyi adatokat használjuk
            $qr_id = $url . sha1((string) $row['player_id'] . '' . str_replace(' ', '', $row['name']) . '' . $row['record_id'] . 'ph');
        } else {
            // Ha az általános adatokat használjuk
            $qr_id = $url . sha1((string) $row['player_id'] . '' . str_replace(' ', '', $row['name']) . '' . $row['registration_number'].'pd');
        }

        // QR kód létrehozása az adatok alapján
        $qr_code = QrCode::create($qr_id)
            ->setSize(600)
            ->setMargin(40)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // QR kód írása PNG formátumban
        $writer = new PngWriter;
        $result = $writer->write($qr_code);

        // HTTP fejléc beállítása a PNG típusra
        header("Content-Type:" . $result->getMimeType());

        // PNG adatok kiírása
        echo $result->getString();
    } else {
        // Ha nincs eredmény a lekérdezésben
        echo "Nincs megfelelő adat a megadott játékoshoz!";
    }
} else {
    // Ha hiányzik a player_id vagy a type GET paraméter
    echo "Hiányzó vagy érvénytelen paraméterek!";
}
