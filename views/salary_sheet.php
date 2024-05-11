<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: login.php');
	exit();
}


$absent = $_SESSION['absent'];

$completed_tasks = $_SESSION['completed_tasks'];

$salary = $_SESSION['salary'];

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
        <h1 class="title">Salary Sheet</h1>
        <div class="info">
            <label>Absent:</label>
            <span><?= $absent ?></span>
        </div>
        <div class="info">
            <label>Completed Tasks:</label>
            <span><?= $completed_tasks ?></span>
        </div>
        <div class="info">
            <label>Salary:</label>
            <span>$<?= number_format($salary, 2) ?></span>
        </div>
        <div class="info">
            <label>Deductions (Absent):</label>
            <span>$<?= number_format($absent * 30, 2) ?></span>
        </div>
        <div class="info">
            <label>Additions (Completed Tasks):</label>
            <span>$<?= number_format($completed_tasks * 50, 2) ?></span>
        </div>
        <div class="total">
            Total Amount: $<?= number_format($salary + ($completed_tasks * 50) - ($absent * 30), 2) ?>
        </div>
    </div>
</body>
<style>
	table {
		width: 100%;
		border-collapse: collapse;
	}
	th, td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}
	th {
		background-color: #f2f2f2;
	}
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
	body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .title {
            text-align: center;
            color: #333;
        }
        .info {
            margin-bottom: 10px;
        }
        .info label {
            font-weight: bold;
            color: #555;
        }
        .info span {
            color: #333;
        }
        .total {
            margin-top: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }
</style>
</html>
