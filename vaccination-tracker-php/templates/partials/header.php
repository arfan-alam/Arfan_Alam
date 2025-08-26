<?php require_once __DIR__ . '/../../config/config.php'; ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= APP_NAME ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="/public/index.php"><?= APP_NAME ?></a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <?php if (!empty($_SESSION['user'])): ?>
          <li class="nav-item"><span class="nav-link">Hello, <?= htmlspecialchars($_SESSION['user']['name']) ?></span></li>
          <li class="nav-item"><a class="nav-link" href=" ../logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href=" ../public/login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href=" ../public/register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container my-4">
