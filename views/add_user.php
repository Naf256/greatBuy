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
        <h1 id="heading">Add New User</h1>
		<form id="myForm" action="../controllers/add_user_controller.php" method="POST" novalidate>
			<label for="username">Username:</label><br>
			<input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"><br>
			<p id="usernameError" class="error"></p>

			<label for="password">Password:</label><br>
			<input type="password" id="password" name="password"><br>
			<p id="passwordError" class="error"></p>

			<label for="role">Role:</label><br>
			<select id="role" name="role">
				<option value="" disabled selected>Select role</option>
				<option value="admin">Admin</option>
				<option value="employee">Employee</option>
				<option value="customer">Customer</option>
				<option value="delivery Man">Delivery Man</option>
			</select><br>
			<p id="roleError" class="error"></p>

			<label for="email">Email:</label><br>
			<input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"><br>
			<p id="emailError" class="error"></p>

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('myForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            if (validateForm()) {
                form.submit();
            }
        });

        function validateForm() {
            var usernameInput = document.getElementById('username');
            var passwordInput = document.getElementById('password');
            var roleInput = document.getElementById('role');
            var emailInput = document.getElementById('email');

            var usernameValue = usernameInput.value.trim();
            var passwordValue = passwordInput.value.trim();
            var roleValue = roleInput.value;
            var emailValue = emailInput.value.trim();

            if (usernameValue === '') {
                document.getElementById('usernameError').textContent = 'Please enter a username.';
                return false;
            } else {
                document.getElementById('usernameError').textContent = '';
            }

            if (passwordValue === '') {
                document.getElementById('passwordError').textContent = 'Please enter a password.';
                return false;
            } else {
                document.getElementById('passwordError').textContent = '';
            }

            if (roleValue === '') {
                document.getElementById('roleError').textContent = 'Please select a role.';
                return false;
            } else {
                document.getElementById('roleError').textContent = '';
            }

            if (emailValue === '') {
                document.getElementById('emailError').textContent = 'Please enter an email address.';
                return false;
            } else {
                document.getElementById('emailError').textContent = '';
            }

            return true;
        }
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
