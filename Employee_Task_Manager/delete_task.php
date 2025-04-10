<?php
// delete_task.php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = intval($_POST['task_id']);
    $user_id = $_SESSION['user_id'];

    // Delete task only if it belongs to the logged in user
    $sql = "DELETE FROM tasks WHERE id = $task_id AND user_id = $user_id";
    $mysqli->query($sql);
}

header("Location: dashboard.php");
exit();
?>
