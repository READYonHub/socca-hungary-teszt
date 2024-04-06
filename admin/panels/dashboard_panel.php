<style>
    .dashboard-container {
        display: flex;
        flex-direction: column;
        background-color: #252525;
        width: 100vw;
        color: #fff;
        padding: 30px;
    }

    .dashboard-container h1 {
        text-align: center;
    }

    .count-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 20px;
        font-size: 14pt;
    }

    .count-container h2 {
        font-variant: small-caps;
    }

    .result {
        font-weight: bold;
    }

    .green {
        color: rgb(0, 200, 0);
    }

    .red {
        color: rgb(200, 0, 0);
    }
</style>

<?php
include("../headers/header.php");
?>

<div class="dashboard-container">
    <h1>Vezérlőpult</h1>

    <div class="count-container">
        <h2>Játékos statisztikák</h2>
        <?php
        require_once('../../connect.php');

        //-------JÁTÉKOSOK SZÁMA
        $sql = "SELECT COUNT(name) AS count FROM `players_data`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<span><span class=\"result\">{$row['count']}</span> <span class=\"green\">ÉRVÉNYES</span></span>";
        } else {
            echo '<span>Nincsenek Játékosok</span>';
        }

        //-------ELTILTOTT JÁTÉKOSOK SZÁMA
        $sql = "SELECT COUNT(status) AS eltiltottak FROM players_data WHERE status = 'eltiltva'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<span><span class=\"result\">{$row['eltiltottak']}</span> <span class=\"red\">ELTILTOTT</span></span>";
        } else {
            echo '<span>Nincsenek ELTILTOTT Játékosok!</span>';
        }
        ?>
    </div>
</div>