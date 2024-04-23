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
if (isset($_GET['id'])) {
    $id = $_GET['id'];
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
<form action="./players_health_process.php" class="player-health-edit-container p-container" method="post" autocomplete="off">
    <h1>Játékos egészségügyi adatai</h1>
    <?php
    while ($data = mysqli_fetch_array($result)) {
    ?>
        <!-----------------------Név------------------------------------>
        <label for="name">Név:</label>
        <input type="text" name="name" id="name" value="<?php echo $data['name']; ?>" disabled>

        <!-----------------------Sorszám------------------------------------>
        <label for="registration_number">Sorszám:</label>
        <input type="text" name="registration_number" id="registration_number" value="<?php echo $data['registration_number']; ?>" disabled>

        <!-----------------------Vércsoport------------------------------------>
        <label for="blood_group">Vércsoport:</label>
        <input type="text" name="blood_group" id="blood_group" placeholder="Játékos vércsoportja" value="<?php echo $data['blood_group']; ?>" required>

        <!-----------------------Gyógyszerallergia------------------------------------>
        <label for="blood_group">Gyógyszerallergia:</label>
        <input type="text" name="drug_allergies" id="drug_allergies" placeholder="Játékos gyógyszerallergia" value="<?php echo $data['drug_allergies']; ?>" required>

        <!-----------------------Krónikus betegségek------------------------------------>
        <label for="blood_group">Krónikus betegségek:</label>
        <input type="text" name="chronic_illness" id="chronic_illness" placeholder="Játékos krónikus betegségei" value="<?php echo $data['chronic_illness']; ?>" required>


        <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">
        <input type="hidden" name="player_id" id="player_id" value="<?php echo $id; ?>">

        <br>
        <input type="submit" value="Elküldés" name="update" id="update">

    <?php
    }
    ?>
</form>

<style>
    .p-container {
        display: flex;
        flex-direction: column;
        background-color: #252525;
        width: 100vw;
        gap: 10px;
        padding: 30px;
        color: #fff;
    }

    .p-container h1 {
        margin-bottom: 10px;
    }

    .p-container input {
        padding: 10px;
        max-width: 400px;
        border-radius: 8px;
        border: none;
    }

    .p-container select {
        padding: 10px;
        max-width: 400px;
        border-radius: 8px;
        border: none;
    }

    .player-health-edit-container input[disabled] {
        color: #000;
    }
</style>
<?php
include("../headers/footer.php");
?>