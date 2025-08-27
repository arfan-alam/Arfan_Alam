<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
csrf_check(); 
require_role('admin');

$name = trim($_POST['name'] ?? '');

if ($name) {
    $stmt = $pdo->prepare("INSERT INTO hospitals (name) VALUES (?)");
    $stmt->execute([$name]);
    $hid = $pdo->lastInsertId();

    // Seed vaccine stock for this hospital
    $pdo->exec("INSERT INTO vaccine_stock (hospital_id, vaccine_id, stock)
                SELECT $hid, id, stock FROM vaccines");
}

header("Location: ../admin/dashboard.php");
exit;
