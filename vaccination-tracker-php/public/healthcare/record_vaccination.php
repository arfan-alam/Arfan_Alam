<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
csrf_check(); require_role('healthcare');

$hid = $_SESSION['user']['hospital_id'] ?? null;
if (!$hid) { die("Your account has no hospital assigned. Contact admin."); }

$email = trim($_POST['patient_email'] ?? '');
$vaccine_id = (int)($_POST['vaccine_id'] ?? 0);
$dose_number = (int)($_POST['dose_number'] ?? 1);
$date_given = $_POST['date_given'] ?? (new DateTime())->format('Y-m-d');

$pdo->beginTransaction();
try {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND role='patient'");
    $stmt->execute([$email]);
    $patient_id = $stmt->fetchColumn();
    if (!$patient_id) { throw new Exception("Patient not found"); }

    // Deduct stock
    $stmt = $pdo->prepare("SELECT stock_qty FROM vaccine_stock WHERE hospital_id=? AND vaccine_id=?");
    $stmt->execute([$hid, $vaccine_id]);
    $stock = $stmt->fetchColumn();
    if ($stock === false || $stock <= 0) { throw new Exception("Insufficient stock"); }
    $stmt = $pdo->prepare("UPDATE vaccine_stock SET stock_qty = stock_qty - 1 WHERE hospital_id=? AND vaccine_id=?");
    $stmt->execute([$hid, $vaccine_id]);

    // Mark any matching scheduled dose as completed
    $stmt = $pdo->prepare("UPDATE doses SET status='completed', completed_date=? WHERE patient_id=? AND vaccine_id=? AND dose_number=?");
    $stmt->execute([$date_given, $patient_id, $vaccine_id, $dose_number]);

    // Insert log
    $stmt = $pdo->prepare("INSERT INTO vaccinations_log (patient_id, vaccine_id, dose_number, date_given, hospital_id) VALUES (?,?,?,?,?)");
    $stmt->execute([$patient_id, $vaccine_id, $dose_number, $date_given, $hid]);

    $pdo->commit();
    header("Location: ../healthcare/dashboard.php");
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
    die("Error: " . $e->getMessage());
}
