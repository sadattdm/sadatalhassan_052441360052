<?php
// db.php - Database connection using mysqli (object-oriented style)

$servername = "localhost";
$username   = "root";          // change if you created a different user
$password   = "";              // blank for default XAMPP
$dbname     = "courselink_db"; // ← change to match what you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set charset to avoid funny characters
$conn->set_charset("utf8mb4");


?>