<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'employee' ) {
	header('Location: login.php');
	exit();
}

require_once('../controllers/EmployeeController.php');

$employee = new EmployeeController();

$tasks = $employee->getTasksByUserId($_SESSION['user_id']);

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
		<a href="employee_bonus.php"><h2>Employee Bonus</h2></a>
    </div>
    <div class="container">
		<h1 class="profile">Tasks</h1>
		<table id="tasks-table">
            <tr>
                <th>Task ID</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Assigned To</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php foreach ($tasks as $task): ?>
                <tr data-task-id="<?= $task['task_id'] ?>">
                    <td><?= $task['task_id'] ?></td>
                    <td><?= $task['task_description'] ?></td>
                    <td><?= $task['due_date'] ?></td>
                    <td class="editable" data-field="status">
                        <select>
                            <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                        </select>
                    </td>
                    <td><?= $task['username'] ?></td>
                    <td><?= $task['role'] ?></td>
                    <td><button class="save-btn">Save Changes</button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$('#tasks-table').on('click', '.save-btn', function() {
			var $row = $(this).closest('tr');
			var taskId = $row.data('task-id');
			var newStatus = $row.find('select').val();

			$.ajax({
				url: '../controllers/EmployeeController.php',
				type: 'POST',
				data: {
					action: 'update_task_status',
					task_id: taskId,
					new_status: newStatus
				},
				success: function(response) {
					console.log('Task status updated successfully.');
				},
				error: function(xhr, status, error) {
					console.error('Error updating task status:', error);
				}
			});
		});
	});
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
	.profile {
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

	select, button {
		width: 100%;
		padding: 10px;
		margin-bottom: 20px;
		border: 1px solid #ccc;
		border-radius: 5px;
		box-sizing: border-box;
		font-size: 16px;
	}

	button {
		background-color: #007bff;
		color: #fff;
		cursor: pointer;
		transition: background-color 0.3s ease;
	}

	button:hover {
		background-color: #0056b3;
	}
</style>
</html>
