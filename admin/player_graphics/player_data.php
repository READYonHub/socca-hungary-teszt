<?php
include("../../connect.php");



$kapott_id  = "758";

$sql    = "SELECT * FROM `players_data`
            WHERE `player_id` = {$kapott_id}";


$eredmeny = mysqli_query($conn, $sql);

/* Létező játékos */
if (mysqli_num_rows($eredmeny) == 1) {
    $sor = mysqli_fetch_assoc($eredmeny);
    $name                       = $sor['name'];
    $registration_number        = $sor['registration_number'];
    // A validity_date stringből DateTime objektummá alakítása
    $validity_date              = new DateTime($sor['validity_date']);
    $validity_date              = $validity_date->format('Y-m-d'); // Újra formázás stringgé
    $status                     = $sor['status'];
    $player_profile_pic         = $sor['profile_pic'];
}
/* NEM létező játékos */ else {
    $name                       = "Nincs ilyen név";
    $registration_number        = "Hiba";
    $validity_date              = "Hiba";
    $status                     = "Hiba";
    $player_profile_pic         = "Hiba";
}
//vagy lehet ide egy header is valami 404-es errorral (.htaccess)

//jatekos képeinek az elérési utvonala
$player_profile_pic_path = "http://localhost/socca-hungary-teszt/admin/images/palyers_profile_pic/" . $player_profile_pic;


//elemek kicserélése
//sablon
$sablon = file_get_contents("player_data.html");
//elemek
$sablon = str_replace("{{name}}",                   $name,                      $sablon);
$sablon = str_replace("{{registration_number}}",    $registration_number,       $sablon);
$sablon = str_replace("{{validity_date}}",          $validity_date,             $sablon);
$sablon = str_replace("{{status}}",                 $status,                    $sablon);
$sablon = str_replace("{{player_profile_pic}}",     $player_profile_pic_path,   $sablon);

print $sablon;
mysqli_close($conn);
