<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
<?php
include("../templates/players_header.php");
?>
<div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
    <form action="./players_process.php" method="post">
        <div class="form-field mb-4">
            <label for="name"><strong>Név:</strong></label>
            <input type="text" class="form-control" name="name" id="" placeholder="Add meg a Játékos nevét::">
        </div>
        <div class="form-field mb-4">
            <label for="name"><strong>Sorszám:</strong></label>
            <input type="number" name="registration_number" class="form-control" id="" placeholder="Add meg a Játékos SZORSZÁMÁT:"></input>
        </div>
        <div class="form-field mb-4">
            <label for="name"><strong>Érvényesség Dátumát:</strong></label>
            <input type="date" name="validity_date" class="form-control" id="" placeholder="Add meg a Játékos ÉRVÉNYESSÉGÉNEK a DÁTUMÁT:"></input>
        </div>
        <div class="form-field mb-4">
            <label for="name"><strong>Státusz:</strong></label>
            <input name="status" class="form-control" id="" placeholder="Add meg a Játékos STÁTUSZÁT:"></input>
        </div>
        <div class="form-field mb-4">
            <label for="name"><strong>Játékos Eltiltásának Határideje:</strong></label>
            <input type="date" name="status" class="form-control" id="" placeholder="Add meg a Játékos Meddig legyen eltiltva:"></input>
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