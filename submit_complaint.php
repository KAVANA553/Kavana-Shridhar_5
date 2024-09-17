<?php
session_start();
include 'db_connection.php'; // Include your database connection file

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $zone = $_POST['zone'];
    $area = $_POST['area'];
    $landmark = $_POST['landmark'];
    $pincode = $_POST['pincode'];
    $date = $_POST['date'];
    $complaint = $_POST['complaint'];
    $photo_path = NULL;

    // Handle file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo_path = 'uploads/' . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path);
    }

    $query = "INSERT INTO complaints (user_id, zone, area, landmark, pincode, date, complaint, photo_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssssss", $user_id, $zone, $area, $landmark, $pincode, $date, $complaint, $photo_path);

    if ($stmt->execute()) {
        echo "Complaint submitted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
