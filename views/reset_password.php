<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
	<?php if (isset($errorMessage)): ?>
		<p class="error-message" style="color: red;"><?php echo $errorMessage; ?></p>
	<?php endif; ?>
	<form id="resetPasswordForm" action="../controllers/reset_password_controller.php" method="post" novalidate>
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

        passwordError.textContent = '';
        usernameError.textContent = '';

        if (usernameValue === '') {
          event.preventDefault(); 
          usernameError.textContent = 'username is required';
          return;
        }

        if (newPasswordValue === '') {
          event.preventDefault(); 
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
