<?php
session_start();
if (empty($_SESSION['username'])) {
	header('Location: login.php');
	exit();
}

require_once('../controllers/AdminController.php');

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate each form field
    $name = $_POST["name"];
    if (empty($name)) {
        $errors["name"] = "Name is required";
    }

    $description = $_POST["description"];
    if (empty($description)) {
        $errors["description"] = "Description is required";
    }

    $price = $_POST["price"];
    if (empty($price)) {
        $errors["price"] = "Price is required";
    } elseif (!is_numeric($price) || $price <= 0) {
        $errors["price"] = "Price must be a valid positive number";
    }

    $category = $_POST["category"];
    if (empty($category)) {
        $errors["category"] = "Category is required";
    }

    $stock_quantity = $_POST["stock_quantity"];
    if (empty($stock_quantity)) {
        $errors["stock_quantity"] = "Stock Quantity is required";
    } elseif (!ctype_digit($stock_quantity) || $stock_quantity <= 0) {
        $errors["stock_quantity"] = "Stock Quantity must be a valid positive integer";
    }

    // If there are no validation errors, proceed to add the product
    if (empty($errors)) {
        // Add the product to the database
        // Your database insertion code here
        // Redirect to a success page or display a success message
        // header("Location: success.php");
        // exit();
		$admin = new AdminController();
		$admin->addProduct($name, $description, $price, $category, $stock_quantity);
		//
		header('Location: view_products.php');
		exit();
    }
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
    </div>
	<div class="container">
		<h1 id="heading">Add New Product</h1>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
			<label for="name">Name:</label><br>
			<input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required><br>
			<?php if (isset($errors['name'])) echo "<p class='error'>" . $errors['name'] . "</p>"; ?>
			
			<label for="description">Description:</label><br>
			<textarea id="description" name="description" rows="4" cols="50" required><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea><br>
			<?php if (isset($errors['description'])) echo "<p class='error'>" . $errors['description'] . "</p>"; ?>

			<label for="price">Price:</label><br>
			<input type="number" id="price" name="price" min="0" step="0.01" value="<?php echo isset($_POST['price']) ? $_POST['price'] : ''; ?>" required><br>
			<?php if (isset($errors['price'])) echo "<p class='error'>" . $errors['price'] . "</p>"; ?>

		<label for="category">Category:</label><br>
		<input type="text" id="category" name="category" value="<?php echo isset($_POST['category']) ? $_POST['category'] : ''; ?>" required><br>
		<?php if (isset($errors['category'])) echo "<p class='error'>" . $errors['category'] . "</p>"; ?>

			<label for="stock_quantity">Stock Quantity:</label><br>
			<input type="number" id="stock_quantity" name="stock_quantity" min="0" value="<?php echo isset($_POST['stock_quantity']) ? $_POST['stock_quantity'] : ''; ?>" required><br>
			<?php if (isset($errors['stock_quantity'])) echo "<p class='error'>" . $errors['stock_quantity'] . "</p>"; ?>

			<button type="submit">Add Product</button>
		</form>
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
