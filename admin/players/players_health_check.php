<?php
/* Lapvédelem */
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
} ?><?php
    include("../templates/players_header.php");
    ?>

<div class="post w-100 bg-light p-5">
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
include("../templates/footer.php");
?>