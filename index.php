<?php
// include the shared database connection
require_once 'db.php';  // Adjust path if needed (e.g. './db.php' or 'includes/db.php')

// Get today's weekday name, e.g., "Tuesday"
$today = date('l');

// Retrieve today's menu
$stmt = $conn->prepare("
  SELECT breakfast, lunch, dinner
  FROM meal_menu
  WHERE day = ?
");
$stmt->bind_param("s", $today);
$stmt->execute();
$stmt->bind_result($breakfast, $lunch, $dinner);

if (!$stmt->fetch()) {
  // Provide defaults if not set in DB
  $breakfast = "Poha + Tea";
  $lunch     = "Roti, Rice, Dal, Mix Veg";
  $dinner    = "Paneer Curry, Rice, Roti, Salad";
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mess Management</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>malotra mess</h1>
    <nav>
      <ul>
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="about.html">About Us</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="admin/login.php">Admin</a></li>
        <li><a href="student/login.php">Login</a></li>
        <li><a href="student/register.php">Register</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="banner">
      <h2>Welcome to malotra mess</h2>
      <p>Healthy, hygienic and delicious meals served daily!</p>
    </section>

    <section class="content">
      <h3>Today's Menu (<?php echo htmlspecialchars($today); ?>)</h3>
      <ul>
        <li><strong>Breakfast:</strong> <?php echo htmlspecialchars($breakfast); ?></li>
        <li><strong>Lunch:</strong> <?php echo htmlspecialchars($lunch); ?></li>
        <li><strong>Dinner:</strong> <?php echo htmlspecialchars($dinner); ?></li>
      </ul>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 malotra mess. All rights reserved.</p>
  </footer>
</body>
</html>
