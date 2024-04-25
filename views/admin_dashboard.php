<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

require_once('../controllers/AuthenticationController.php');

$authController = new AuthenticationController();

$userinfo = $authController->fetchUserInfo($_SESSION['username'])

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
