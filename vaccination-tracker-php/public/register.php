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
            header("Location: ../public/login.php?registered=1"); 
            exit;
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

<style>
    body {
        background: linear-gradient(135deg, #e0f7fa, #e8f5e9);
        font-family: 'Segoe UI', sans-serif;
    }
    .register-card {
        background: #ffffff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        border-top: 5px solid #4CAF50;
    }
    .register-card h1 {
        color: #00796b;
        font-weight: 600;
    }
    .vaccine-icon {
        font-size: 50px;
        color: #4CAF50;
    }
    .btn-primary {
        background-color: #00796b;
        border: none;
    }
    .btn-primary:hover {
        background-color: #004d40;
    }
</style>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="register-card text-center">
        <div class="mb-3">
          <i class="fas fa-syringe vaccine-icon"></i>
        </div>
        <h1 class="h4 mb-3">Patient Registration</h1>
        <p class="text-muted mb-4">Join the vaccination system to stay protected and connected</p>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form method="post" class="text-start">
          <?php csrf_field(); ?>
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input name="name" class="form-control" placeholder="Enter your full name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" placeholder="example@email.com" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" minlength="6" placeholder="Min 6 characters" required>
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
          <button class="btn btn-primary w-100 mb-3">Register</button>
          <a href="../public/login.php" class="btn btn-link d-block">Already have an account? Login</a>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Font Awesome for icons -->
<script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>

<?php include __DIR__ . '/../templates/partials/footer.php'; ?>
