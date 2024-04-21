<?php
session_start();
if (empty($_SESSION['username'])) {
	header('Location: login.php');
	exit();
}

require_once('../controllers/AuthenticationController.php');

$authController = new AuthenticationController();

$users = [];

$users = $authController->getAllUsers();

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
        <!-- Add links for other functionalities like User Management, Orders, etc. -->
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
			</tr>
			<?php endforeach; ?>
		</table>       <!-- Content goes here -->
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
</style>
</html>
