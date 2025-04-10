<?php
// add_task.php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $mysqli->real_escape_string(trim($_POST['title']));
    $description = $mysqli->real_escape_string(trim($_POST['description']));
    $due_date = $mysqli->real_escape_string(trim($_POST['due_date']));
    $priority = $mysqli->real_escape_string(trim($_POST['priority']));

    $sql = "INSERT INTO tasks (user_id, title, description, due_date, priority) 
            VALUES ($user_id, '$title', '$description', '$due_date', '$priority')";
    
    $mysqli->query($sql);
}

header("Location: dashboard.php");
exit();
?>
