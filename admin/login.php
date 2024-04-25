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

    if (empty($passwrd))
        $hibak[]     =   "Nem adott meg jelszót!";

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

        //sikeres
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['login']  =   true;
            $_SESSION['email']  =   $email;

            $log_datum      =   date("Y-m-d H:i:s");;
            $log_allapot    =   "SIKERES";
            $log_muvelet    =   "Bejelentkezés";
            $log_email      =   $_SESSION['email'];
            $log_cim        =   $_SERVER['REMOTE_ADDR'];

            // $log    =   $log_datum . "\t" . $log_allapot . "\t" . $log_muvelet . "\t" . $log_email . "\t" . " címről (" . $log_cim . ") \n";

            //LOG BESZURASA ADATBÁZISBA
            $sqlInsert = "INSERT INTO logs(timestamp, state, action, email, ip_address) VALUES ('$log_datum', '$log_allapot','$log_muvelet', '$log_email', '$log_cim')";
            mysqli_query($conn, $sqlInsert);



            // file_put_contents("log.txt", $log, FILE_APPEND);
            header("Location: ./panels/dashboard_panel.php");
        }
        //sikertelen 
        else {
            $log_datum      =   date("Y-m-d H:i:s");;
            $log_allapot    =   "SIKERTELEN";
            $log_muvelet    =   "Bejelentkezés";
            $log_email      =   $_SESSION['email'];
            $log_cim        =   $_SERVER['REMOTE_ADDR'];

            //$log    =   $log_datum . "\t" . $log_allapot . "\t" . $log_muvelet . "\t" . $log_email . "\t" . " címről (" . $log_cim . ") \n";

            //LOG BESZURASA ADATBÁZISBA
            $sqlInsert = "INSERT INTO logs(timestamp, state, action, email, ip_address) VALUES ('$log_datum', '$log_allapot','$log_muvelet', '$log_email', '$log_cim' )";
            mysqli_query($conn, $sqlInsert);

            //file_put_contents("log.txt", $log, FILE_APPEND);
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