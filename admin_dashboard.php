<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <header>
        <h1>Public Grievance Portal</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about_us.html">About Us</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <section class="main-content">
        <h2>Admin Dashboard</h2>
        <p>Welcome, Admin. You can manage complaints here.</p>

        <!-- Table to display complaints -->
        <table border="1">
            <tr>
                <th>Complaint ID</th>
                <th>User ID</th>
                <th>Zone</th>
                <th>Area</th>
                <th>Landmark</th>
                <th>Pincode</th>
                <th>Date</th>
                <th>Complaint</th>
                <th>Photo</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
            include 'db_connection.php';

            $query = "SELECT * FROM complaints";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['zone'] . "</td>";
                    echo "<td>" . $row['area'] . "</td>";
                    echo "<td>" . $row['landmark'] . "</td>";
                    echo "<td>" . $row['pincode'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['complaint'] . "</td>";
                    echo "<td>" . ($row['photo_path'] ? "<img src='" . $row['photo_path'] . "' width='100'>" : "No Photo") . "</td>";
                    echo "<td><a href='update_status.php?id=" . $row['id'] . "&status=In Progress'>In Progress</a> | <a href='update_status.php?id=" . $row['id'] . "&status=Resolved'>Resolved</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No complaints found</td></tr>";
            }
            ?>
        </table>
    </section>
    <footer>
        <p>&copy; 2024 Public Grievance Portal</p>
    </footer>
</body>
</html>
