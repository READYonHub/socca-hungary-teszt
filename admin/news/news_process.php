<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?>


<!----------------------------ÚJ HÍR LÉTREHOZÁSA---------------------------->
<?php
if (isset($_POST["create"])) {
    include("../../connect.php");
    $title          =       trim(strip_tags(ucfirst(mysqli_real_escape_string($conn, $_POST["title"]))));
    $summary        =       trim(strip_tags(ucfirst(mysqli_real_escape_string($conn, $_POST["summary"]))));
    $content        =       trim(strip_tags(ucfirst(mysqli_real_escape_string($conn, $_POST["content"]))));
    $date           =       mysqli_real_escape_string($conn, $_POST["date"]);

    if (isset($title) && isset($summary) && isset($content) && isset($date)) {

        // Új hír beszúrása adatbázisba
        $sqlInsert = "INSERT INTO news(date,title, summary, content) VALUES ('$date', '$title', '$summary','$content' )";

        if (mysqli_query($conn, $sqlInsert)) {
            session_start();
            $_SESSION["create"] = "Új hír sikeresen létrehozva!";
            header("Location:../panels/news_panel.php");
        } else {
            die("Data is not inserted!");
        }
    }
}
?>

<!----------------------------HÍR MÓDOSÍTÁSA---------------------------->
<?php
if (isset($_POST["update"])) {
    include("../../connect.php");
    $title          =       trim(strip_tags(ucfirst(mysqli_real_escape_string($conn, $_POST["title"]))));
    $summary        =       trim(strip_tags(ucfirst(mysqli_real_escape_string($conn, $_POST["summary"]))));
    $content        =       trim(strip_tags(ucfirst(mysqli_real_escape_string($conn, $_POST["content"]))));
    $date           =       mysqli_real_escape_string($conn, $_POST["date"]);
    $id             =       mysqli_real_escape_string($conn, $_POST["id"]);
    $sqlUpdate      =       "UPDATE news SET title = '$title', summary = '$summary', content = '$content', date = '$date' WHERE id = $id";
    if (mysqli_query($conn, $sqlUpdate)) {
        session_start();
        $_SESSION["update"] = "A hír sikeresen módosítva!";
        header("Location:../news/news_existing.php");
    } else {
        die("Data is not updated!");
    }
}
?>