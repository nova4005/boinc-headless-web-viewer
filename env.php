<?php
session_start();
$configFile = $_SERVER['DOCUMENT_ROOT'] . '/config.json';
$comp = json_decode(file_get_contents($configFile), true);
$page = explode('/', $_SERVER['REQUEST_URI']);
$page = end($page);

// unset($_SESSION['logged_in']);

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
// exit;

if(!empty($_GET['address'])) {
    $_SESSION['password'] = $comp[$_GET['address']]['password'];
    $_SESSION['address'] = $comp[$_GET['address']]['address'];
    $_SESSION['port'] = $comp[$_GET['address']]['port'];
}

if(empty($comp['login_password']) && $page !== 'auth.php' && empty($_SESSION['logged_in'])) {
    // Redirect to login creation view
    header('Location: /views/auth.php');
    exit;
}

if(empty($_SESSION['logged_in']) && !empty($comp['login_password']) && $page !== 'login.php') {
    header('Location: /views/login.php');
    exit;
}