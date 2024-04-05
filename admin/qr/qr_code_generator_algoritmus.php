<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
<?php
require "vendor/autoload.php";

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;

$id = $_GET["player_id"];
if ($id) {
    require_once("../../connect.php");

    $keresett_Jatekos   =       "";


    $sql    =   "SELECT player_id, name, registration_number
             FROM players_data 
             WHERE player_id = {$id}
             LIMIT 1
             ";

    $eredmeny  =   mysqli_query($conn, $sql);

    while ($sor = mysqli_fetch_assoc($eredmeny)) {

        $qr_id = sha1((string) $sor['player_id'] . '' . str_replace(' ', '', $sor['name']) . '' . $sor['registration_number']);
    }
    echo $qr_id;
    $qr_code    =   QrCode::create($qr_id)
        ->setSize(600)
        ->setMargin(40)
        ->setForegroundColor(new Color(0, 0, 0))
        ->setBackgroundColor(new Color(255, 128, 0));

    $label      =    Label::create("SOCCA-HUNGARY")
        ->setTextColor(new Color(255, 255, 0));

    $logo = Logo::create("./socca_loggo.png")
        ->setResizeToWidth(500);


    $writer     =   new PngWriter;

    $result     =   $writer->write($qr_code, $logo, $label);

    header("Content-Type:" . $result->getMimeType());

    echo $result->getString();
}
