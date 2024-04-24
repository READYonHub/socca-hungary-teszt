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

    .p-edit-container input[type="submit"] {
        padding: 10px;
        border: none;
        border-radius: 4px;
        font-weight: bold;
    }

    .p-edit-container input[type="submit"]:hover {
        filter: brightness(.9);
    }
</style>
<form action="./players_process.php" class="p-edit-container" method="post" enctype="multipart/form-data">
    <h1>Játékos módosítása</h1>

    <?php
    while ($data = mysqli_fetch_array($result)) {
    ?>
        <!---------------------------------------JÁTÉKOS NEVE--------------------------------------->
        <label for="name">Név:</label>
        <input type="text" name="name" id="name" placeholder="Név..." value="<?php echo $data['name']; ?>" required>

        <!---------------------------------------JÁTÉKOS SORSZÁMA--------------------------------------->
        <label for="registration_number">Sorszám:</label>
        <input name="registration_number" id="registration_number" placeholder="Sorszám..." value="<?php echo $data['registration_number']; ?>" required>

        <!---------------------------------------ÉRVÉNYESSÉG DÁTUMA--------------------------------------->
        <label for="validity_date">Érvényesség dátuma:</label>
        <input type="date" name="validity_date" id="validity_date" placeholder="Érvényesség dátuma..." value="<?php echo $data['validity_date']; ?>" required>

        <!---------------------------------------JÁTÉKOS STÁTUSZA--------------------------------------->
        <label for="status" required>Státusz:</label>
        <select name="status" id="status">
            <?php
            $possible_statuses = array("érvényes", "eltiltva", "érvényletelen");
            $sqlEdit = "SELECT status FROM players_data WHERE player_id = $id";
            $result = mysqli_query($conn, $sqlEdit);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $db_status = $row['status'];
                if (in_array($db_status, $possible_statuses)) {
                    echo "<option value='$db_status' selected>$db_status</option>";
                }
            }
            foreach ($possible_statuses as $status) {
                if ($status !== $db_status) {
                    echo "<option value='$status'>$status</option>";
                }
            }
            ?>
        </select>

        <!---------------------------------------ELTILTÁS VÉGÉNEK DÁTUMA (HA VAN)--------------------------------------->
        <label for="new_suspension_end_date">Eltiltás végének dátuma (ha van):</label>
        <input type="date" name="new_suspension_end_date" id="new_suspension_end_date" placeholder="Eltiltás vágének dátuma..." value="<?php echo $data['suspension_end_date']; ?>">

        <!---------------------------------------JÁTÉKOS PROFILKÉP--------------------------------------->
        <label for="old_profile_pic">Játékos profilkép:</label>
        <input type="text" name="old_profile_pic" id="old_profile_pic" value="<?php echo isset($data['profile_pic']) ? $data['profile_pic'] : ''; ?>" readonly>

        <label for="new_profile_pic">Új kép:</label>
        <input type="file" id="new_profile_pic" name="new_profile_pic">

        <!---------------------------------------MÓDOSÍTÁS DÁTUMA--------------------------------------->
        <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>">

        <!---------------------------------------AKTUÁLIS JÁTÉKOS AZONOSÍTÓJA--------------------------------------->
        <input type="hidden" name="player_id" value="<?php echo $id; ?>">

        <!---------------------------------------KÜLDÉS--------------------------------------->
        <input type="submit" value="Frissítés" name="update">

    <?php
    }
    ?>
</form>

<?php
include("../headers/footer.php");
?>