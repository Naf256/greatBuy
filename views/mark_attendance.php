<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: login.php');
	exit();
}


$userinfo = $_SESSION['userinfo'];

$attendance = $_SESSION['attendance'];

$isMarked = $_SESSION['isMarked'];

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
		<h3 id="title">Attendance</h3>
		<?php
			if ($isMarked) {
				?>
				<button class="mark-attendance-btn">Marked</button>
			<?php
				
			} else {
			?>
				<button id="mark" class="mark-attendance-btn">Mark Attendance</button>
		<?php
			}
		?>
    </div>
</body>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		const markButton = document.querySelector('#mark');
		console.log(markButton.textContent)
		markButton.addEventListener('click', (e) => {
			if (markButton.textContent !== 'Marked') {
				markButton.textContent = 'Marked';
				const formData = new FormData();
				formData.append('action', 'mark_attendance');

				fetch('../controllers/AttendanceController.php', {
					method: 'POST',
					body: formData,
				})
				.then(res => res.text())
				.then(data => console.log(data))
			}
		})
	})
</script>
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
 
	.mark-attendance-btn {
        padding: 10px 20px;
        background-color: #f9a054;
		margin-top: 1%;
		margin-left: 40%;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .mark-attendance-btn:hover {
        background-color: #e2a622;
    }
#title {
	font-size: 2em;
	padding: 10px;
	margin-left: 39%;
}
</style>
</html>
