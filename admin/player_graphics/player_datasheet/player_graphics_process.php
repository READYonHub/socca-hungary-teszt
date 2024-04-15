<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

// Ellenőrizze, hogy a 'hi' GET paraméter létezik-e és nem üres
if (isset($_GET['hi']) && !empty($_GET['hi'])) {
    $hash = $_GET['hi'];

    function decode($hash)
    {
        require_once("../../connect.php"); // Adatbázis kapcsolat létrehozása

        // Első lekérdezés az egészségügyi adatok táblájából
        $sql1 = "SELECT pd.player_id, pd.name, pd.registration_number, ph.record_id, ph.blood_group, ph.drug_allergies, ph.chronic_illness
                FROM players_data pd
                LEFT JOIN players_health ph
                ON pd.player_id = ph.player_id";

        // Második lekérdezés az általános adatok táblájából
        $sql2 = "SELECT player_id, name, registration_number
                FROM players_data";

        // Ellenőrizzük, hogy a hash érvényes hash-e
        $result1 = mysqli_query($conn, $sql1);
        $result2 = mysqli_query($conn, $sql2);

        // Ellenőrizzük, hogy van-e eredmény a lekérdezésben és hogy a hash megfelel-e valamelyiknek
        while ($row1 = mysqli_fetch_assoc($result1)) {
            if (sha1((string) $row1['player_id'] . '' . str_replace(' ', '', $row1['name']) . '' . $row1['record_id'] . 'ph') === $hash) {
                return $row1;
            }
        }

        while ($row2 = mysqli_fetch_assoc($result2)) {
            if (sha1((string) $row2['player_id'] . '' . str_replace(' ', '', $row2['name']) . '' . $row2['registration_number'] . 'pd') === $hash) {
                return $row2;
            }
        }

        return false; // Ha nincs találat, visszaadunk false értéket
    }

    // Visszafejtett adatok lekérése a hash alapján
    $decoded_data = decode($hash);

    if ($decoded_data) {
        // Ha van találat, kiírjuk az adatokat
        echo "Kapott hash: $hash <br>";
        echo "Kinyert adatok: <br>";
        print_r($decoded_data);

        // Adatok mentése a session-be
        $_SESSION['player_id'] = $decoded_data['player_id'];
        $_SESSION['name'] = $decoded_data['name'];
        $_SESSION['registration_number'] = $decoded_data['registration_number'];

        // Töröljük a hash-t a GET paraméterből, hogy ne legyen látható az URL-ben
        header("Location: player_data.php");
        exit;
    } else {
        // Ha nincs találat, értesítést adunk
        echo "Nincs megfelelő adat a megadott játékoshoz!";
    }
} else {
    // Ha hiányzik a 'hi' GET paraméter
    echo "Hiányzó vagy érvénytelen paraméterek!";
}
