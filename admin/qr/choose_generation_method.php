<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit; // Fontos az exit, hogy ne folytatódjon a kód futása
}

include("../headers/header.php");
?>

<div class="choose-generation-method">
    <h2>Válasszon generálási módot:</h2>
    <ul>
        <li><a href="../qr/qr_code_generator_algoritmus.php?type=health&player_id=<?php echo $_GET["player_id"]; ?>">Egészségügyi adatok alapján</a></li>
        <li><a href="../qr/qr_code_generator_algoritmus.php?type=data&player_id=<?php echo $_GET["player_id"]; ?>">Játékos adatai alapján</a></li>
    </ul>
</div>

<?php
include("../headers/footer.php");
?>