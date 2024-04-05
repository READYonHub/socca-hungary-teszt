<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../templates/players_header.php");
    ?>
<div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
    <form action="./players_health_process.php" method="post">
        <div class="form-field mb-4">
            <input type="text" class="form-control" name="blood_group" id="" placeholder="Add meg a Játékos vércsoportját:">
        </div>
        <div class="form-field mb-4">
            <textarea name="drug_allergies" class="form-control" id="" cols="30" rows="10" placeholder="Enter Summary:"></textarea>
        </div>
        <div class="form-field mb-4">
            <textarea name="status" class="form-control" id="" cols="30" rows="10" placeholder="Enter Post:"></textarea>
        </div>
        <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">

        <div class="form-field">
            <input type="submit" class="btn btn-primary" value="Submit" name="create">
        </div>
    </form>
</div>
<?php
include("../templates/footer.php");
?>