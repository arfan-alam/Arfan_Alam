<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
csrf_check(); require_role('admin');

$id = (int)($_POST['id'] ?? 0);
$role = $_POST['role'] ?? 'patient';
$pdo->prepare("UPDATE users SET role=? WHERE id=?")->execute([$role, $id]);
header("Location: ../admin/dashboard.php"); exit;
