<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../templates/players_header.php");
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
<div class="create-form w-100 mx-auto p-4" style="max-width:700px;">
    <form action="./players_process.php" method="post">
        <?php
        while ($data = mysqli_fetch_array($result)) {
        ?>

            <div class="form-field mb-4">
                <input type="text" class="form-control" name="name" id="" placeholder="Enter Title:" value="<?php echo $data['name']; ?>">
            </div>
            <div class="form-field mb-4">
                <textarea name="registration_number" class="form-control" id="" cols="30" rows="10" placeholder="Enter Summary:"><?php echo $data['registration_number']; ?></textarea>
            </div>
            <div class="form-field mb-4">
                <textarea name="status" class="form-control" id="" cols="30" rows="10" placeholder="Enter Post:"><?php echo $data['status']; ?></textarea>
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