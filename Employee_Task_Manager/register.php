<?php
// register.php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $mysqli->real_escape_string(trim($_POST['username']));
    $email    = $mysqli->real_escape_string(trim($_POST['email']));
    $password = trim($_POST['password']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO users (username, email, password_hash) VALUES ('$username', '$email', '$password_hash')";
    if ($mysqli->query($sql)) {
        $_SESSION['success'] = "Registration successful! Please log in.";
        header("Location: login.php");
        exit();
    } else {
        $error = "Error: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Task Manager</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(120deg,rgb(50, 175, 216),rgb(187, 33, 156));
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .card {
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      animation: fadeInUp 0.6s ease-out;
      border: 2px solidrgb(13, 12, 15);
    }

    h2 {
      text-align: center;
      color:rgb(10, 13, 115);
      font-size: 24px;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
      color: #333;
      font-size: 14px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-top: 5px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color:rgb(241, 15, 15);
      outline: none;
      box-shadow: 0 0 5px rgba(255, 111, 97, 0.5);
    }

    .toggle-password {
      float: right;
      margin-top: -28px;
      margin-right: 10px;
      font-size: 12px;
      color:rgb(169, 24, 11);
      cursor: pointer;
      transition: color 0.3s ease;
    }

    .toggle-password:hover {
      color:rgb(119, 5, 5);
    }

    .btn {
      width: 100%;
      margin-top: 20px;
      background-color:rgb(168, 18, 4);
      color: white;
      padding: 14px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    .btn:hover {
      background-color:rgba(132, 15, 7, 0.55);
      transform: translateY(-2px);
    }

    .link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .link a {
      color:rgb(14, 175, 9);
      text-decoration: none;
      font-weight: bold;
    }

    .link a:hover {
      text-decoration: underline;
    }

    .error {
      background: #f8d7da;
      color: #721c24;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
      border: 1px solid #f5c6cb;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>Register</h2>
    <?php if(isset($error)): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>
    
    <form action="register.php" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <span class="toggle-password" onclick="togglePassword()">Show</span>

      <input type="submit" value="Register" class="btn">
    </form>

    <div class="link">
      Already have an account? <a href="login.php">Login here</a>.
    </div>
  </div>

  <script>
    function togglePassword() {
      const password = document.getElementById("password");
      const toggle = document.querySelector(".toggle-password");
      if (password.type === "password") {
        password.type = "text";
        toggle.textContent = "Hide";
      } else {
        password.type = "password";
        toggle.textContent = "Show";
      }
    }
  </script>
</body>
</html>
