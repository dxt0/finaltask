<?php
include '../db.php';
$result = mysqli_query($conn, "SELECT * FROM meal_menu");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Weekly Meal Menu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>Student Dashboard</h1>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="menu.php" class="active">Meal Menu</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main class="content">
    <h2>This Week’s Meal Plan</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Day</th>
            <th>Breakfast</th>
            <th>Lunch</th>
            <th>Dinner</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['day'] ?></td>
                <td><?= $row['breakfast'] ?></td>
                <td><?= $row['lunch'] ?></td>
                <td><?= $row['dinner'] ?></td>
            </tr>
        <?php } ?>
    </table>
</main>
<footer>
    <p>&copy; 2025 malotra mess</p>
</footer>
</body>
</html>