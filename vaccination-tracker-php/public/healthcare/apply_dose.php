<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
csrf_check();
require_role('healthcare');

$dose_id = (int)($_POST['dose_id'] ?? 0);
$hid = $_SESSION['user']['hospital_id'];

// Update dose status to completed
$stmt = $pdo->prepare("
    UPDATE doses
    SET status='completed', completed_date=NOW()
    WHERE id=:id AND hospital_id=:hid AND status='pending'
");
$stmt->execute([':id'=>$dose_id, ':hid'=>$hid]);

// Optional: update stock if you want to deduct
$stmt2 = $pdo->prepare("
    UPDATE vaccine_stock s
    JOIN doses d ON d.vaccine_id = s.vaccine_id
    SET s.stock = s.stock - 1
    WHERE d.id=:id AND s.hospital_id=:hid
");
$stmt2->execute([':id'=>$dose_id, ':hid'=>$hid]);

header("Location: dashboard.php");
exit;
