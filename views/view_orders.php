<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

$products = $_SESSION['products'];

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
		<h1 id="heading">Products</h1>
		<table id="product-table">
			<tr>
				<th>Product ID</th>
				<th>Name</th>
				<th>Total Amount</th>
				<th>Discount Percentage</th>
				<th>Order Status</th>
				<th>Action</th>
			</tr>

			<?php foreach ($products as $product): ?>
				<tr data-product-id="<?= $product['product_id'] ?>">
					<td><?= $product['product_id'] ?></td>
					<td class="editable" data-field="name"><?= $product['product_name'] ?></td>
					<td class="editable" data-field="total_amount" id="total_amount"><?= $product['total_amount'] ?></td>
					<td class="editable" data-field="discount_percentage" contenteditable="true"><?= $product['discount_percentage'] ?></td>
					<td class="editable" data-field="order_status"><?= $product['order_status'] ?></td>
					<td><button class="save-btn" data-product-id="<?= $product['product_id'] ?>">Edit</button></td>
				</tr>
			<?php endforeach; ?>
    	</table> 
	</div>
	<script>

	document.addEventListener('DOMContentLoaded', function() {
		
		document.getElementById('product-table').addEventListener('input', function(event) {
			if (event.target && event.target.dataset.field === 'discount_percentage') {
				var row = event.target.closest('tr');
                var totalAmount = parseFloat(row.querySelector('td[data-field="total_amount"]').textContent);
				var discountPercentage = isNaN(parseFloat(event.target.textContent)) ? 0 : parseFloat(event.target.textContent);
				var discountedAmount = totalAmount - (totalAmount * (discountPercentage / 100));
				// console.table({ totalAmount, discountPercentage, discountedAmount });
				row.querySelector('td[data-field="total_amount"]').textContent = discountedAmount.toFixed(2);
			}
		});

		document.getElementById('product-table').addEventListener('click', function(event) {
			if (event.target && event.target.classList.contains('save-btn')) {
				var row = event.target.closest('tr');
				var productId = row.dataset.productId;
				var updatedValues = {};
				row.querySelectorAll('.editable').forEach(function(element) {
					var fieldName = element.dataset.field;
					var editedValue = element.textContent;
					updatedValues[fieldName] = editedValue;
				});

				var jsonData = JSON.stringify(updatedValues);
				var xhr = new XMLHttpRequest();
				xhr.open('POST', '../controllers/AdminController.php');
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				xhr.onload = function() {
					if (xhr.status === 200) {
						console.log('Product updated successfully.');
					} else {
						console.error('Error updating product:', xhr.statusText);
					}
				};
				xhr.onerror = function() {
					console.error('Error updating product:', xhr.statusText);
				};
				xhr.send('action=update_order&product_id=' + encodeURIComponent(productId) + '&updated_values=' + encodeURIComponent(jsonData));
			}
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

	.save-btn {
		background-color: #4caf50; 
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
		background-color: #45a049;
	}
</style>
</html>
