<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
<?php
include("../headers/header.php");
?>

<style>
    .action-container {
        display: flex;
        width: 100%;
        background-color: #303030;
    }

    .message-g {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: center;
        background-color: transparent;
        font-weight: bold;
        position: absolute;
        bottom: 0;
        right: 0;
        margin: 20px;
        padding: 10px;
        background-color: rgb(0, 200, 0);
        border-radius: 8px;
    }

    .message-r {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: center;
        background-color: transparent;
        font-weight: bold;
        position: absolute;
        bottom: 0;
        right: 0;
        margin: 20px;
        padding: 10px;
        background-color: rgb(200, 0, 0);
        border-radius: 8px;
    }
</style>
<div class="action-container">
    <?php include("../admin_def/admin_create.php") ?>
    <?php include("../admin_def/admin_manager.php") ?>
</div>

<?php
include("../headers/footer.php");
?>