<?php
include("../headers/header.php");
?>

<style>
    .action-container {
        display: flex;
        width: 100%;
    }
</style>
<div class="action-container">
    <?php include("../admin_def/admin_create.php") ?>
    <?php include("../admin_def/admin_manager.php") ?>
</div>

<?php
include("../headers/footer.php");
?>