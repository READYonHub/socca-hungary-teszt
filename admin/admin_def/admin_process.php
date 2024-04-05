<style>
    .alert {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #f2dede;
        color: #a94442;
        border: 1px solid #a94442;
        padding: 15px;
        border-radius: 5px;
        z-index: 9999;
    }
</style>

<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
}

if (isset($_POST["submit_a"])) {
    include("../../connect.php");

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $passwrd = sha1(mysqli_real_escape_string($conn, $_POST["passwrd"]));
    $date = mysqli_real_escape_string($conn, $_POST["date"]);

    $sqlCheck = "SELECT * FROM admin_default WHERE email = '$email'";
    $result = mysqli_query($conn, $sqlCheck);

    if (mysqli_num_rows($result) > 0) {
        echo <<<WARNING
        <div class="alert" role="alert">
            A megadott E-mail cím már használatban van! <button onclick="closeAlert()"><Értettem</button>
        </div>
        <script type="text/javascript">
            function closeAlert() {
                var alertBox = document.querySelector('.alert');
                alertBox.style.display = 'none';
                window.location.href = "../panels/admin_panel.php";
            }
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
?>