<?php
session_start();
require_once '../db.php';
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}
$res = $conn->query("SELECT * FROM bookings ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Bookings</title>
  <link
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    rel="stylesheet"
  >
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2 class="mb-4">All Mess Bookings</h2>
  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th>ID</th>
        <th>Student User</th>
        <th>Name</th>
        <th>Address</th>
        <th>Date</th>
        <th>Meal</th>
        <th>Booked On</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['student_username']) ?></td>
        <td><?= htmlspecialchars($row['student_name']) ?></td>
        <td><?= htmlspecialchars($row['address']) ?></td>
        <td><?= $row['booking_date'] ?></td>
        <td><?= $row['booking_time'] ?></td>
        <td><?= $row['created_at'] ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>
</body>
</html>
