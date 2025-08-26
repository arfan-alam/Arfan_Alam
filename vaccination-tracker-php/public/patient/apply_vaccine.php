<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
csrf_check();
require_role('patient');

$dose_id = (int)($_POST['dose_id'] ?? 0);
$uid = $_SESSION['user']['id'];

// Mark as pending
$stmt = $pdo->prepare("
    UPDATE doses
    SET status='pending'
    WHERE id=:id AND patient_id=:uid AND status='scheduled'
");
$stmt->execute([':id'=>$dose_id, ':uid'=>$uid]);

header("Location: ../patient/dashboard.php");
exit;
