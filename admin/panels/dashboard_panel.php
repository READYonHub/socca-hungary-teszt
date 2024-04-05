
<?php
include("../headers/header.php");

require_once('../../connect.php');

//-------JÁTÉKOSOK SZÁMA
$sql = "SELECT COUNT(name) AS count FROM `players_data`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Jelenlegi Játékosaink száma: {$row['count']}";
} else {
    echo 'Nincsenek Játékosok!';
}

//-------ELTILTOTT JÁTÉKOSOK SZÁMA
$sql = "SELECT COUNT(status) AS eltiltottak FROM players_data WHERE status = 'eltiltva'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "\nJelenleg ELTILTOTT Játékosok száma: {$row['eltiltottak']}";
} else {
    echo 'Nincsenek ELTILTOTT Játékosok!';
}
