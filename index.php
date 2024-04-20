<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ./admin/login.php");
}
else {
    header("Location: ./admin/login.php");

} ?>