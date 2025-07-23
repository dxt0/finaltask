<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit();
}

// 📌 Configure your DB connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "mess";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

// Get day name — e.g. Monday, Tuesday
$today = date('l');

// Prepare and run safe SELECT query
$stmt = $conn->prepare("SELECT breakfast, lunch, dinner FROM meal_menu WHERE day = ?");
$stmt->bind_param("s", $today);
$stmt->execute();
$stmt->bind_result($breakfast, $lunch, $dinner);

// If no menu is set for today, use a fallback
if (!$stmt->fetch()) {
    $breakfast = "Poha + Tea";
    $lunch     = "Roti, Rice, Dal, Mix Veg";
    $dinner    = "Paneer Curry, Rice, Roti, Salad";
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <header>
    <h1>Student Dashboard</h1>
    <nav>
      <ul>
        <li><a href="dashboard.php" class="active">Dashboard</a></li>
        <li><a href="menu.php">Meal Menu</a></li>
         <li><a href="book.php">Booking</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main class="content">
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['student']); ?>!</p>
    <p><strong>Today's Menu (<?php echo $today; ?>):</strong></p>
    <ul>
      <li><strong>Breakfast:</strong> <?php echo htmlspecialchars($breakfast); ?></li>
      <li><strong>Lunch:</strong> <?php echo htmlspecialchars($lunch); ?></li>
      <li><strong>Dinner:</strong> <?php echo htmlspecialchars($dinner); ?></li>
    </ul>
    <p><strong>Note:</strong> Future features will include submitting feedback, viewing your meal record, etc.</p>
  </main>
</body>
</html>
