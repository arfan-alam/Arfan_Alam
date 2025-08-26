<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
csrf_check(); require_role('admin');
$id = (int)($_POST['id'] ?? 0);
$pdo->prepare("DELETE FROM hospitals WHERE id=?")->execute([$id]);
header("Location: ../admin/dashboard.php"); exit;
