<?php
session_start();
unset($_SESSION['login']);
session_destroy();

$log    =   date(" Y-m-d H:i:s ") . " SIKERES KIjelentkezés a(z) {$email} címről ({$_SERVER['REMOTE_ADDR']}) \n";
file_put_contents("log.txt", $log, FILE_APPEND);

header("Location:login.php");
