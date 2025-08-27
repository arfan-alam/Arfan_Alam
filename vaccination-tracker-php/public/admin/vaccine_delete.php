<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
csrf_check();
require_role('admin');

$id = (int)($_POST['id'] ?? 0);

if ($id) {
    // Delete related doses first
    $stmt = $pdo->prepare("DELETE FROM doses WHERE vaccine_id = ?");
    $stmt->execute([$id]);

    // Optional: Delete related per-hospital stock
    $stmt = $pdo->prepare("DELETE FROM vaccine_stock WHERE vaccine_id = ?");
    $stmt->execute([$id]);

    // Now delete the vaccine
    $stmt = $pdo->prepare("DELETE FROM vaccines WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: ../admin/dashboard.php");
exit;
