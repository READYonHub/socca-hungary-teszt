<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vezérlőpult</title>
    <style>
        <?php print include("../headers/css/header.css") ?>
    </style>
</head>

<body>
    <div class="main">
        <div class="container">
            <h1 class="dashboard"><a href="../panels/dashboard_panel.php">Vezérlőpult</a></h1>
            <div class="menu-container">
                <!--ADMINISTRATION-->
                <a href="../panels/admin_panel.php" class="admin">Adminisztrátor</a>
                <!--NEWS-->
                <a href="../panels/news_panel.php" class="news">Hírek</a>
                <!--PLYAER-->
                <a href="../panels/players_panel.php" class="players">Játékosok</a>
            </div>
            <!-- LOGOUT -->
            <div class="logged">
                <a href="../logout.php" class="logout">Kijelentkezés</a>
                <div class="logged-user">
                    <span class="in-as">Bejelentkezve mint:</span>
                    <span id="user"><?php print $_SESSION["email"] ?></span>
                </div>
            </div>
        </div>