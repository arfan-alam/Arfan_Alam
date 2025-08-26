<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../app/helpers/auth.php';
csrf_check();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';
    $hospital_id = (int)($_POST['hospital_id'] ?? 0);
    if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pass) >= 6) {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, role, hospital_id) VALUES (?, ?, ?, 'patient', ?)");
        try {
            $stmt->execute([$name, $email, password_hash($pass, PASSWORD_BCRYPT), $hospital_id ?: null]);
            header("Location: ../public/login.php?registered=1"); exit;
        } catch (PDOException $e) {
            $error = "Registration failed: " . $e->getMessage();
        }
    } else {
        $error = "Please provide valid name, email, and password (min 6 chars).";
    }
}
$hospitals = $pdo->query("SELECT id,name FROM hospitals ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
include __DIR__ . '/../templates/partials/header.php';
?>
<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="p-4 bg-white rounded shadow-sm">
      <h1 class="h4 mb-3">Patient Registration</h1>
      <?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
      <form method="post">
        <?php csrf_field(); ?>
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input name="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input name="email" type="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input name="password" type="password" class="form-control" minlength="6" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Home Hospital (optional)</label>
          <select name="hospital_id" class="form-select">
            <option value="">-- Select hospital --</option>
            <?php foreach($hospitals as $h): ?>
              <option value="<?= $h['id'] ?>"><?= htmlspecialchars($h['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button class="btn btn-primary">Register</button>
        <a href=" ../public/login.php" class="btn btn-link">Have an account? Login</a>
      </form>
    </div>
  </div>
</div>
<?php include __DIR__ . '/../templates/partials/footer.php'; ?>
