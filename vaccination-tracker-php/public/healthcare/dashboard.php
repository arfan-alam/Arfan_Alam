<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
require_role('healthcare');

$hid = $_SESSION['user']['hospital_id'] ?? null;

// Get hospital info
$hospital = null;
if ($hid) {
    $stmt = $pdo->prepare("SELECT * FROM hospitals WHERE id = ?");
    $stmt->execute([$hid]);
    $hospital = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Vaccine Stock
$stock = [];
if ($hid) {
    $stmt = $pdo->prepare("
        SELECT v.name, s.vaccine_id, s.stock
        FROM vaccine_stock s
        JOIN vaccines v ON v.id = s.vaccine_id
        WHERE s.hospital_id = ?
    ");
    $stmt->execute([$hid]);
    $stock = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Pending doses
$pending_doses = [];
if ($hid) {
    $stmt = $pdo->prepare("
        SELECT d.id, d.dose_number, d.scheduled_date,
               u.name AS patient_name, v.name AS vaccine_name
        FROM doses d
        JOIN users u ON u.id = d.patient_id
        JOIN vaccines v ON v.id = d.vaccine_id
        WHERE d.hospital_id = ? AND d.status='pending'
        ORDER BY d.scheduled_date
    ");
    $stmt->execute([$hid]);
    $pending_doses = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

include __DIR__ . '/../../templates/partials/header.php';
?>

<div class="container-fluid py-4">
  <!-- Hospital Info -->
  <?php if ($hospital): ?>
    <div class="alert alert-info shadow-sm mb-4">
      <h5 class="mb-0"><i class="bi bi-hospital"></i> <?= htmlspecialchars($hospital['name']) ?></h5>
      <small class="text-muted">Healthcare Dashboard for this hospital</small>
    </div>
  <?php endif; ?>

  <div class="row g-4">
    <!-- Vaccine Stock -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-primary text-white">
          <i class="bi bi-capsule me-2"></i> Vaccine Stock
        </div>
        <div class="card-body p-3">
          <?php if ($stock): ?>
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>Vaccine</th>
                <th class="text-center">Stock</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($stock as $s): ?>
              <tr>
                <td><?= htmlspecialchars($s['name']) ?></td>
                <td class="text-center">
                  <?php if ($s['stock'] > 50): ?>
                    <span class="badge bg-success"><?= (int)$s['stock'] ?></span>
                  <?php elseif ($s['stock'] > 20): ?>
                    <span class="badge bg-warning text-dark"><?= (int)$s['stock'] ?></span>
                  <?php else: ?>
                    <span class="badge bg-danger"><?= (int)$s['stock'] ?></span>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <?php else: ?>
            <p class="text-muted">No stock data available.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Pending Doses -->
    <div class="col-md-6">
      <div class="card shadow-sm h-100">
        <div class="card-header bg-warning">
          <i class="bi bi-clock-history me-2"></i> Pending Doses
        </div>
        <div class="card-body p-3">
          <?php if ($pending_doses): ?>
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Patient</th>
                  <th>Vaccine</th>
                  <th>Dose #</th>
                  <th>Scheduled Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($pending_doses as $d): ?>
                <tr>
                  <td><i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($d['patient_name']) ?></td>
                  <td><?= htmlspecialchars($d['vaccine_name']) ?></td>
                  <td class="text-center"><?= (int)$d['dose_number'] ?></td>
                  <td><span class="text-muted"><?= htmlspecialchars($d['scheduled_date']) ?></span></td>
                  <td>
                    <form method="post" action="apply_dose.php" class="d-inline">
                      <?php csrf_field(); ?>
                      <input type="hidden" name="dose_id" value="<?= (int)$d['id'] ?>">
                      <button class="btn btn-sm btn-success">
                        <i class="bi bi-check2-circle"></i> Complete
                      </button>
                    </form>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php else: ?>
            <p class="text-muted">No pending doses at the moment.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../../templates/partials/footer.php'; ?>
