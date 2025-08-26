<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
require_role('admin');

$hospitals = $pdo->query("SELECT * FROM hospitals ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
$vaccines  = $pdo->query("SELECT * FROM vaccines ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
$users     = $pdo->query("SELECT id,name,email,role,hospital_id FROM users ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../../templates/partials/header.php';
?>
<div class="row g-3">
  <div class="col-md-4">
    <div class="p-3 bg-white rounded shadow-sm">
      <h2 class="h6">Hospitals</h2>
      <form class="d-flex mb-2" method="post" action="hospital_save.php">
        <?php csrf_field(); ?>
        <input name="name" class="form-control me-2" placeholder="New Hospital" required>
        <button class="btn btn-primary">Add</button>
      </form>
      <ul class="list-group">
        <?php foreach($hospitals as $h): ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= htmlspecialchars($h['name']) ?>
            <form method="post" action="hospital_delete.php" onsubmit="return confirm('Delete hospital?')">
              <?php csrf_field(); ?>
              <input type="hidden" name="id" value="<?= (int)$h['id'] ?>">
              <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div class="col-md-4">
    <div class="p-3 bg-white rounded shadow-sm">
      <h2 class="h6">Vaccines</h2>
      <form class="d-flex mb-2" method="post" action="vaccine_save.php">
        <?php csrf_field(); ?>
        <input name="name" class="form-control me-2" placeholder="New Vaccine" required>
        <input name="stock" type="number" class="form-control me-2" placeholder="Stock" value="100" required>
        <button class="btn btn-primary">Add</button>
      </form>
      <ul class="list-group">
        <?php foreach($vaccines as $v): ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= htmlspecialchars($v['name']) ?> (Total: <?= (int)$v['stock'] ?>)
            <form method="post" action="vaccine_delete.php" onsubmit="return confirm('Delete vaccine?')">
              <?php csrf_field(); ?>
              <input type="hidden" name="id" value="<?= (int)$v['id'] ?>">
              <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div class="col-md-4">
    <div class="p-3 bg-white rounded shadow-sm">
      <h2 class="h6">Users & Roles</h2>
      <form class="mb-2" method="post" action="user_role.php">
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
          <button class="btn btn-primary">Update Role</button>
        </div>
      </form>
      <form class="mb-2" method="post" action="assign_hospital.php">
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
          <button class="btn btn-secondary">Assign Hospital</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include __DIR__ . '/../../templates/partials/footer.php'; ?>
