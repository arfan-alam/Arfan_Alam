<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../app/helpers/auth.php';
csrf_check();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $u = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($u && password_verify($pass, $u['password_hash'])) {
        $_SESSION['user'] = [
            'id' => $u['id'],
            'name' => $u['name'],
            'email' => $u['email'],
            'role' => $u['role'],
            'hospital_id' => $u['hospital_id']
        ];
        if ($u['role'] === 'patient') { header('Location: ../public/patient/dashboard.php'); exit; }
        if ($u['role'] === 'healthcare') { header('Location: ../public/healthcare/dashboard.php'); exit; }
        if ($u['role'] === 'admin') { header('Location: ../public/admin/dashboard.php'); exit; }
    } else {
        $error = "Invalid credentials";
    }
}

include __DIR__ . '/../templates/partials/header.php';
?>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
  body {
      background: linear-gradient(135deg, #e0f7fa, #e8f5e9);
      font-family: 'Segoe UI', sans-serif;
  }
  .login-card {
      background: #ffffff;
      border-radius: 15px;
      padding: 35px;
      max-width: 400px;
      margin: 60px auto;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      border-top: 5px solid #4CAF50;
      text-align: center;
  }
  .login-card h1 {
      color: #00796b;
      font-weight: 600;
      margin-bottom: 15px;
  }
  .login-card p {
      color: #555;
      margin-bottom: 25px;
  }
  .vaccine-icon {
      font-size: 60px;
      color: #4CAF50;
      margin-bottom: 10px;
  }
  .login-card input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #ddd;
  }
  .login-card input:focus {
      border-color: #00796b;
      outline: none;
      box-shadow: 0 0 6px rgba(0,121,107,0.3);
  }
  .btn-primary {
      background-color: #00796b;
      border: none;
      padding: 10px;
      font-size: 16px;
      border-radius: 8px;
  }
  .btn-primary:hover {
      background-color: #004d40;
  }
  .alert {
      text-align: left;
      font-size: 14px;
  }
</style>

<div class="login-card">
  <i class="bi bi-syringe vaccine-icon"></i>
  <h1>Welcome Back</h1>
  <p>Login to access your vaccination dashboard</p>

  <?php if (!empty($_GET['registered'])): ?>
    <div class="alert alert-success">✅ Registration successful. Please log in.</div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger">⚠️ <?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post">
    <?php csrf_field(); ?>
    
    <input name="email" type="email" placeholder="Email Address" required>
    <input name="password" type="password" placeholder="Password" required>
    
    <button type="submit" class="btn btn-primary w-100">Login</button>
    <a href="../public/register.php" class="btn btn-link w-100 mt-2">Create Account</a>
  </form>
</div>

<?php include __DIR__ . '/../templates/partials/footer.php'; ?>
