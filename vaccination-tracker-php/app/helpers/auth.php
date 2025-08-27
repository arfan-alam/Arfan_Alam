<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

function csrf_token() {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}
function csrf_field() {
    $t = htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8');
    echo "<input type='hidden' name='csrf' value='{$t}'>";
}
function csrf_check() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['csrf']) || !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'])) {
            http_response_code(400);
            die('Invalid CSRF token');
        }
    }
}

function is_logged_in() { return !empty($_SESSION['user']); }
function require_login() {
    if (!is_logged_in()) { header("Location: /public/login.php"); exit; }
}
function require_role($role) {
    require_login();
    if (($_SESSION['user']['role'] ?? '') !== $role) {
        http_response_code(403);
        die('Forbidden');
    }
}
function current_user() { return $_SESSION['user'] ?? null; }
?>
