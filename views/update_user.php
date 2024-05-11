<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
<style>

		#error-message {
			font-size: 32px;		
			margin-left: 40%;	
		}

		#profile-header {
			font-family: Arial, sans-serif;
			display: flex; 
			justify-content: center;
			align-items: center;
			background-color: #333;
			color: #fff;
			padding: 20px;
		}

		#profile-header a,
		.header-text {
			margin: 0 20px;
			color: #fff;
			text-decoration: none;
		}
        .body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="6"><path d="M6 0l6 6H0z" fill="%23000000"/></svg>');
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: 50%;
            background-size: 12px 6px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
// Assume $userDetails is an associative array containing user information retrieved from the database
$userDetails = array(
    'username' => $_SESSION['userinfo']['username'],
    'password' => $_SESSION['userinfo']['password'],
    'role' => $_SESSION['userinfo']['role'],
    'email' => $_SESSION['userinfo']['email'],
    'name' => $_SESSION['userinfo']['name'],
    'phone_number' => $_SESSION['userinfo']['phone_number'],
    'address' => $_SESSION['userinfo']['address']
);
?>
<div id="profile-header">
    <a href="../views/index.php">Home</a>
    <div class="header-text">Update User Profile</div>
    <a href="../controllers/logout.php">Logout</a>
</div>
<div id="error-message" style="color: red;"></div>
<div class="body">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<label for="username">Username:</label><br>
	<input type="text" id="username" name="username" value="<?php echo $userDetails['username']; ?>" disabled><br>

	<label for="password">Password:</label><br>
	<input type="text" id="password" name="password" value="<?php echo $userDetails['password']; ?>"><br>

	<label for="role">Role:</label><br>
	<select id="role" name="role" disabled>
		<option value="admin" <?php if($userDetails['role'] === 'admin') echo 'selected'; ?>>Admin</option>
		<option value="employee" <?php if($userDetails['role'] === 'employee') echo 'selected'; ?>>Employee</option>
		<option value="customer" <?php if($userDetails['role'] === 'customer') echo 'selected'; ?>>Customer</option>
		<option value="delivery Man" <?php if($userDetails['role'] === 'delivery Man') echo 'selected'; ?>>Delivery Man</option>
	</select><br>

	<label for="email">Email:</label><br>
	<input type="email" id="email" name="email" value="<?php echo $userDetails['email']; ?>"><br>

	<label for="name">Name:</label><br>
	<input type="text" id="name" name="name" value="<?php echo $userDetails['name']; ?>"><br>

	<label for="phone_number">Phone Number:</label><br>
	<input type="text" id="phone_number" name="phone_number" value="<?php echo $userDetails['phone_number']; ?>"><br>

	<label for="address">Address:</label><br>
	<textarea id="address" name="address"><?php echo $userDetails['address']; ?></textarea><br>

    <input type="submit" value="Update" onclick="return validateForm()">
</form>
</div>
<script>
    function validateForm() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var email = document.getElementById('email').value;
        var name = document.getElementById('name').value;
        var phoneNumber = document.getElementById('phone_number').value;
        var address = document.getElementById('address').value;

        var errorMessage = document.getElementById('error-message');
        errorMessage.innerHTML = ''; 

        if (!username || !password || !email || !name || !phoneNumber || !address) {
            errorMessage.innerHTML = "All fields are required";
            return false; 
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errorMessage.innerHTML = "Invalid email address";
            return false; 
        }



        return true;
    }
</script>
</body>
</html>
