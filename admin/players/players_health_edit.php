<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
<?php
include("../templates/players_header.php");
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
<div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
    <form action="./players_health_process.php" method="post">
        <?php
        while ($data = mysqli_fetch_array($result)) {
        ?>

            <div class="form-field mb-4">
                <label for="name"><strong>Név:</strong></label>
                <input type="text" class="form-control" name="name" id="" placeholder="Add meg a Játékos NEVÉT:" value="<?php echo $data['name']; ?>" disabled>
            </div>
            <div class="form-field mb-4">
                <label for="registration_number"><strong>Sorszám:</strong></label>
                <input name="registration_number" class="form-control" id="" placeholder="Add meg a Játékos SORSZÁMÁT:" value="<?php echo $data['registration_number']; ?>" disabled>
            </div>
            <div class="form-field mb-4">
                <label for="blood_group"><strong>Vércsoport:</strong></label>
                <textarea name="blood_group" class="form-control" id="" cols="30" rows="10" placeholder="Add meg a Játékos VÉRCSOPORTJÁT:"><?php echo $data['blood_group']; ?></textarea>
            </div>
            <div class="form-field mb-4">
                <label for="drug_allergies"><strong>Gyószerallergia:</strong></label>
                <textarea name="drug_allergies" class="form-control" id="" cols="30" rows="10" placeholder="Add meg a Játékos GYÓGYSZERALLERGIÁJÁT:"><?php echo $data['drug_allergies']; ?></textarea>
            </div>
            <div class="form-field mb-4">
                <label for="drug_allergies"><strong>Krónikus betegség:</strong></label>
                <textarea name="chronic_illness" class="form-control" id="" cols="30" rows="10" placeholder="Add meg a Játékos KRÓNIKUS BETEGSÉGÉT, ha van:"><?php echo $data['chronic_illness']; ?></textarea>
            </div>

            <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">
            <input type="hidden" name="player_id" value="<?php echo $id; ?>">
            <div class="form-field">
                <input type="submit" class="btn btn-primary" value="Submit" name="update">
            </div>

        <?php
        }
        ?>
    </form>
</div>
<?php
include("../templates/footer.php");
?>