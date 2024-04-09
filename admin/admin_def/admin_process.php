<?php
/* Lapvédelem mindig legfelül*/
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
}
?>
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


<?php
if (isset($_POST["submit_a"])) {
    include("../../connect.php");

    $email      =   trim(strip_tags(strtolower(mysqli_real_escape_string($conn, $_POST["email"]))));
    $passwrd    =   trim(strip_tags(sha1(mysqli_real_escape_string($conn, $_POST["passwrd"]))));
    $date       =   mysqli_real_escape_string($conn, $_POST["date"]);

    $sqlCheck   =   "SELECT * FROM admin_default WHERE email = '$email'";
    $result     =   mysqli_query($conn, $sqlCheck);



    if (mysqli_num_rows($result) > 0) {
        echo <<<WARNING
        <script type="text/javascript">
            alert("A megadott E-mail cím már használatban van!");
            window.location.replace("../panels/admin_panel.php");
        </script>
WARNING;
    } else {
        $pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
        if (!preg_match($pattern, $email)) {
            echo <<<WARNING
        <script type="text/javascript">
            alert("Helytelen E-mail cím!");
            window.location.replace("../panels/admin_panel.php");
        </script>
WARNING;
        } else {
            $sqlInsert = "INSERT INTO admin_default(date, email, passwrd) VALUES ('$date','$email', '$passwrd')";

            if (mysqli_query($conn, $sqlInsert)) {
                session_start();
                $_SESSION["submit_a"] = "Administrator added successfully";
                header("Location: ../panels/admin_panel.php");
            } else {
                die("Data is not inserted!");
            }
        }
    }
}
?>