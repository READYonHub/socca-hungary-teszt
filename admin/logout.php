<?php
session_start();
unset($_SESSION['login']);
session_destroy();
$email = $_SESSION['email'];
//log
$log_datum      =   date("Y-m-d H:i:s");;
$log_allapot    =   "SIKERES";
$log_muvelet    =   "Kijelentkezés";
$log_email      =   $_SESSION['email'];
$log_cim        =   $_SERVER['REMOTE_ADDR'];

//$log    =   $log_datum . "\t" . $log_allapot . "\t" . $log_muvelet . "\t" . $log_email . "\t" . " címről (" . $log_cim . ") \n";

//LOG BESZURASA ADATBÁZISBA
$sqlInsert = "INSERT INTO logs(timestamp, state, action, email, ip_address) VALUES ('$log_datum', '$log_allapot','$log_muvelet', '$log_email', '$log_cim' )";
include("../connect.php");
mysqli_query($conn, $sqlInsert);


//$log    =   date(" Y-m-d H:i:s ") . " SIKERES Kijelentkezés a(z) {$email} címről ({$_SERVER['REMOTE_ADDR']}) \n";
//file_put_contents("log.txt", $log, FILE_APPEND);

header("Location: ./login.php");
