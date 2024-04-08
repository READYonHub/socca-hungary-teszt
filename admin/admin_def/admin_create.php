<?php
/* Lapvédelem */
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>

<!--Művelet értesítők create/edit/delete-->
<?php
if (isset($_SESSION["create"])) {
?>
    <div class="message">
        <?php
        echo $_SESSION["create"];
        ?>
    </div>
<?php
    unset($_SESSION["create"]);
}
?>
<?php
if (isset($_SESSION["update"])) {
?>
    <div class="message">
        <?php
        echo $_SESSION["update"];
        ?>
    </div>
<?php
    unset($_SESSION["update"]);
}
?>
<?php
if (isset($_SESSION["delete"])) {
?>
    <div class="message">
        <?php
        echo $_SESSION["delete"];
        ?>
    </div>
<?php
    unset($_SESSION["delete"]);
}
?>
<style>
    .admin-create-container {
        display: flex;
        justify-content: baseline;
        flex-direction: column;
        width: 100%;
        max-width: 400px;
        background-color: #252525;
        color: #fff;
        padding: 30px;
    }

    .new-admin-form {
        display: flex;
        flex-direction: column;
    }

    .new-admin-form .inarea {
        padding: 8px;
        border-radius: 4px;
        border: none;
    }

    .new-admin-form input[type="submit"] {
        padding: 10px;
        border: none;
        border-radius: 4px;
        font-weight: bold;
    }

    .inputs {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
        gap: 15px;
    }

    .message {
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
</style>
<div class="admin-create-container">
    <h2>Hozzáférés hozzáadása</h2>
    <form action="../../admin/admin_def/admin_process.php" method="post" class="new-admin-form" autocomplete="off">
        <div class="inputs">
            <input class="inarea" type="text" class="form-control" name="email" placeholder="Hozzáférő E-mail címe" required>
            <input class="inarea" type="password" name="passwrd" class="form-control" placeholder="Hozzáférő Jelszava" required>
            <input type="hidden" name="date" value="<?php echo date("Y-m-d H-i-d"); ?>">
            <input type="submit" value="Regisztrálás" name="submit_a">
        </div>
    </form>
</div>