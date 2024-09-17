<?php
session_start();
include 'db_connection.php'; // Include your database connection file

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    $query = "UPDATE complaints SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error updating status: " . $stmt->error;
    }
}
?>
