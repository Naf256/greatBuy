<?php
session_start();
require_once('../controllers/AuthenticationController.php');
if (empty($_SESSION['username'])) {
	header('Location: login.php');
	exit();
}

$authController = new AuthenticationController();

$userinfo = $authController->fetchUserInfo($_SESSION['username']);

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

        <h2>Task Management</h2>
        <ul>
			<li><a href="report_task.php">report task</a></li>
			<li><a href="#"></a></li>
        </ul>
    </div>
    <div class="container">
    <h1 id="profile">User Profile</h1>
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
            <th>Email</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Address</th>
        </tr>
        <tr>
			<td><?= $userinfo['user_id'] ?></td>
            <td><?= $userinfo['username'] ?></td>
            <td><?= $userinfo['password'] ?></td>
            <td><?= $userinfo['role'] ?></td>
            <td><?= $userinfo['email'] ?></td>
            <td><?= $userinfo['name'] ?></td>
            <td><?= $userinfo['phone_number'] ?></td>
            <td><?= $userinfo['address'] ?></td>
        </tr>
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
</style>
</html>
