<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
require_role('patient');

$uid = $_SESSION['user']['id'];

// Fetch doses
$stmt = $pdo->prepare("
    SELECT d.*, v.name AS vaccine_name, h.name AS hospital_name
    FROM doses d
    JOIN vaccines v ON v.id = d.vaccine_id
    LEFT JOIN hospitals h ON h.id = d.hospital_id
    WHERE d.patient_id = ?
    ORDER BY d.dose_number
");
$stmt->execute([$uid]);
$doses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch hospitals
$hospitals = $pdo->query("SELECT id,name FROM hospitals ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../../templates/partials/header.php';
?>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
  body {
    background: linear-gradient(135deg, #e3f2fd, #fce4ec);
    font-family: 'Segoe UI', sans-serif;
    min-height: 100vh;
  }

  /* Header */
  .dashboard-header {
    background: linear-gradient(135deg, #42a5f5, #66bb6a);
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 18px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    color: #fff;
  }
  .dashboard-header i {
    font-size: 45px;
  }
  .dashboard-header h1 {
    margin: 0;
    font-size: 26px;
    font-weight: 700;
  }
  .dashboard-header p {
    margin: 0;
    font-size: 14px;
    opacity: 0.9;
  }

  /* Dose Card */
  .dose-card {
    background: linear-gradient(135deg, #ffffff, #f9fbe7);
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    margin-bottom: 25px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .dose-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
  }
  .dose-card h5 {
    font-weight: 700;
    color: #1e88e5;
    margin-bottom: 12px;
  }
  .dose-card h5 i {
    color: #43a047;
    margin-right: 6px;
  }
  .dose-meta {
    font-size: 14px;
    color: #444;
  }
  .dose-meta p {
    margin-bottom: 6px;
  }
  .dose-meta i {
    color: #6a1b9a;
    margin-right: 5px;
  }

  /* Badges */
  .badge {
    font-size: 13px;
    padding: 6px 12px;
    border-radius: 20px;
    text-transform: capitalize;
  }

  .bg-success { background: linear-gradient(135deg, #66bb6a, #43a047) !important; }
  .bg-warning { background: linear-gradient(135deg, #18c1e3ff, #2dfb83ff) !important; }
  .bg-primary { background: linear-gradient(135deg, #42a5f5, #1e88e5) !important; }
  .bg-secondary { background: linear-gradient(135deg, #b0bec5, #78909c) !important; }

  /* Buttons */
  .btn-custom {
    border-radius: 10px;
    padding: 8px 12px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
  }
  .btn-custom:hover {
    transform: scale(1.05);
  }
</style>

<div class="dashboard-header">
  <i class="bi bi-syringe"></i>
  <div>
    <h1>My Vaccination Dashboard</h1>
    <p>Track your vaccine doses and manage your appointments</p>
  </div>
</div>

<div class="row">
  <?php if ($doses): ?>
    <?php foreach($doses as $d): ?>
      <div class="col-md-6">
        <div class="dose-card">
          <h5><i class="bi bi-capsule"></i> Dose <?= (int)$d['dose_number'] ?> - <?= htmlspecialchars($d['vaccine_name']) ?></h5>
          
          <div class="dose-meta mt-2">
            <p><i class="bi bi-calendar-event"></i> <strong>Scheduled:</strong> <?= htmlspecialchars($d['scheduled_date'] ?? '-') ?></p>
            <p><i class="bi bi-hospital"></i> <strong>Hospital:</strong> <?= htmlspecialchars($d['hospital_name'] ?? '-') ?></p>
            <p><i class="bi bi-info-circle"></i> <strong>Status:</strong> 
              <span class="badge 
                <?= $d['status']=='completed'?'bg-success':
                   ($d['status']=='pending'?'bg-warning text-dark':
                   ($d['status']=='scheduled'?'bg-primary':'bg-secondary')) ?>">
                <?= htmlspecialchars($d['status']) ?>
              </span>
            </p>
          </div>

          <div class="dose-actions mt-3">
            <?php if ($d['status'] === 'scheduled'): ?>
              <!-- Apply Dose -->
              <form method="post" action="apply_vaccine.php" class="mb-2">
                <?php csrf_field(); ?>
                <input type="hidden" name="dose_id" value="<?= (int)$d['id'] ?>">
                <button class="btn btn-warning btn-custom w-100"><i class="bi bi-check2-circle"></i> Apply for Dose</button>
              </form>

              <!-- Change Hospital -->
              <form method="post" action="hospital_change.php" class="d-flex gap-1">
                <?php csrf_field(); ?>
                <input type="hidden" name="dose_id" value="<?= (int)$d['id'] ?>">
                <select name="hospital_id" class="form-select form-select-sm">
                  <?php foreach($hospitals as $h): ?>
                    <option value="<?= $h['id'] ?>"><?= htmlspecialchars($h['name']) ?></option>
                  <?php endforeach; ?>
                </select>
                <button class="btn btn-outline-primary btn-custom"><i class="bi bi-arrow-repeat"></i> Change</button>
              </form>
            <?php else: ?>
              <div class="text-muted mt-2">No actions available</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="col-12">
      <div class="alert alert-info">ℹ️ No doses found. Please contact your hospital for scheduling.</div>
    </div>
  <?php endif; ?>
</div>

<div class="mt-4">
  <a href="./schedule_demo.php" class="btn btn-outline-secondary btn-custom">
    <i class="bi bi-calendar-plus"></i> Create Sample Schedule
  </a>
</div>

<?php include __DIR__ . '/../../templates/partials/footer.php'; ?>
