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

<div class="row g-3">
  <div class="col-12">
    <div class="p-4 bg-white rounded shadow-sm">
      <h1 class="h5 mb-3">My Doses</h1>
      <p class="text-muted">You can apply for your scheduled doses or change your hospital for upcoming doses.</p>

      <table class="table table-sm align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Vaccine</th>
            <th>Scheduled</th>
            <th>Status</th>
            <th>Hospital</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($doses as $d): ?>
            <tr>
              <td><?= (int)$d['dose_number'] ?></td>
              <td><?= htmlspecialchars($d['vaccine_name']) ?></td>
              <td><?= htmlspecialchars($d['scheduled_date'] ?? '-') ?></td>
              <td>
                <span class="badge 
                  <?= $d['status']=='completed'?'bg-success':($d['status']=='pending'?'bg-warning':'bg-secondary') ?>">
                  <?= htmlspecialchars($d['status']) ?>
                </span>
              </td>
              <td><?= htmlspecialchars($d['hospital_name'] ?? '-') ?></td>
              <td>
                <?php if ($d['status'] === 'scheduled'): ?>
                  <div class="d-flex flex-column gap-1">

                    <!-- Patient Apply Dose -->
                    <form method="post" action="apply_vaccine.php">
                      <?php csrf_field(); ?>
                      <input type="hidden" name="dose_id" value="<?= (int)$d['id'] ?>">
                      <button class="btn btn-sm btn-warning w-100">Apply Dose</button>
                    </form>

                    <!-- Change Hospital -->
                    <form method="post" action="hospital_change.php" class="d-flex gap-1 mt-1">
                      <?php csrf_field(); ?>
                      <input type="hidden" name="dose_id" value="<?= (int)$d['id'] ?>">
                      <select name="hospital_id" class="form-select form-select-sm">
                        <?php foreach($hospitals as $h): ?>
                          <option value="<?= $h['id'] ?>"><?= htmlspecialchars($h['name']) ?></option>
                        <?php endforeach; ?>
                      </select>
                      <button class="btn btn-sm btn-outline-primary">Change</button>
                    </form>

                  </div>
                <?php else: ?>
                  - 
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <a href="./schedule_demo.php" class="btn btn-sm btn-outline-secondary">Create sample schedule</a>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../../templates/partials/footer.php'; ?>
