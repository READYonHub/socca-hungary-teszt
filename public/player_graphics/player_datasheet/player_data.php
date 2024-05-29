<?php
session_start();
include("../../../connect.php");
include("../../../admin/constans.php");

if (isset($_SESSION['player_id'], $_SESSION['name'], $_SESSION['registration_number'])) {

    $player_id = $_SESSION['player_id'];

    $sql = "SELECT * FROM `players_data`
            WHERE `player_id` = {$player_id}";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $registration_number = $row['registration_number'];
        $validity_date = new DateTime($row['validity_date']);
        $validity_date = $validity_date->format('Y-m-d');
        $status = $row['status'];
        $player_profile_pic = $row['profile_pic'];

        $player_profile_pic_path = "http://" . $domain . "/socca-hungary-teszt/admin/images/palyers_profile_pic/" . $player_profile_pic;

        $template = file_get_contents("player_data.html");

        $template = str_replace("{{name}}", $name, $template);
        $template = str_replace("{{registration_number}}", $registration_number, $template);
        $template = str_replace("{{validity_date}}", $validity_date, $template);
        $template = str_replace("{{status}}", $status == "érvényes" ? "<span id=\"status-green\">Érvényes</span>" : "<span id=\"status-red\">Érvénytelen</span>", $template);
        $template = str_replace("{{player_profile_pic}}", $player_profile_pic_path, $template);

        $sql = "SELECT pd.name, ph.blood_group, ph.drug_allergies 
                FROM players_health ph 
                INNER JOIN players_data pd 
                ON pd.player_id = ph.player_id 
                WHERE ph.player_id = {$player_id} 
                LIMIT 1";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $blood_group = $row['blood_group'];
            $drug_allergies = $row['drug_allergies'];

            $template = str_replace("{{blood_group}}", $blood_group, $template);
            $template = str_replace("{{drug_allergies}}", $drug_allergies, $template);
        } else {
            // Replace placeholders with default values if no health data found
            $template = str_replace("{{blood_group}}", "Nincs rögzítve", $template);
            $template = str_replace("{{drug_allergies}}", "Nincs rögzítve", $template);
        }

        echo $template;
    }
} else {
    echo "Hiányzó vagy érvénytelen adatok!";
}

mysqli_close($conn);
?>
