<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

$users = $_SESSION['users'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <h1 id="heading">Users</h1>
        <table id="user-table">
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr data-user-id="<?= $user['user_id'] ?>">
                    <td><?= $user['user_id'] ?></td>
                    <td class="editable" data-field="name"><?= $user['name'] ?></td>
                    <td class="editable" data-field="username"><?= $user['username'] ?></td>
                    <td class="editable" data-field="password"><?= $user['password'] ?></td>
                    <td class="editable" data-field="role"><?= $user['role'] ?></td>
                    <td class="editable" data-field="email"><?= $user['email'] ?></td>
                    <td class="editable" data-field="phone_number"><?= $user['phone_number'] ?></td>
                    <td class="editable" data-field="address"><?= $user['address'] ?></td>
                    <td><button class="save-btn">Save</button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#user-table').on('click', '.editable', function() {
                $(this).attr('contenteditable', 'true').focus();
            });

            $('#user-table').on('click', '.save-btn', function() {
                var $row = $(this).closest('tr');
                var userId = $row.data('user-id');
                var updatedValues = {};
                $row.find('.editable').each(function() {
                    var fieldName = $(this).data('field');
                    var editedValue = $(this).text();
                    updatedValues[fieldName] = editedValue;
                });

                var jsonData = JSON.stringify(updatedValues);
                $.ajax({
                    url: '../controllers/AdminController.php',
                    type: 'POST',
                    data: {
                        action: 'update_user',
                        user_id: userId,
                        updated_values: jsonData
                    },
                    success: function(response) {
                        console.log('User updated successfully.');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating user:', error);
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
		background-color: #33b0ff;
		color: #fff;
		padding: 20px;
		position: fixed;
		height: 100%;
		overflow-y: auto;
	}
	.container {
		margin-top: 5%;
		margin-left: 20%;
		padding: 20px;
		<!-- background-color: red; -->
	}
	#heading {
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

	.save-btn {
		background-color: #4caf50; /* Green */
		border: none;
		color: white;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		border-radius: 4px;
		cursor: pointer;
	}

	.save-btn:hover {
		background-color: #45a049; /* Darker green */
	}
</style>

</body>
</html>
