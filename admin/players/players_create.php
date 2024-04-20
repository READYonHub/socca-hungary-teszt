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
    <input type="text" name="name" id="name" placeholder="Név" required>

    <label for="registration_number">Sorszám:</label>
    <input type="number" name="registration_number" id="registration_number" placeholder="Sorszám" required></input>

    <label for="validity_date">Érvényesség dátuma:</label>
    <input type="date" name="validity_date" id="validity_date" placeholder="Érvényesség dátuma" required></input>

    <!--<input name="status"  id="" placeholder="Státusz" required></input>-->
    <label for="status">Státusz:</label>
    <select name="status" id="status">
        <option id="status" value="érvényes">érvényes</option>
        <option id="status" value="eltiltva">eltiltva</option>
        <option id="status" value="érvényletelen">érvényletelen</option>
    </select>

    <label for="suspension_end_date">Eltiltás vágének dátuma (ha van):</label>
    <input type="date" name="suspension_end_date" id="suspension_end_date" placeholder="Eltiltás vágének dátuma"></input>

    <label for="profile_pic">Játékos profilkép:</label>
    <input type="file" name="profile_pic" id="profile_pic" placeholder="Játékoskép" required></input>

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