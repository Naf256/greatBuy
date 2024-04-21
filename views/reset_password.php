<?php
require_once('../controllers/AuthenticationController.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $newPassword = $_POST['new_password'];
    $username = $_SESSION['username'];

	$authController = new AuthenticationController();

	$authController->changePassword($username, $newPassword);
    // Verify token and update password in the database
    // Redirect to login page
} else {
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <form action="reset_password.php" method="post">
        <label for="username">Username:</label>
		<input type="text" name="username" id="username" value="<?php echo $username; ?>"<br>
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password" required><br>
        <button type="submit">Reset Password</button>
    </form>
</body>
<style>
/* Style for the form container */
h1 {
  margin-top: 100px;
  margin-left: 40%;
}

#error-message {
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
input[type="email"],
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
