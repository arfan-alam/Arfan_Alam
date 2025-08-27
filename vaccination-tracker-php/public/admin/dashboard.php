<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
require_role('admin');

$hospitals = $pdo->query("SELECT * FROM hospitals ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
$vaccines  = $pdo->query("SELECT * FROM vaccines ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
$users     = $pdo->query("SELECT id,name,email,role,hospital_id FROM users ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../../templates/partials/header.php';
?>

<style>
  body {
    background: #f0f4f8;
    font-family: 'Segoe UI', sans-serif;
  }
  .summary-card {
    color: #fff;
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .summary-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
  }
  .summary-card h2 {
    font-size: 30px;
    margin-bottom: 5px;
  }
  .summary-card p {
    font-size: 16px;
  }
  .card-section {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: box-shadow 0.3s;
  }
  .card-section:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
  }
  .card-section h2 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #00796b;
  }
  table.table {
    border-radius: 10px;
    overflow: hidden;
  }
  table.table th {
    background: #00796b;
    color: #fff;
  }
  table.table td, table.table th {
    vertical-align: middle;
  }
  .badge-role {
    padding: 5px 10px;
    border-radius: 12px;
    font-size: 12px;
  }
  .btn-custom {
    border-radius: 10px;
    transition: all 0.3s;
  }
  .btn-custom:hover {
    transform: translateY(-2px);
  }
</style>

<div class="container my-4">
  <!-- Dashboard Summary -->
  <div class="row mb-4 g-3">
    <div class="col-md-4">
      <div class="summary-card" style="background: linear-gradient(45deg,#00c6ff,#0072ff);">
        <h2><?= count($hospitals) ?></h2>
        <p>Hospitals</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="summary-card" style="background: linear-gradient(45deg,#43e97b,#38f9d7);">
        <h2><?= count($vaccines) ?></h2>
        <p>Vaccines</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="summary-card" style="background: linear-gradient(45deg,#f54ea2,#ff7676);">
        <h2><?= count($users) ?></h2>
        <p>Users</p>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <!-- Hospitals Section -->
    <div class="col-md-4">
      <div class="card-section">
        <h2>🏥 Hospitals</h2>
        <form class="d-flex mb-3" method="post" action="hospital_save.php">
          <?php csrf_field(); ?>
          <input name="name" class="form-control me-2" placeholder="New Hospital" required>
          <button class="btn btn-primary btn-custom">Add</button>
        </form>
        <table class="table table-sm">
          <thead>
            <tr><th>Name</th><th>Action</th></tr>
          </thead>
          <tbody>
            <?php foreach($hospitals as $h): ?>
            <tr>
              <td><?= htmlspecialchars($h['name']) ?></td>
              <td>
                <form method="post" action="hospital_delete.php" onsubmit="return confirm('Delete hospital?')">
                  <?php csrf_field(); ?>
                  <input type="hidden" name="id" value="<?= (int)$h['id'] ?>">
                  <button class="btn btn-sm btn-outline-danger btn-custom">Delete</button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Vaccines Section -->
    <div class="col-md-4">
      <div class="card-section">
        <h2>💉 Vaccines</h2>
        <form class="d-flex mb-3" method="post" action="vaccine_save.php">
          <?php csrf_field(); ?>
          <input name="name" class="form-control me-2" placeholder="New Vaccine" required>
          <input name="stock" type="number" class="form-control me-2" placeholder="Stock" value="100" required>
          <button class="btn btn-primary btn-custom">Add</button>
        </form>
        <table class="table table-sm">
          <thead>
            <tr><th>Name</th><th>Stock</th><th>Action</th></tr>
          </thead>
          <tbody>
            <?php foreach($vaccines as $v): ?>
            <tr>
              <td><?= htmlspecialchars($v['name']) ?></td>
              <td><span class="badge bg-success"><?= (int)$v['stock'] ?></span></td>
              <td>
                <form method="post" action="vaccine_delete.php" onsubmit="return confirm('Delete vaccine?')">
                  <?php csrf_field(); ?>
                  <input type="hidden" name="id" value="<?= (int)$v['id'] ?>">
                  <button class="btn btn-sm btn-outline-danger btn-custom">Delete</button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Users Section -->
    <div class="col-md-4">
      <div class="card-section">
        <h2>👥 Users & Roles</h2>

        <!-- Role Update -->
        <form class="mb-3" method="post" action="user_role.php">
          <?php csrf_field(); ?>
          <div class="input-group">
            <select name="id" class="form-select" required>
              <?php foreach($users as $u): ?>
                <option value="<?= (int)$u['id'] ?>"><?= htmlspecialchars($u['name']) ?> (<?= htmlspecialchars($u['email']) ?>)</option>
              <?php endforeach; ?>
            </select>
            <select name="role" class="form-select">
              <option value="patient">patient</option>
              <option value="healthcare">healthcare</option>
              <option value="admin">admin</option>
            </select>
            <button class="btn btn-primary btn-custom">Update</button>
          </div>
        </form>

        <!-- Assign Hospital -->
        <form class="mb-3" method="post" action="assign_hospital.php">
          <?php csrf_field(); ?>
          <div class="input-group">
            <select name="user_id" class="form-select" required>
              <?php foreach($users as $u): ?>
                <option value="<?= (int)$u['id'] ?>"><?= htmlspecialchars($u['name']) ?> (<?= htmlspecialchars($u['role']) ?>)</option>
              <?php endforeach; ?>
            </select>
            <select name="hospital_id" class="form-select">
              <option value="">-- hospital --</option>
              <?php foreach($hospitals as $h): ?>
                <option value="<?= (int)$h['id'] ?>"><?= htmlspecialchars($h['name']) ?></option>
              <?php endforeach; ?>
            </select>
            <button class="btn btn-secondary btn-custom">Assign</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Vaccine Stock Chart -->
  <div class="row mt-4">
    <div class="col-12">
      <div class="card-section">
        <h2>📊 Vaccine Stock Overview</h2>
        <canvas id="vaccineChart" height="100"></canvas>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('vaccineChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($vaccines, 'name')) ?>,
        datasets: [{
            label: 'Stock',
            data: <?= json_encode(array_column($vaccines, 'stock')) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.8)',
            borderRadius: 5
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>

<?php include __DIR__ . '/../../templates/partials/footer.php'; ?>
