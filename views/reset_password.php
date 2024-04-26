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
	<form id="resetPasswordForm" action="reset_password.php" method="post" novalidate>
		<label for="username">Username:</label>
		<input type="text" name="username" id="username" value="<?php echo $username; ?>"><br>
		<span id="usernameError" style="color: red;"></span><br>
		<label for="new_password">New Password:</label>
		<input type="password" name="new_password" id="new_password"><br>
		<span id="passwordError" style="color: red;"></span><br>
		<button type="submit">Reset Password</button>
	</form>
</body>
<script>
 document.addEventListener('DOMContentLoaded', function() {
      var form = document.getElementById('resetPasswordForm');
      form.addEventListener('submit', function(event) {
        var newPasswordInput = document.getElementById('new_password');
        var usernameInput = document.getElementById('username');

        var usernameError = document.getElementById('usernameError');
        var passwordError = document.getElementById('passwordError');

        var newPasswordValue = newPasswordInput.value.trim();
        var usernameValue = usernameInput.value.trim();

        // Reset previous error message
        passwordError.textContent = '';
        usernameError.textContent = '';

        if (usernameValue === '') {
          event.preventDefault(); // Prevent form submission
          usernameError.textContent = 'username is required';
          return;
        }

		// Check if new password is empty
        if (newPasswordValue === '') {
          event.preventDefault(); // Prevent form submission
          passwordError.textContent = 'New password is required';
          return;
        }
      });
    });
</script>
<style>
body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    #resetPasswordForm {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    button[type="submit"] {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }

    .error-message {
      color: red;
      font-size: 12px;
    }
	h1 {
		text-align: center;
	}
</style>
</html>
