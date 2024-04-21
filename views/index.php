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
		case "delivery_man":
			header('Location: deliveryMan_dashboard.php');
			break;
		case "customer":
			header('Location: customer_dashboard.php');
			break;
		default:
			header('Location: login.php');
	}
	
	exit();
?>
