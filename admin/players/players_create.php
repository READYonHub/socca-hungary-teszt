<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
<?php
include("../headers/header.php");
?>
<form action="./players_process.php" method="post" enctype="multipart/form-data" autocomplete="off" class="p-container">
    <h1>Játékos hozzáadása</h1>
    <label for="name">Név:</label>
    <input type="text" class="form-control" name="name" id="" placeholder="Név" required>
    <label for="name">Sorszám:</label>
    <input type="number" name="registration_number" class="form-control" placeholder="Sorszám" required></input>
    <label for="name">Érvényesség dátuma:</label>
    <input type="date" name="validity_date" class="form-control" id="" placeholder="Érvényesség dátuma" required></input>
    <!--<input name="status" class="form-control" id="" placeholder="Státusz" required></input>-->
    <label for="name">Státusz:</label>
    <select name="status" id="status">
        <option id="status" value="érvényes">érvényes</option>
        <option id="status" value="eltiltva">eltiltva</option>
        <option id="status" value="érvényletelen">érvényletelen</option>
    </select>
    <label for="name">Eltiltás vágének dátuma (ha van):</label>
    <input type="date" name="status" class="form-control" id="" placeholder="Eltiltás vágének dátuma"></input>
    <label for="name">Játékos profilkép:</label>
    <input type="file" name="profile_pic" class="form-control" id="" placeholder="Játékoskép" required></input>
    <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">

    <input type="submit" class="btn btn-primary" value="Submit" name="create">
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
</style>

<?php
include("../headers/footer.php");
?>