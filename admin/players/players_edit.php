<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../headers/header.php");
    ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($id)) {
        include("../../connect.php");
        $sqlEdit = "SELECT * FROM players_data WHERE player_id = $id";
        $result = mysqli_query($conn, $sqlEdit);
    } else {
        echo "Player not found";
    }
}
?>
<form action="./players_process.php" class="p-edit-container" method="post" enctype="multipart/form-data">
    <h1>Játékos módosítása</h1>

    <?php
        while ($data = mysqli_fetch_array($result)) {
    ?>

        <label for="name">Név:</label>
        <input type="text" name="name" id="name" placeholder="Név" value="<?php echo $data['name']; ?>" required>

        <label for="registration_number">Sorszám:</label>
        <input name="registration_number" id="registration_number" placeholder="Sorszám" value="<?php echo $data['registration_number']; ?>" required>

        <label for="validity_date">Érvényesség dátuma:</label>
        <input type="date" name="validity_date" id="validity_date" placeholder="Érvényesség dátuma:" value="<?php echo $data['validity_date']; ?>" required>

        <label for="status" required>Státusz:</label>
        <select name="status" id="status">
            <option id="status" value="érvényes">érvényes</option>
            <option id="status" value="eltiltva">eltiltva</option>
            <option id="status" value="érvényletelen">érvényletelen</option>
        </select>

        <label for="suspension_end_date">Eltiltás vágének dátuma (ha van):</label>
        <input type="date" name="suspension_end_date" id="suspension_end_date" placeholder="Eltiltás vágének dátuma"></input>

        <label for="profile_pic">Játékos profilkép:</label>
        <input type="file" name="profile_pic" id="profile_pic" placeholder="Játékoskép" value="<?php echo $data['profile_pic']; ?>"></input>

        <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">
        <input type="hidden" name="player_id" value="<?php echo $id; ?>">

        <input type="submit" value="Frissítés" name="update">

    <?php
    }
    ?>
</form>

<style>
    .p-edit-container {
        display: flex;
        flex-direction: column;
        background-color: #252525;
        width: 100vw;
        gap: 10px;
        padding: 30px;
        color: #fff;
    }

    .p-edit-container h1 {
        margin-bottom: 10px;
    }

    .p-edit-container input {
        padding: 10px;
        max-width: 400px;
        border-radius: 8px;
        border: none;
    }

    .p-edit-container select {
        padding: 10px;
        max-width: 400px;
        border-radius: 8px;
        border: none;
    }
</style>
<?php
include("../headers/footer.php");
?>