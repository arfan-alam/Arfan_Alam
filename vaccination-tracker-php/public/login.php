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

<!-- Custom CSS -->
<link rel="stylesheet" href="vaccination-tracker-php/public/assets/css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="login-card">
  <i class="bi bi-syringe vaccine-icon"></i>
  <h1 class="h4">Login</h1>
  <?php if (!empty($_GET['registered'])): ?>
    <div class="alert alert-success">Registration successful. Please log in.</div>
  <?php endif; ?>
  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <form method="post">
    <?php csrf_field(); ?>
    <div class="mb-3">
      <input name="email" type="email" class="form-control" placeholder="Email" required>
    </div>
    <div class="mb-3">
      <input name="password" type="password" class="form-control" placeholder="Password" required>
    </div>
    <button class="btn btn-primary w-100">Login</button>
    <a href="../public/register.php" class="btn btn-link w-100 mt-2">Register</a>
  </form>
</div>

<?php include __DIR__ . '/../templates/partials/footer.php'; ?>
