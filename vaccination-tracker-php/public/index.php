<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../app/helpers/auth.php';
include __DIR__ . '/../templates/partials/header.php';

if (is_logged_in()) {
    $role = $_SESSION['user']['role'];
    if ($role === 'patient') { header('Location: ../public/patient/dashboard.php'); exit; }
    if ($role === 'healthcare') { header('Location: ../public/healthcare/dashboard.php'); exit; }
    if ($role === 'admin') { header('Location: ../public/admin/dashboard.php'); exit; }
}
?>
<div class="row">
  <div class="col-md-8 mx-auto">
    <div class="p-4 bg-white rounded shadow-sm">
      <h1 class="h4 mb-3">Welcome to <?= APP_NAME ?></h1>
      <p class="mb-0">Please <a href=" ../public/register.php">register</a> as a patient or <a href=" ../public/login.php">log in</a>.</p>
    </div>
  </div>
</div>
<?php include __DIR__ . '/../templates/partials/footer.php'; ?>