<?php
/* Lapvédelem */
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>
<!--Művelet értesítők create/edit/delete-->
<?php
$muvelet_ertesito   =   '
if (isset($_SESSION["create"])) {
?>
    <div class="alert alert-success">
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
    <div class="alert alert-success">
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
    <div class="alert alert-success">
        <?php
        echo $_SESSION["delete"];
        ?>
    </div>
<?php
    unset($_SESSION["delete"]);
}';
?>
<style>
    .admin-manager-container {
        display: flex;
        flex-direction: column;
        align-items: baseline;
        justify-content: baseline;
        padding: 30px;
        width: 100%;
        background-color: #303030;
        color: #fff;
    }

    .admin-table {
        border-collapse: collapse;
    }

    .admin-table,
    th,
    td {
        padding: 10px;
    }

    .admin-table tr:nth-child(even) {
        background-color: #212121;
    }

    .admin-table,
    th {
        border: 2px solid transparent;
    }

    .delete {
        color: rgb(200, 0, 0);
        text-decoration: none;
        font-weight: bold;
    }

    .delete:hover {
        text-decoration: underline;
    }

    .notice {
        background-color: #131313;
        padding: 10px;
        margin-top: 10px;
        font-size: 10pt;
        text-align: justify;
        max-width: 400px;
        color: rgb(200, 0, 0);
        font-weight: bold;
        border-radius: 7px;
        border: 1px solid rgb(200, 0, 0);
    }
</style>
<div class="admin-manager-container">
    <h2>Hozzáférések kezelése</h2>
    <div class="notice">
        Csak olyan embereknek adjon hozzáférést akikben megbízik! A hozzáféréssel rendelkező emberek szintén képesek további hozzáféréseket adni!
    </div>
    <?php
    if (isset($_SESSION["create"])) {
    ?>
        <div class="alert alert-success">
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
        <div class="alert alert-success">
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
        <div class="alert alert-success">
            <?php
            echo $_SESSION["delete"];
            ?>
        </div>
    <?php
        unset($_SESSION["delete"]);
    }
    ?>
    <table class="admin-table">
        <tr>
            <th>Létrehozás dátuma</th>
            <th>ID</th>
            <th>Adminisztrátor</th>
            <th>Művelet</th>
        </tr>
        <?php
        include('../../connect.php');
        $sqlSelect = "SELECT id_adm, email, date FROM admin_default";
        $result = mysqli_query($conn, $sqlSelect);
        while ($data = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $data["date"] ?></td>
                <td><?php echo $data["id_adm"] ?></td>
                <td><?php echo $data["email"] ?></td>
                <td>
                    <a class="delete" onclick="return confirm('Biztosan eltávolítja az ADMINISZTRÁTORT a rendszerből?');" href="../../admin/admin_def/admin_delete.php?id_adm=<?php echo $data["id_adm"] ?>">
                        Törlés
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>