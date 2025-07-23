<?php
include '../db.php';
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $day = $_POST['day'];
    $breakfast = $_POST['breakfast'];
    $lunch = $_POST['lunch'];
    $dinner = $_POST['dinner'];

    $check = mysqli_query($conn, "SELECT * FROM meal_menu WHERE day='$day'");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE meal_menu SET breakfast='$breakfast', lunch='$lunch', dinner='$dinner' WHERE day='$day'");
    } else {
        mysqli_query($conn, "INSERT INTO meal_menu (day, breakfast, lunch, dinner) VALUES ('$day', '$breakfast', '$lunch', '$dinner')");
    }
    echo "<script>alert('Menu updated!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Meal Menu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Admin Panel</h1>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="menu.php" class="active">Manage Menu</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main class="content">
    <h2>Update Meal Menu</h2>
    <form method="POST">
        <label for="day">Day:</label><br>
        <select name="day" required>
            <option value="">Select a day</option>
            <option>Monday</option>
            <option>Tuesday</option>
            <option>Wednesday</option>
            <option>Thursday</option>
            <option>Friday</option>
            <option>Saturday</option>
            <option>Sunday</option>
        </select><br><br>

        <label>Breakfast:</label><br>
        <input type="text" name="breakfast" required><br><br>

        <label>Lunch:</label><br>
        <input type="text" name="lunch" required><br><br>

        <label>Dinner:</label><br>
        <input type="text" name="dinner" required><br><br>

        <button type="submit">Save Menu</button>
    </form>
</main>
<footer>
    <p>&copy; 2025 malotra mess</p>
</footer>
</body>
</html>
