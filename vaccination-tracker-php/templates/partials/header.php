<?php require_once __DIR__ . '/../../config/config.php'; ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= APP_NAME ?></title>

<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<style>
  body {
    background: #f0f8ff; /* light vaccine-blue background */
    font-family: 'Segoe UI', sans-serif;
  }

  /* Navbar Custom */
  .navbar {
    background: linear-gradient(90deg, #00c6ff, #0072ff);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
  }
  .navbar .navbar-brand {
    font-weight: 700;
    font-size: 1.6rem;
    color: #fff;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
  }
  .navbar .nav-link {
    color: #e0f7fa !important;
    font-weight: 500;
    transition: color 0.3s, transform 0.3s;
  }
  .navbar .nav-link:hover {
    color: #ffffff;
    transform: translateY(-2px);
  }
  .navbar .nav-link span {
    font-weight: 600;
    color: #fff;
  }

  /* Container / Cards */
  .container {
    padding-top: 30px;
    padding-bottom: 30px;
  }
  .card {
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
  }

  /* Buttons */
  .btn {
    border-radius: 10px;
    transition: all 0.3s;
  }
  .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
  }

  /* Links */
  a {
    text-decoration: none;
  }

  /* Footer spacing */
  footer {
    margin-top: 50px;
    padding: 20px 0;
    background: #0072ff;
    color: #fff;
    text-align: center;
    border-radius: 15px 15px 0 0;
  }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="/public/index.php"><?= APP_NAME ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <?php if (!empty($_SESSION['user'])): ?>
          <li class="nav-item"><span class="nav-link">Hello, <?= htmlspecialchars($_SESSION['user']['name']) ?></span></li>
          <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="../public/login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="../public/register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-4">
<!-- Your page content goes here -->
