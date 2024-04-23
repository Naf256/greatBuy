<?php
session_start();
require_once('../controllers/AuthenticationController.php');
if (empty($_SESSION['username'])) {
	header('Location: login.php');
	exit();
}

require_once('../model/Attendance.php');

$model = new AttendanceModel();


$attendances = [];

$attendances = $model->getAttendanceHistoryByUserId($_SESSION['user_id']);

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

        <h1>Employee Dashboard</h1>
        <h2>Attendance Management</h2>
        <ul>
			<li><a href="mark_attendance.php">Mark attendance</a></li>
			<li><a href="view_attendance_employee.php">View attendance</a></li>
        </ul>

    </div>
    <div class="container">
		<h1 id="profile">Attendance History</h1>
		<table>
			<tr>
				<th>Username</th>
				<th>Date</th>
				<th>Status</th>
			</tr>
			<?php foreach ($attendances as $attendance): ?>
				<tr>
					<td><?php echo $_SESSION['username'] ?></td>
					<td><?= $attendance['date'] ?></td>
					<td><?= $attendance['status'] ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
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

	table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    td:first-child {
        font-weight: bold;
    }
</style>
</html>
