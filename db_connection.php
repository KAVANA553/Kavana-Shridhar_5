<?php
$servername = "localhost";
$username = "root";
$password = ""; // Update with your MySQL password if any
$database = "public_grievance_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
