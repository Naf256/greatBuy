<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: login.php');
	exit();
}

$notifications = [];

$notifications = isset($_SESSION['notifications']) ? $_SESSION['notifications'] : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
</head>
<body>
    <div class="sidebar">
		<a href="../controllers/employee_dashboard_controller.php"><h1>Employee Dashboard</h1></a>
		<a href="../controllers/update_user.php"><h2>Update Profile</h2></a>
        <h2>Attendance Management</h2>
        <ul>
			<li><a href="../controllers/mark_attendance_controller.php">Mark attendance</a></li>
			<li><a href="../controllers/view_attendance_employee_controller.php">View attendance</a></li>
        </ul>

        <h2>Task Management</h2>
        <ul>
			<li><a href="../controllers/report_task_controller.php">report task</a></li>
			<li><a href="#"></a></li>
        </ul>
		<a href="../controllers/employee_bonus_controller.php"><h2>Employee Bonus</h2></a>
		<a href="../controllers/salary_sheet_controller.php"><h2>Salary Sheet</h2></a>
		<a href="../controllers/employee_notification_controller.php"><h2>Notification</h2></a>
		<a href="../controllers/logout.php"><h2>logout</h2></a>
    </div>

    <div class="container">
	<h1 id="profile">Promotional Notifications</h1>
		<?php foreach ($notifications as $notify): ?>    
			<div class="notification">
				<p><?= $notify['message'] ?></p>
			</div>
		<?php endforeach; ?>
    </div>
</body>
<style>
	body {
		font-family: Arial, sans-serif;
		background-color: #f4f4f4;
		margin: 0;
		padding: 0;
		display: flex;
	}
	.sidebar {
		width: 250px;
		background-color: #58c5fa;
		color: #fff;
		padding: 20px;
		position: fixed;
		height: 100%;
		overflow-y: auto;
	}
	.container {
		margin-top: 5%;
		margin-left: 30%;
		padding: 20px;
		<!-- background-color: red; -->
	}
	#profile {
		<!-- border-bottom: 1px solid #ddd; -->
		padding: 10px;
		padding-bottom: 20px;
		color: #181a1b;
	}
	h1 {
		text-align: center;
		color: #ffffff;
	}
	h2 {
		color: #eef4f8;
	}
	ul {
		list-style-type: none;
		padding: 0;
	}
	li {
		margin-bottom: 10px;
	}
	a {
		text-decoration: none;
		color: #fff;
		font-size: 16px;
	}
	a:hover {
		text-decoration: underline;
	}
.notification {
    background-color: #f0f0f0;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.notification p {
    margin: 0;
    font-size: 16px;
    color: #333;
}
</style>
</html>
