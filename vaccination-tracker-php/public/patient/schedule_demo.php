<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../app/helpers/auth.php';
require_role('patient');

// Set timezone
date_default_timezone_set('Asia/Dhaka');

$uid = $_SESSION['user']['id'];
$hospital_id = $_SESSION['user']['hospital_id'] ?? null;

if (!$hospital_id) {
    die("Please select a hospital in your profile before scheduling doses.");
}

// Base date: today
$today = new DateTime();

try {
    $pdo->beginTransaction();

    // Delete existing doses
    $pdo->prepare("DELETE FROM doses WHERE patient_id = ?")->execute([$uid]);

    // Fetch ALL vaccines
    $vaccineIds = $pdo->query("SELECT id FROM vaccines ORDER BY id")->fetchAll(PDO::FETCH_COLUMN);

    // Schedule doses: each next dose 1 day after previous
    $doseNumber = 1;
    $dayOffset = 1;

    foreach ($vaccineIds as $vId) {
        $scheduledDate = clone $today;
        $scheduledDate->modify("+$dayOffset days");
        $stmt = $pdo->prepare("
            INSERT INTO doses 
            (patient_id, vaccine_id, dose_number, scheduled_date, status, hospital_id) 
            VALUES (?, ?, ?, ?, 'scheduled', ?)
        ");
        $stmt->execute([$uid, $vId, $doseNumber, $scheduledDate->format('Y-m-d'), $hospital_id]);

        $doseNumber++;
        $dayOffset++; // next dose scheduled 1 day later
    }

    $pdo->commit();

    header("Location: ../patient/dashboard.php");
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    die("Error scheduling doses: " . $e->getMessage());
}
