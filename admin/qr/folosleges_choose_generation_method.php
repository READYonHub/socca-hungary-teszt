<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit; // Fontos az exit, hogy ne folytatódjon a kód futása
}

include("../headers/header.php");
?>
<style>
    .choose-generation-method {
        display: flex;
        flex-direction: column;
        padding: 30px;
        background-color: #252525;
        color: #fff;
        gap: 15px;
        width: 100vw;
    }

    .choose-generation-method ul li {
        text-decoration: none;
        padding: 10px;
        background-color: #d0d0d7;
        border-radius: 8px;
        color: #000;
        max-width: 300px;
    }


    .choose-generation-method a {
        text-decoration: none;
        padding: 10px;
        background-color: #d0d0d7;
        border-radius: 8px;
        color: #000;
        max-width: 300px;
    }

    .choose-generation-method a:hover {
        filter: brightness(.9);
    }
</style>
<div class="choose-generation-method">
    <h1>Válasszon generálási módot</h1>
    <a href="../qr/qr_code_generator_algoritmus.php?type=health&player_id=<?php echo $_GET["player_id"]; ?>">Egészségügyi adatok alapján</a>
    <a href="../qr/qr_code_generator_algoritmus.php?type=data&player_id=<?php echo $_GET["player_id"]; ?>">Játékos adatai alapján</a>
</div>

<?php
include("../headers/footer.php");
?>