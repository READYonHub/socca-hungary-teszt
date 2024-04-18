<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
<?php
include("../headers/header.php");
?>

<?php
$id = $_GET['id'];
if ($id) {
    include("../../connect.php");
    $sqlEdit = "SELECT pd.player_id, pd.name, pd.registration_number, ph.blood_group, ph.drug_allergies, ph.chronic_illness
                FROM players_data pd
                LEFT JOIN players_health ph
                ON pd.player_id = ph.player_id
                WHERE pd.player_id = $id";
    $result = mysqli_query($conn, $sqlEdit);
} else {
    echo "Player not found";
}

?>
<form action="./players_health_process.php" class="player-health-edit-container" method="post">
    <?php
    while ($data = mysqli_fetch_array($result)) {
    ?>

        <input type="text" name="name" value="<?php echo $data['name']; ?>" disabled>
        <input name="registration_number" value="<?php echo $data['registration_number']; ?>" disabled>

        <input type="text" name="blood_group" placeholder="Játékos vércsoportja"><?php echo $data['blood_group']; ?></input>

        <input type="text" name="drug_allergies" placeholder="Játékos gyógyszerallergia"><?php echo $data['drug_allergies']; ?></input>

        <input type="text" name="chronic_illness" placeholder="Játékos krónikus betegségei"><?php echo $data['chronic_illness']; ?></input>


        <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">
        <input type="hidden" name="player_id" value="<?php echo $id; ?>">
        <input type="submit" value="Elküldés" name="update">

    <?php
    }
    ?>
</form>

<style>
    .player-health-edit-container {
        display: flex;
        flex-direction: column;
        align-items: baseline;
        height: 100vh;
        width: 100vw;
        background-color: #252525;
        padding: 30px;
        gap: 30px;
    }

    .player-health-edit-container input {
        font-size: 14pt;
        border: none;
        padding: 10px;
        border-radius: 8px;
        max-width: 300px;
        width: 100%;
        max-height: 40px;
        resize: none;
    }

    .player-health-edit-container input[disabled] {
        color: #000;
    }
</style>
<?php
include("../headers/footer.php");
?>