<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../headers/header.php");
    ?>

<style>
    .back-btn {
        color: gray;
        text-decoration: none;
        width: min-content;
    }

    .back-btn:hover {
        text-decoration: underline;
    }

    .players-view-container {
        display: flex;
        padding: 30px;
        background-color: #252525;
        flex-direction: column;
        gap: 15px;
        color: #fff;
        width: 100vw;
    }
</style>
<div class="players-view-container">
    <a href="./players_health.php" class="back-btn">Vissza</a>

    <?php
    $id = $_GET["id"];
    if ($id) {
        include("../../connect.php");
        $sqlSelectPost = "SELECT pd.player_id, pd.name, pd.registration_number, ph.blood_group, ph.drug_allergies, ph.chronic_illness
                          FROM players_data pd
                          LEFT JOIN players_health ph
                          ON pd.player_id = ph.player_id
                          WHERE  pd.player_id = $id
                            ";
        $result = mysqli_query($conn, $sqlSelectPost);
        while ($data = mysqli_fetch_array($result)) {
    ?>
            <h1><?php echo  $data['name']; ?></h1>
            <td><?php echo $data["registration_number"] ?></td>
            <td><?php echo $data["blood_group"] ?></td>
            <td><?php echo $data["drug_allergies"] ?></td>
            <td><?php echo $data["chronic_illness"] ?></td>
    <?php
        }
    } else {
        echo "Player Not Found";
    }
    ?>
</div>

<?php
include("../headers/footer.php");
?>