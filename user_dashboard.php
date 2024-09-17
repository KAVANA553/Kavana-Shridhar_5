<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        .main-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .form-row label {
            flex: 1;
            margin-right: 10px;
        }
        .form-row input, .form-row select, .form-row textarea {
            flex: 2;
            padding: 5px;
            margin-right: 10px;
        }
        .form-row textarea {
            resize: vertical;
        }
        .form-row:last-child {
            justify-content: flex-end;
        }
        .form-row input[type="file"] {
            flex: 1;
        }
        button {
            padding: 10px 15px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
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
        <h2>User Dashboard</h2>
        <p>Welcome, User. You can register a complaint here.</p>

        <form action="submit_complaint.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <label for="zone">Zone:</label>
                <select id="zone" name="zone" required>
                    <?php
                    include 'db_connection.php';
                    $query = "SELECT * FROM zones";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['zone_name'] . "'>" . $row['zone_name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No zones available</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-row">
                <label for="area">Area:</label>
                <input type="text" id="area" name="area" required>
            </div>
            <div class="form-row">
                <label for="landmark">Landmark:</label>
                <input type="text" id="landmark" name="landmark" required>
            </div>
            <div class="form-row">
                <label for="pincode">Pincode:</label>
                <input type="text" id="pincode" name="pincode" required>
            </div>
            <div class="form-row">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-row">
                <label for="complaint">Complaint Description:</label>
                <textarea id="complaint" name="complaint" rows="4" required></textarea>
            </div>
            <div class="form-row">
                <label for="photo">Upload Photo:</label>
                <input type="file" id="photo" name="photo">
            </div>
            <div class="form-row">
                <button type="submit">Submit Complaint</button>
            </div>
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Public Grievance Portal</p>
    </footer>
</body>
</html>
