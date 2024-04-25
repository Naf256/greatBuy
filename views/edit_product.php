<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}


require_once('../controllers/AdminController.php');

$adminController = new AdminController();

$products = [];

$result = $adminController->fetchAllProducts();

while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
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
		<h1 id="heading">Products</h1>
		<table id="product-table">
			<tr>
				<th>Product ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Category</th>
				<th>Stock Quantity</th>
			</tr>
			<?php foreach ($products as $product): ?>
				<tr data-product-id="<?= $product['product_id'] ?>">
					<td><?= $product['product_id'] ?></td>
					<td class="editable" data-field="name"><?= $product['name'] ?></td>
					<td class="editable" data-field="description"><?= $product['description'] ?></td>
					<td class="editable" data-field="price"><?= $product['price'] ?></td>
					<td class="editable" data-field="category"><?= $product['category'] ?></td>
					<td class="editable" data-field="stock_quantity"><?= $product['stock_quantity'] ?></td>
					<td><button class="save-btn">Save</button></td>
				</tr>
			<?php endforeach; ?>
		</table>       <!-- Content goes here -->
    </div>

	<script>
	$(document).ready(function() {
		// Add click event listener to edit button
		$('#product-table').on('click', '.editable', function() {
			// Convert the table cell into an input field
			$(this).attr('contenteditable', 'true').focus();
		});


        $('#product-table').on('click', '.save-btn', function() {
            // Get the row containing the edited content
            var $row = $(this).closest('tr');
            // Get the product ID
            var productId = $row.data('product-id');
            // Create an object to store the updated values
            var updatedValues = {};
            // Iterate through each editable field in the row
            var isValid = true; // Flag to track validation

            $row.find('.editable').each(function() {
                // Get the field name (e.g., name, description, price, etc.)
                var fieldName = $(this).data('field');
                // Get the edited value
                var editedValue = $(this).text().trim();

                // Perform validation for each field
                if (fieldName === 'name' || fieldName === 'description' || fieldName === 'category') {
                    // Validate non-empty strings
                    if (editedValue === '') {
                        isValid = false;
                        alert(fieldName.charAt(0).toUpperCase() + fieldName.slice(1) + ' cannot be empty.');
                        return false; // Exit the loop if validation fails
                    }
                } else if (fieldName === 'price' || fieldName === 'stock_quantity') {
                    // Validate numeric values greater than 0
                    if (isNaN(editedValue) || parseFloat(editedValue) <= 0) {
                        isValid = false;
                        alert(fieldName.charAt(0).toUpperCase() + fieldName.slice(1) + ' must be a number greater than 0.');
                        return false; // Exit the loop if validation fails
                    }
                }

                // Add the field name and value to the updatedValues object
                updatedValues[fieldName] = editedValue;
            });

            // If all fields are valid, proceed with AJAX request
            if (isValid) {
                var jsonData = JSON.stringify(updatedValues);
                // Send AJAX request to update the product
                $.ajax({
                    url: '../controllers/AdminController.php',
                    type: 'POST',
                    data: {
                        action: 'update_product',
                        product_id: productId,
                        updated_values: jsonData
                    },
                    success: function(response) {
                        // Handle success response
                        console.log('Product updated successfully.');
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error('Error updating product:', error);
                    }
                });
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
</html>
