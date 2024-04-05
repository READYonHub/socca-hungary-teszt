<?php
/* Lapvédelem */
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
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
</style>
<div class="admin-create-container">
    <h2>Hozzáférés hozzáadása</h2>
    <form action="../../admin/admin_def/admin_process.php" method="post" class="new-admin-form">
        <div class="inputs">
            <input class="inarea" type="text" class="form-control" name="email" placeholder="Hozzáférő E-mail címe">
            <input class="inarea" type="password" name="passwrd" class="form-control" placeholder="Hozzáférő Jelszava">
            <input type="hidden" name="date" value="<?php echo date("Y-m-d H-i-d"); ?>">
            <input type="submit" value="Regisztrálás" name="submit_a">
        </div>
    </form>
</div>