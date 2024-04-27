<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

$attendances = $_SESSION['attendances'];

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
    </div>
    <div class="container">
	<h1 id="profile">Attendance</h1>
        <table id="attendance-table">
            <tr>
                <th>Attendance ID</th>
                <th>Username</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php foreach ($attendances as $attendance): ?>
                <tr data-attendance-id="<?= $attendance['attendance_id'] ?>">
                    <td><?= $attendance['attendance_id'] ?></td>
                    <td><?= $attendance['username'] ?></td>
                    <td class="editable" data-field="status">
                        <select>
                            <option value="present" <?= $attendance['status'] === 'present' ? 'selected' : '' ?>>Present</option>
                            <option value="absent" <?= $attendance['status'] === 'absent' ? 'selected' : '' ?>>Absent</option>
                        </select>
                    </td>
                    <td><?= $attendance['date'] ?></td>
                    <td><button class="save-btn">Save Changes</button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#attendance-table').on('click', '.save-btn', function() {
                var $row = $(this).closest('tr');
                var attendanceId = $row.data('attendance-id');
                var newStatus = $row.find('select').val();

                $.ajax({
                    url: '../controllers/AdminController.php',
                    type: 'POST',
                    data: {
                        action: 'update_attendance_status',
                        attendance_id: attendanceId,
                        new_status: newStatus
                    },
                    success: function(response) {
                        console.log('Attendance status updated successfully.');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating attendance status:', error);
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
