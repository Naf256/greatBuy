<?php
	session_start();
	// if (empty($_SESSION['user_id'])) {
	// 	header('Location: login.php');
	// 	exit();
	// }
	
	$role = $_SESSION['role'];
	switch ($role) {
		case "admin":
			header('Location: admin_dashboard.php');
			break;
		case "employee":
			header('Location: employee_dashboard.php');
			break;
		case "delivery Man":
			header('Location: deliveryMan_dashboard.php');
			break;
		case "customer":
			header('Location: home_page.php');
			break;
		default:
			header('Location: login.php');
	}
	
	exit();
?>
