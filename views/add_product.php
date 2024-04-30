<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

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
		<h1 id="heading">Add New Product</h1>
		<form id="product-form" action="../controllers/add_product_controller.php" method="post" novalidate>
			<label for="name">Name:</label><br>
			<input type="text" id="name" name="name" value=""><br>
			<p id="name-error" class="error"></p>

			<label for="description">Description:</label><br>
			<textarea id="description" name="description" rows="4" cols="50"></textarea><br>
			<p id="description-error" class="error"></p>

			<label for="price">Price:</label><br>
			<input type="number" id="price" name="price" min="0" step="0.01" value=""><br>
			<p id="price-error" class="error"></p>

			<label for="category">Category:</label><br>
			<input type="text" id="category" name="category" value=""><br>
			<p id="category-error" class="error"></p>

			<label for="stock_quantity">Stock Quantity:</label><br>
			<input type="number" id="stock_quantity" name="stock_quantity" min="0" value=""><br>
			<p id="stock_quantity-error" class="error"></p>

			<button type="submit">Add Product</button>
		</form>
	</div>
</body>
<script>
document.getElementById('product-form').addEventListener('submit', function(event) {
		event.preventDefault();

		clearErrors();

		let isValid = true;

		const name = document.getElementById('name').value.trim();
		if (name === '') {
			isValid = false;
			document.getElementById('name-error').textContent = 'Name is required';
		}

		const description = document.getElementById('description').value.trim();
		if (description === '') {
			isValid = false;
			document.getElementById('description-error').textContent = 'Description is required';
		}

		const price = document.getElementById('price').value.trim();
		if (price === '' || isNaN(price) || parseFloat(price) <= 0) {
			isValid = false;
			document.getElementById('price-error').textContent = 'Price must be a positive number';
		}

		const category = document.getElementById('category').value.trim();
		if (category === '') {
			isValid = false;
			document.getElementById('category-error').textContent = 'Category is required';
		}

		const stockQuantity = document.getElementById('stock_quantity').value.trim();
		if (stockQuantity === '' || isNaN(stockQuantity) || parseInt(stockQuantity) < 0) {
			isValid = false;
			document.getElementById('stock_quantity-error').textContent = 'Stock Quantity must be a non-negative integer';
		}

		if (isValid) {
			event.target.submit();
		}
	});

	function clearErrors() {
		const errorElements = document.querySelectorAll('.error');
		errorElements.forEach(function(element) {
			element.textContent = '';
		});
	}
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
	
	body {
        font-family: Arial, sans-serif;
    }

	form {
		max-width: 500px;
		margin: 0 auto;
		padding: 20px;
		background-color: #f9f9f9;
		border-radius: 5px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}

	label {
		font-weight: bold;
	}

	input[type="text"],
	input[type="number"],
	textarea {
		width: 100%;
		padding: 10px;
		margin-bottom: 15px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}

	textarea {
		resize: vertical;
		height: 100px;
	}

	.error {
		color: red;
	}

	button {
		background-color: #4caf50;
		color: white;
		padding: 10px 20px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
		font-size: 16px;
	}

	button:hover {
		background-color: #45a049;
	}
</style>
</html>
