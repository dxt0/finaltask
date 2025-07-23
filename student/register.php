<?php
session_start();
include '../db.php';

if (isset($_POST['roll']) && isset($_POST['password'])) {
    $roll = $_POST['roll'];
    $password = $_POST['password'];

    $check = "SELECT * FROM students WHERE roll = '$roll'";
    $exists = mysqli_query($conn, $check);

    if (mysqli_num_rows($exists) > 0) {
        $error = "Roll number already registered.";
    } else {
        $insert = "INSERT INTO students (roll, password) VALUES ('$roll', '$password')";
        if (mysqli_query($conn, $insert)) {
            header("Location: login.php?success=1");
            exit();
        } else {
            $error = "Registration failed. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Registration</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <main class="content">
    <h2>Student Registration</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
      <label>Roll Number:</label><br>
      <input type="text" name="roll" required><br><br>

      <label>Password:</label><br>
      <input type="password" name="password" required><br><br>

      <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="login.php">Login here</a>.</p>
  </main>
</body>
</html>