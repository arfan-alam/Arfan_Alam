<?php
// dashboard.php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tasks WHERE user_id = $user_id ORDER BY due_date ASC";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Task Manager</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      margin: 0;
      background: linear-gradient(135deg, #667eea, #764ba2);
      padding: 40px 20px;
      color: #333;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .logout {
      text-align: right;
      margin-bottom: 20px;
    }

    .logout a {
      background: #e74c3c;
      color: #fff;
      padding: 8px 14px;
      text-decoration: none;
      border-radius: 6px;
      transition: background 0.3s ease;
    }

    .logout a:hover {
      background: #c0392b;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }

    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #f7f7f7;
    }

    tr:nth-child(even) {
      background-color: #fafafa;
    }

    form {
      margin-top: 20px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
    }

    input[type="text"],
    input[type="date"],
    select,
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 5px;
    }

    textarea {
      resize: vertical;
    }

    input[type="submit"],
    button {
      margin-top: 20px;
      background: #2ecc71;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    input[type="submit"]:hover,
    button:hover {
      background: #27ae60;
    }

    .actions a {
      margin-left: 10px;
      color: #2980b9;
      text-decoration: none;
      font-weight: 600;
    }

    .actions a:hover {
      text-decoration: underline;
    }
  </style>

  <script>
    function confirmDelete() {
      return confirm("Are you sure you want to delete this task?");
    }
  </script>
</head>
<body>
  <div class="container">
    <div class="logout">
      <a href="logout.php">Logout</a>
    </div>

    <h2>Employee Tasks</h2>

    <table>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Due Date</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
      <?php while($task = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($task['title']) ?></td>
        <td><?= htmlspecialchars($task['description']) ?></td>
        <td><?= htmlspecialchars($task['due_date']) ?></td>
        <td><?= htmlspecialchars($task['priority']) ?></td>
        <td><?= htmlspecialchars($task['status']) ?></td>
        <td class="actions">
          <form action="delete_task.php" method="post" style="display:inline;" onsubmit="return confirmDelete();">
            <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
            <button type="submit">Delete</button>
          </form>
          <a href="update_task.php?id=<?= $task['id'] ?>">Update</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>

    <h3>Add a New Task</h3>
    <form action="add_task.php" method="post">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" required>

      <label for="description">Description:</label>
      <textarea id="description" name="description" rows="3"></textarea>

      <label for="due_date">Due Date:</label>
      <input type="date" id="due_date" name="due_date">

      <label for="priority">Priority:</label>
      <select id="priority" name="priority">
        <option value="Low">Low</option>
        <option value="Medium" selected>Medium</option>
        <option value="High">High</option>
      </select>

      <input type="submit" value="Add Task">
    </form>
  </div>
</body>
</html>
