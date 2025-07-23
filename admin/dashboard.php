<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - malotra mess</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php" class="active">Dashboard</a></li>
                <li><a href="menu.php">Manage Menu</a></li>
                <li><a href="view_bookings.php">View Bookings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="content">
        <h2>Welcome, Admin!</h2>
        <p>Use the options above to manage the mess system.</p>

        <div style="margin-top: 30px;">
            <a href="menu.php">
                <button style="
                    padding: 12px 24px;
                    background-color: #333;
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                ">
                    ✏️ Manage Meal Menu
                </button>
            </a>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 malotra mess </p>
    </footer>
</body>
</html>
