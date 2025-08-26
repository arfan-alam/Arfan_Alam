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

<div class="row g-3">
  <!-- Vaccine Stock -->
  <div class="col-md-6">
    <div class="p-4 bg-white rounded shadow-sm">
      <h2 class="h6">Vaccine Stock</h2>
      <table class="table table-sm">
        <thead><tr><th>Vaccine</th><th>Stock</th></tr></thead>
        <tbody>
          <?php foreach($stock as $s): ?>
          <tr>
            <td><?= htmlspecialchars($s['name']) ?></td>
            <td><?= (int)$s['stock'] ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pending Doses -->
  <div class="col-md-6">
    <div class="p-4 bg-white rounded shadow-sm">
      <h2 class="h6">Pending Doses</h2>
      <table class="table table-sm">
        <thead>
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
            <td><?= htmlspecialchars($d['patient_name']) ?></td>
            <td><?= htmlspecialchars($d['vaccine_name']) ?></td>
            <td><?= (int)$d['dose_number'] ?></td>
            <td><?= htmlspecialchars($d['scheduled_date']) ?></td>
            <td>
              <form method="post" action="apply_dose.php">
                <?php csrf_field(); ?>
                <input type="hidden" name="dose_id" value="<?= (int)$d['id'] ?>">
                <button class="btn btn-sm btn-success">Mark Completed</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../../templates/partials/footer.php'; ?>
