<?php
// Include your database connection file
include("../../../connect.php");

// Get the last loaded news ID from the query string
$lastId = isset($_GET['last_id']) ? (int)$_GET['last_id'] : 0;

// Query to fetch more news data
$sql = "SELECT * FROM news WHERE id > $lastId ORDER BY date DESC LIMIT 5";

// Execute the query
$result = mysqli_query($conn, $sql);

// Loop through the results and output the news data
while ($row = mysqli_fetch_assoc($result)) {
    // Output the news data in HTML format
    echo "<div class='news-item' data-newsid='" . $row['id'] . "'>";
    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    echo "<p class='news-date'>" . date('Y. F j.', strtotime($row['date'])) . "</p>";
    echo "<p class='news-summary'>" . htmlspecialchars($row['summary']) . "</p>";
    echo "<p class='news-content'>" . htmlspecialchars($row['content']) . "</p>";
    echo "</div>";
}

// Close the database connection
mysqli_close($conn);
