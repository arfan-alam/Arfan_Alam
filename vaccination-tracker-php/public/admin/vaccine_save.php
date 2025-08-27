<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
csrf_check(); 
require_role('admin');

$name  = trim($_POST['name'] ?? '');
$stock = (int)($_POST['stock'] ?? 0);

if ($name) {
    $stmt = $pdo->prepare("INSERT INTO vaccines (name, stock) VALUES (?, ?)");
    $stmt->execute([$name, $stock]);
    $vid = $pdo->lastInsertId();

    // Seed stock for all hospitals
    $pdo->exec("INSERT INTO vaccine_stock (hospital_id, vaccine_id, stock)
                SELECT id, $vid, $stock FROM hospitals");
}

header("Location: ../admin/dashboard.php");
exit;
