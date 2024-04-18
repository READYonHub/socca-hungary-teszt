<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../headers/header.php");
    ?>

<?php
$id = $_GET['id'];
if ($id) {
    include("../../connect.php");
    $sqlEdit = "SELECT * FROM players_data WHERE player_id = $id";
    $result = mysqli_query($conn, $sqlEdit);
} else {
    echo "Player not found";
}

?>
<form action="./players_process.php" class="player-edit-container" method="post" enctype="multipart/form-data">
    <?php
    while ($data = mysqli_fetch_array($result)) {
    ?>

        <input type="text" name="name" placeholder="Név" value="<?php echo $data['name']; ?>" required>

        <input name="registration_number" placeholder="Sorszám" value="<?php echo $data['registration_number']; ?>" required>

        <input type="date" name="date" class="form-control" id="date" placeholder="Add meg a dátumot:" value="<?php echo $data['validity_date']; ?>"required>

        <select name="status" id="status" required>
            <option value="Érvényes">Érvényes</option>
            <option value="Eltiltva">Eltiltva</option>
        </select>

        <input type="file" name="profile_pic" class="form-control" id="" placeholder="Játékoskép" value="<?php echo $data['profile_pic']; ?>" required></input>

        <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">
        <input type="hidden" name="player_id" value="<?php echo $id; ?>">

        <input type="submit" value="Frissítés" name="update">

    <?php
    }
    ?>
</form>

<style>
    .player-edit-container {
        display: flex;
        flex-direction: column;
        align-items: baseline;
        height: 100vh;
        width: 100vw;
        background-color: #252525;
        padding: 30px;
        gap: 30px;
    }

    .player-edit-container input, select {
        font-size: 14pt;
        border: none;
        padding: 10px;
        border-radius: 8px;
        max-width: 300px;
        width: 100%;
        max-height: 40px;
        resize: none;
    }
</style>
<?php
include("../headers/footer.php");
?>