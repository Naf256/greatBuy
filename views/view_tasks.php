<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

require_once('../controllers/AdminController.php');
$admin = new AdminController();

$tasks = $admin->getTasksForAdmin();

$orders = $admin->getPendingOrders();

$mens = $admin->getDeliveryMen();

$employees = $admin->getAllEmployees();

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
        <h1>Admin Dashboard</h1>
        <h2>Product Management</h2>
        <ul>
            <li><a href="add_product.php">Add Product</a></li>
			<li><a href="delete_product.php">Delete Product</a></li>
            <li><a href="edit_product.php">Edit Product</a></li>
            <li><a href="view_products.php">View Products</a></li>
        </ul>

		<h2>User Management</h2>
        <ul>
            <li><a href="add_user.php">Add User</a></li>
            <li><a href="delete_user.php">Delete User</a></li>
            <li><a href="edit_user.php">Edit User</a></li>
            <li><a href="view_users.php">View Users</a></li>
        </ul>
		<h2>Work Management</h2>
        <ul>
            <li><a href="view_tasks.php">tasks</a></li>
            <li><a href="view_attendence.php">attendence</a></li>
        </ul>
		<a href="calculator.php"><h2>Calculator</h2></a>
		<a href="view_orders.php"><h2>Orders</h2></a>
		<a href="review_admin.php"><h2>Reviews</h2></a>
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
		<form id="task-form" action="../controllers/AdminController.php" method="post">
			<label for="task-description">Task Description:</label><br>
			<textarea id="task-description" name="task_description" rows="4" cols="50" required></textarea><br><br>

			<label for="assigned-to">Assign To:</label><br>
			<select id="assigned-to" name="assigned_to" required>
				<?php foreach ($employees as $employee): ?>
					<option value="<?= $employee['user_id'] ?>"><?= $employee['username'] ?></option>
				<?php endforeach; ?>
			</select><br><br>
			<input type="hidden" name="action" value="new_task">
			<button type="submit">Create Task</button>
		</form>

		<h1 class="profile">Set Delivery</h1>
		<form id="delivery-form" action="../controllers/AdminController.php" method="post">
			<label for="order-id">Select Order:</label>
			<select id="order-id" name="order_id">
				<?php foreach ($orders as $order): ?>
				<option value="<?= $order['order_id'] ?>"><?= $order['order_id'] ?>    Product Name: <?= $order['name']?></option>
				<?php endforeach; ?>
			</select>

			<label for="delivery-man">Select Delivery Man:</label>
			<select id="delivery-man" name="delivery_man_id">
				<?php foreach ($mens as $man): ?>
					<option value="<?= $man['user_id'] ?>"><?= $man['username'] ?></option>
				<?php endforeach; ?>
			</select>

			<input type="hidden" name="action" value="set_delivery">
			<button type="submit">Set</button>
		</form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tasks-table').on('click', '.save-btn', function() {
                var $row = $(this).closest('tr');
                var taskId = $row.data('task-id');
                var newStatus = $row.find('select').val();

                $.ajax({
                    url: '../controllers/AdminController.php',
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
