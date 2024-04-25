<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
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

    .p-container input[type="submit"] {
        padding: 10px;
        border: none;
        border-radius: 4px;
        font-weight: bold;
    }

    .p-container input[type="submit"]:hover {
        filter: brightness(.9);
    }
</style>
<?php
include("../headers/header.php");
?>
<form action="./players_process.php" method="post" enctype="multipart/form-data" autocomplete="off" class="p-container">
    <h1>Játékos hozzáadása</h1>

    <label for="name">Név:</label>
    <input type="text" name="name" id="name" placeholder="Név" required>

    <label for="registration_number">Sorszám:</label>
    <input type="number" name="registration_number" id="registration_number" placeholder="Sorszám" min="0" required></input>

    <label for="validity_date">Érvényesség dátuma:</label>
    <input type="date" name="validity_date" id="validity_date" placeholder="Érvényesség dátuma" required></input>

    <!--<input name="status"  id="" placeholder="Státusz" required></input>-->
    <label for="status" required>Státusz:</label>
    <select name="status" id="status">
        <option id="status" value="érvényes">érvényes</option>
        <option id="status" value="eltiltva">eltiltva</option>
        <option id="status" value="érvénytelen">érvénytelen</option>
    </select>

    <div class="suspDate" id="suspDate" style="display: none;">
        <label for="suspension_end_date">Eltiltás végének dátuma:</label>
        <input type="date" name="suspension_end_date" id="suspension_end_date" placeholder="Eltiltás végének dátuma">
    </div>

    <label for="profile_pic">Játékos profilkép:</label>
    <input type="file" name="profile_pic" id="profile_pic" placeholder="Játékoskép" required></input>

    <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">

    <input type="submit" value="Létrehozás" name="create">
</form>

<script>
    document.getElementById("status").addEventListener("change", function() {
        var status = this.value;
        var suspDateDiv = document.getElementById("suspDate");

        if (status === "eltiltva" || status === "érvénytelen") {
            suspDateDiv.style.display = "flex";
            suspDateDiv.style.flexDirection = "column";
            suspDateDiv.style.gap = "10px";
        } else {
            suspDateDiv.style.display = "none";
        }
    });
</script>
<?php
include("../headers/footer.php");
?>