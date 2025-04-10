<?php
// login.php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = $mysqli->real_escape_string(trim($_POST['email']));
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Task Manager</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #74ebd5, #ACB6E5);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      animation: fadeInBody 1.5s ease-in;
    }

    @keyframes fadeInBody {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .login-box {
      background: white;
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      animation: slideIn 1s ease-out;
    }

    @keyframes slideIn {
      from { opacity: 0; transform: translateY(-30px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .input-group {
      margin-bottom: 20px;
      position: relative;
    }

    .input-group label {
      display: block;
      margin-bottom: 8px;
      color: #333;
    }

    .input-group input {
      width: 100%;
      padding: 12px 40px 12px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background: #f0f6ff;
    }

    .toggle-password {
      position: absolute;
      top: 36px;
      right: 10px;
      cursor: pointer;
      font-size: 14px;
      color: #555;
    }

    .btn {
      width: 100%;
      padding: 12px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s ease;
    }

    .btn:hover {
      background: #218838;
    }

    .bottom-text {
      text-align: center;
      margin-top: 15px;
    }

    .bottom-text a {
      color: #007bff;
      text-decoration: none;
    }

    .bottom-text a:hover {
      text-decoration: underline;
    }

    .error, .success {
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 15px;
      animation: fadeIn 0.5s ease-in-out;
    }

    .error {
      background-color: #f8d7da;
      color: #721c24;
    }

    .success {
      background-color: #d4edda;
      color: #155724;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2>Login</h2>
  <?php 
    if(isset($_SESSION['success'])) { 
      echo '<div class="success">'.$_SESSION['success'].'</div>';
      unset($_SESSION['success']);
    }
    if(isset($error)) {
      echo '<div class="error">'.$error.'</div>';
    }
  ?>
  <form action="login.php" method="post">
    <div class="input-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required placeholder="Enter your email">
    </div>

    <div class="input-group">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required placeholder="Enter your password">
      <span class="toggle-password" onclick="togglePassword()">👁️</span>
    </div>

    <button class="btn" type="submit">Login</button>
    <div class="bottom-text">
      Don't have an account? <a href="register.php">Register here</a>
    </div>
  </form>
</div>

<script>
  function togglePassword() {
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.querySelector(".toggle-password");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      toggleIcon.textContent = "🙈";
    } else {
      passwordInput.type = "password";
      toggleIcon.textContent = "👁️";
    }
  }
</script>

</body>
</html>
