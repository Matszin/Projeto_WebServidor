<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['type'] !== 'admin') {
    header("Location: /app/views/auth/login.php");
    exit;
}
?>