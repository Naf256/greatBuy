<?php
require_once('../controllers/AuthenticationController.php');
session_start();

$errorMessage = isset($_SESSION['error_register']) ? $_SESSION['error_register'] : null;
// echo "errorMessage: " . $errorMessage;
// unset($_SESSION['error_login']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['name'];
	$username = $_POST['username'];
    $password = $_POST['password'];
	$role = $_POST['role'];
	$email = $_POST['email'];
	$phone_number = $_POST['phone_number'];
	$address = $_POST['address'];
     
    $authController = new AuthenticationController();
    $authController->register($name, $username, $password, $role, $email, $phone_number, $address);
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
</head>
<body>
  <h1>Register</h1>
  <?php if (isset($errorMessage)): ?>
    <p style="color: red;"><?php echo $errorMessage; ?></p>
  <?php endif; ?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" required><br>
		
		<label for="username">Username:</label>
		<input type="text" name="username" id="username" required><br>
		
		<label for="password">Password:</label>
		<input type="password" name="password" id="password" required><br>
		
		<label for="role">Role:</label>
		<select name="role" id="role" required>
			<option value="customer">Customer</option>
			<option value="employee">Employee</option>
			<option value="delivery_man">Delivery Man</option>
		</select><br>

		<label for="email">Email:</label>
		<input type="email" name="email" id="email" required><br>

		<label for="phone_number">Phone Number:</label>
		<input type="tel" name="phone_number" id="phone_number" required><br>

		<label for="address">Address:</label>
		<input type="text" name="address" id="address" required><br>
		
		<button type="submit">Register</button>
	</form>
</body>
<style>
/* Style for the form container */
h1 {
  margin-top: 100px;
  margin-left: 40%;

}
.form-container {
  width: 300px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

/* Style for form labels */
label {
  display: block;
  margin-left: 40%;
  margin-bottom: 5px;
}

/* Style for form inputs */
input[type="text"],
input[type="password"],
select {
  width: 15%;
  padding: 8px;
  margin-left: 40%;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

/* Style for submit button */
button[type="submit"] {
  width: 15%;
  padding: 10px;
  background-color: #007bff;
  margin-left: 40%;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* Hover effect for submit button */
button[type="submit"]:hover {
  background-color: #0056b3;
}
</style>
</html>
