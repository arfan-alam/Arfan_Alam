<?php
// update_task.php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "Task ID missing!";
    exit();
}

$task_id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch the task
$sql = "SELECT * FROM tasks WHERE id = $task_id AND user_id = $user_id";
$result = $mysqli->query($sql);
$task = $result->fetch_assoc();

if (!$task) {
    echo "Task not found or access denied.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $mysqli->real_escape_string(trim($_POST['title']));
    $description = $mysqli->real_escape_string(trim($_POST['description']));

    $update_sql = "UPDATE tasks SET title = '$title', description = '$description' WHERE id = $task_id AND user_id = $user_id";
    
    if ($mysqli->query($update_sql)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Update failed: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Task</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            animation: fadeInUp 0.6s ease-out;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #555;
            font-size: 14px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #66a6ff;
            outline: none;
            box-shadow: 0 0 5px rgba(102, 166, 255, 0.5);
        }

        textarea {
            resize: none;
        }

        .btn {
            width: 100%;
            margin-top: 20px;
            background-color: #66a6ff;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #5594e6;
            transform: translateY(-2px);
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .back-link a {
            color: #66a6ff;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Task</h2>
        <form action="update_task.php?id=<?= $task_id ?>" method="POST">
            <label>Title:</label>
            <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>

            <label>Description:</label>
            <textarea name="description" rows="4" required><?= htmlspecialchars($task['description']) ?></textarea>

            <input type="submit" value="Update Task" class="btn">
        </form>
        <div class="back-link">
            <a href="dashboard.php">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
