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
    $username = $_POST["username"];
    if (empty($username)) {
        $errors["username"] = "Username is required";
    }

    $password = $_POST["password"];
    if (empty($password)) {
        $errors["password"] = "Password is required";
    }

    $role = $_POST["role"];
    if (empty($role)) {
        $errors["role"] = "Role is required";
    }

    $email = $_POST["email"];
    if (empty($email)) {
        $errors["email"] = "Email is required";
    }

    $name = $_POST["name"];

    $phone_number = $_POST["phone_number"];

    $address = $_POST["address"];

    // If there are no validation errors, proceed to add the user
    if (empty($errors)) {
        $admin = new AdminController();
        $admin->addUser($name, $username, $password, $role, $email, $phone_number, $address);
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
        <!-- Add links for other functionalities like Orders, etc. -->
    </div>
    <div class="container">
        <h1 id="heading">Add New User</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required><br>
            <?php if (isset($errors['username'])) echo "<p class='error'>" . $errors['username'] . "</p>"; ?>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <?php if (isset($errors['password'])) echo "<p class='error'>" . $errors['password'] . "</p>"; ?>

            <label for="role">Role:</label><br>
            <select id="role" name="role" required>
                <option value="" disabled selected>Select role</option>
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
                <option value="customer">Customer</option>
                <option value="delivery Man">Delivery Man</option>
            </select><br>
            <?php if (isset($errors['role'])) echo "<p class='error'>" . $errors['role'] . "</p>"; ?>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required><br>
            <?php if (isset($errors['email'])) echo "<p class='error'>" . $errors['email'] . "</p>"; ?>

            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"><br>

            <label for="phone_number">Phone Number:</label><br>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : ''; ?>"><br>

            <label for="address">Address:</label><br>
            <textarea id="address" name="address" rows="4" cols="50"><?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?></textarea><br>

            <button type="submit">Add User</button>
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
		margin-top: 2%;
		margin-left: 25%;
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
