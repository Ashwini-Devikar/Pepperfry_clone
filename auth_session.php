<?php
session_start();

// 1. Restrict Access: Redirect if session is not set
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 2. Anti-Session Hijacking: Check User Agent
if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>