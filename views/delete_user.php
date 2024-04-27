<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

$users = [];

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
			<li><a href="delete_product.php">Delete Product</a></li>
            <li><a href="edit_product.php">Edit Product</a></li>
            <li><a href="view_products.php">View Products</a></li>
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
            <li><a href="view_tasks.php">tasks</a></li>
            <li><a href="view_attendence.php">attendence</a></li>
        </ul>
		<a href="calculator.php"><h2>Calculator</h2></a>
		<a href="view_orders.php"><h2>Orders</h2></a>
		<a href="review_admin.php"><h2>Reviews</h2></a>
    </div>
    <div class="container">
		<h1 id="heading">Users</h1>
		<table>
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
			<tr>
				<td><?= $user['user_id'] ?></td>
				<td><?= $user['name'] ?></td>
				<td><?= $user['username'] ?></td>
				<td><?= $user['password'] ?></td>
				<td><?= $user['role'] ?></td>
				<td><?= $user['email'] ?></td>
				<td><?= $user['phone_number'] ?></td>
				<td><?= $user['address'] ?></td>
				<td><button class="delete-btn" data-user-id="<?= $user['user_id'] ?>">Delete</button></td>
			</tr>
			<?php endforeach; ?>
		</table>       <!-- Content goes here -->
    </div>
	<script>

	 $(document).ready(function() {
            // Add event listener to delete buttons
            $('.delete-btn').click(function() {
                // Get the product ID
                var userId = $(this).data('user-id');
                // Send AJAX request to delete the product
                $.ajax({
                    url: '../controllers/AdminController.php',
                    type: 'POST',
                    data: { action: 'delete_user', user_id: userId },
                    success: function(response) {
                        // Remove the deleted product row from the table
                        $('button[data-user-id="' + userId + '"]').closest('tr').remove();
                        // Show a success message or handle any other logic
                        console.log('user deleted successfully.');
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
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

	.delete-btn {
        background-color: #dc3545; /* Red background color */
        color: #fff; /* White text color */
        border: none; /* Remove border */
        padding: 8px 16px; /* Add padding */
        border-radius: 4px; /* Add rounded corners */
        cursor: pointer; /* Add pointer cursor on hover */
        transition: background-color 0.3s ease; /* Add smooth transition for background color */
    }

    .delete-btn:hover {
        background-color: #c82333; /* Darker red background color on hover */
    }
</style>
</html>
