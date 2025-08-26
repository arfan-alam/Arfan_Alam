<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
csrf_check(); require_role('admin');

$uid = (int)($_POST['user_id'] ?? 0);
$hid = $_POST['hospital_id'] !== '' ? (int)$_POST['hospital_id'] : null;
$stmt = $pdo->prepare("UPDATE users SET hospital_id = :hid WHERE id = :uid");
$stmt->bindValue(':hid', $hid, $hid === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
$stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
$stmt->execute();
header("Location: ../admin/dashboard.php"); exit;
