<?php
session_start();
require_once '../db.php';
if (!isset($_SESSION['student'])) {
  header("Location: login.php");
  exit();
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stu = $_SESSION['student'];
  $name = trim($_POST['student_name']);
  $address = trim($_POST['address']);
  $date = $_POST['booking_date'];
  $time = $_POST['booking_time'];

  $stmt = $conn->prepare(
    "INSERT INTO bookings (student_username, student_name, address, booking_date, booking_time)
     VALUES (?, ?, ?, ?, ?)"
  );
  $stmt->bind_param("sssss", $stu, $name, $address, $date, $time);

  if ($stmt->execute()) {
    $_SESSION['booking_success'] = "Booking confirmed for $date at $time!";
    header("Location: book.php");
    exit();
  } else {
    $msg = "Error: " . $stmt->error;
  }
}

if (isset($_SESSION['booking_success'])) {
  $msg = $_SESSION['booking_success'];
  unset($_SESSION['booking_success']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Book Mess Meal</title>
  <link
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    rel="stylesheet"
  >
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card p-4">
    <h3 class="mb-4">Mess Meal Booking</h3>
    <?php if ($msg): ?>
      <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
      <div class="form-group">
        <label for="student_name">Name</label>
        <input type="text" class="form-control" id="student_name"
               name="student_name" required>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" name="address"
                  rows="2" required></textarea>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="booking_date">Date</label>
          <input type="date" class="form-control" id="booking_date"
                 name="booking_date" required>
        </div>
        <div class="form-group col-md-6">
          <label for="booking_time">Meal Type</label>
          <select name="booking_time" id="booking_time" class="form-control" required>
            <option value="Breakfast">Breakfast</option>
            <option value="Lunch">Lunch</option>
            <option value="Dinner">Dinner</option>
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
    <div class="mt-3">
      <a href="dashboard.php" class="btn btn-secondary">Go to Dashboard</a>
    </div>
  </div>
</div>
</body>
</html>
