<?php
session_start();
$kimenet = "";
$email   = "";
/* hiba feldolgozása */
if (isset($_POST['login'])) {
    require_once('../connect.php');

    /*$username = $_POST['username'];
   /$password = $_POST['password'];
   if ($username == "admin" && $password == "pass") {
    session_start();
    $_SESSION["user"] = "admin";
    header("Location:admin_panel.php");
   }*/

    $email     .=  mysqli_real_escape_string($conn, strip_tags(strtolower(trim($_POST['email']))));
    $passwrd   =  mysqli_real_escape_string($conn, $_POST['passwrd']);

    //változók ellenőrzése
    if (empty($email))
        $hibak[]     =   "Nem adott meg e-mail címet!";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $hibak[]     =   "Nem megfelelő az e-mail formátum!";
    if (empty($passwrd))
        $hibak[]     =   "Nem adott meg jelszót!";
    if (!preg_match("/^[a-zA-Z0-9]*$/", $passwrd))
        $hibak[]     =   "A jelszó csak ékezet nélküli betűket és számokat tartalmazhat";
    /* hibák összegyűjtése */
    if (isset($hibak)) {
        foreach ($hibak as $hiba) {
            $kimenet    .=   " <p>{$hiba}</p>\n";
        }
    }
    //beléptetés 
    else {
        $sql    =   "SELECT id_adm
                     FROM admin_default
                     WHERE email = '{$email}'
                     AND passwrd = '" . sha1($passwrd) . "'
                     LIMIT 1";
        $result =   mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['login']  =   true;
            $_SESSION['email']  =   $email;
            $log    =   date(" Y-m-d H:i:s ") . " SIKERES Bejelentkezés a(z) {$email} címről ({$_SERVER['REMOTE_ADDR']}) \n";
            file_put_contents("log.txt", $log, FILE_APPEND);
            header("Location: ./panels/dashboard_panel.php ");
        } else {
            $log    =   date(" Y-m-d H:i:s ") . " SIKERTELEN Bejelentkezés a(z) {$email} címről ({$_SERVER['REMOTE_ADDR']}) \n";
            file_put_contents("log.txt", $log, FILE_APPEND);
            $kimenet    .=   "<p>Sikertelen bejelentkezés.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <form class="login-form" action="login.php" method="post">
            <img src="./images/soccalogo-779x1024.png" alt="">
            <div class="inputs">
                <input class="textin" type="email" name="email" placeholder="E-mail">
                <input class="textin" type="password" name="passwrd" placeholder="Jelszó">
                <input class="logbtn" type="submit" value="Bejelentkezés" name="login">
            </div>
        </form>
        <div class="errors">
            <?php print $kimenet ?>
        </div>
    </div>
</body>

</html>