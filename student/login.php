<?php
session_start();
include '../db.php';

if (isset($_POST['roll']) && isset($_POST['password'])) {
    $roll = $_POST['roll'];
    $password = $_POST['password'];

    $query = "SELECT * FROM students WHERE roll = '$roll' AND password = '$password' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $_SESSION['student'] = $roll;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Roll Number or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Login</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <main class="content">
    <h2>Student Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
      <label>Roll Number:</label><br>
      <input type="text" name="roll" required><br><br>

      <label>Password:</label><br>
      <input type="password" name="password" required><br><br>

      <button type="submit">Login</button>
    </form>
    <p>Not registered? <a href="register.php">Register here</a>.</p>
            <li><a href="../index.php">Homepage</a></li>

  </main>
</body>
</html>