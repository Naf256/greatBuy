<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

$tasks = [];
$orders = [];
$mens = [];
$employees = [];

$tasks = $_SESSION['tasks'];

$orders = $_SESSION['orders'];

$mens = $_SESSION['mens'];

$employees = $_SESSION['employees'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

    <div class="sidebar">

        <a href="../controllers/admin_dashboard_controller.php"><h1>Admin Dashboard</h1><a/>
        <h2>Product Management</h2>
        <ul>
            <li><a href="add_product.php">Add Product</a></li>
			<li><a href="../controllers/delete_product_controller.php">Delete Product</a></li>
            <li><a href="../controllers/edit_product_controller.php">Edit Product</a></li>
            <li><a href="../controllers/view_products_controller.php">View Products</a></li>
        </ul>

		<h2>User Management</h2>
        <ul>
            <li><a href="add_user.php">Add User</a></li>
            <li><a href="../controllers/delete_user_controller.php">Delete User</a></li>
            <li><a href="../controllers/edit_user_controller.php">Edit User</a></li>
            <li><a href="../controllers/view_users_controller.php">View Users</a></li>
        </ul>
		<h2>Work Management</h2>
        <ul>
            <li><a href="../controllers/view_tasks_controller.php">tasks</a></li>
            <li><a href="../controllers/view_attendence_controller.php">attendance</a></li>
        </ul>
		<a href="calculator.php"><h2>Calculator</h2></a>
		<a href="../controllers/view_orders_controller.php"><h2>Orders</h2></a>
		<a href="../controllers/review_admin_controller.php"><h2>Reviews</h2></a>
		<a href="../controllers/logout.php"><h2>Logout</h2></a>
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

		<h1 class="profile">Create Task</h1>
		<form id="task-form" action="../controllers/AdminController.php" method="post" novalidate>
			<label for="task-description">Task Description:</label><br>
			<textarea id="task-description" name="task_description" rows="4" cols="50"></textarea><br><br>
			<p id="description-error" class="error-message"></p><br>

			<label for="assigned-to">Assign To:</label><br>
			<select id="assigned-to" name="assigned_to">
				<?php foreach ($employees as $employee): ?>
					<option value="<?= $employee['user_id'] ?>"><?= $employee['username'] ?></option>
				<?php endforeach; ?>
			</select><br><br>
			<p id="assigned-to-error" class="error-message"></p><br>
			<input type="hidden" name="action" value="new_task">
			<button type="submit">Create Task</button>
		</form>
		<h1 class="profile">Set Delivery</h1>
		<form id="delivery-form" action="../controllers/AdminController.php" method="post" onvalidate>
			<label for="order-id">Select Order:</label>
			<select id="order-id" name="order_id">
				<?php foreach ($orders as $order): ?>
				<option value="<?= $order['order_id'] ?>"><?= $order['name']?></option>
				<?php endforeach; ?>
			</select>
			<p id="order-id-error" class="error-message"></p>

			<label for="delivery-man">Select Delivery Man:</label>
			<select id="delivery-man" name="delivery_man_id">
				<?php foreach ($mens as $man): ?>
					<option value="<?= $man['user_id'] ?>"><?= $man['username'] ?></option>
				<?php endforeach; ?>
			</select>
			<p id="delivery-man-error" class="error-message"></p>

			<input type="hidden" name="action" value="set_delivery">
			<button type="submit">Set</button>
		</form>
    </div>

    <script>
	document.addEventListener('DOMContentLoaded', function() {
		var saveButtons = document.querySelectorAll('#tasks-table .save-btn');

		saveButtons.forEach(function(saveButton) {
			saveButton.addEventListener('click', function() {
				var row = this.closest('tr');
				var taskId = row.getAttribute('data-task-id');
				var newStatus = row.querySelector('select').value;

				var formData = new FormData();
				formData.append('action', 'update_task_status');
				formData.append('task_id', taskId);
				formData.append('new_status', newStatus);

				fetch('../controllers/AdminController.php', {
					method: 'POST',
					body: formData
				})
				.then(function(response) {
					if (response.ok) {
						console.log('Task status updated successfully.');
					} else {
						console.error('Error updating task status:', response.statusText);
					}
				})
				.catch(function(error) {
					console.error('Error updating task status:', error);
				});
			});
		});
	});

	 document.getElementById('task-form').addEventListener('submit', function(event) {
        var description = document.getElementById('task-description').value.trim();
        var assignedTo = document.getElementById('assigned-to').value.trim();
        var descriptionError = document.getElementById('description-error');
        var assignedToError = document.getElementById('assigned-to-error');
        var isValid = true;

        // Reset error messages
        descriptionError.textContent = '';
        assignedToError.textContent = '';

        if (description === '') {
            descriptionError.textContent = 'Task Description cannot be empty.';
            isValid = false;
        }

        if (assignedTo === '') {
            assignedToError.textContent = 'Please select an employee to assign the task.';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

	document.getElementById('delivery-form').addEventListener('submit', function(event) {
        var order = document.getElementById('order-id').value.trim();
        var deliveryMan = document.getElementById('delivery-man').value.trim();
        var orderError = document.getElementById('order-id-error');
        var deliveryManError = document.getElementById('delivery-man-error');
        var isValid = true;

        // Reset error messages
        orderError.textContent = '';
        deliveryManError.textContent = '';

        if (order === '') {
            orderError.textContent = 'Please select an order.';
            isValid = false;
        }

        if (deliveryMan === '') {
            deliveryManError.textContent = 'Please select a delivery man.';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
    </script>
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
		background-color: #33b0ff;
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
	body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
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
