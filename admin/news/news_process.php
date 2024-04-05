
<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    if (isset($_POST["create"])) {
        include("../../connect.php");
        $title = mysqli_real_escape_string($conn, $_POST["title"]);
        $summary = mysqli_real_escape_string($conn, $_POST["summary"]);
        $content = mysqli_real_escape_string($conn, $_POST["content"]);
        $date = mysqli_real_escape_string($conn, $_POST["date"]);
        $sqlInsert = "INSERT INTO news(date,title, summary, content) VALUES ('$date', '$title', '$summary','$content' )";
        if (mysqli_query($conn, $sqlInsert)) {
            session_start();
            $_SESSION["create"] = "Post added successfully";
            header("Location:../news_panel.php");
        } else {
            die("Data is not inserted!");
        }
    }
    ?>

<?php
if (isset($_POST["update"])) {
    include("../../connect.php");
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $summary = mysqli_real_escape_string($conn, $_POST["summary"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $sqlUpdate = "UPDATE news SET title = '$title', summary = '$summary', content = '$content', date = '$date' WHERE id = $id";
    if (mysqli_query($conn, $sqlUpdate)) {
        session_start();
        $_SESSION["update"] = "Post udpated successfully";
        header("Location:../news_panel.php");
    } else {
        die("Data is not updated!");
    }
}
?>