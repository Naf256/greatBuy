<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

require_once('../controllers/AuthenticationController.php');

$authController = new AuthenticationController();

$_SESSION['userinfo'] = $authController->fetchUserInfo($_SESSION['username']);

header('Location: ../views/admin_dashboard.php');

?>
