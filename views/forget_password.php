<?php
session_start();

$errorMessage = isset($_SESSION['error_email']) ? $_SESSION['error_email'] : null;


?>
<!DOCTYPE html>
<html>
<head>
    <title>Forget Password</title>
</head>
<body>
    <h1>Forget Password</h1>
	<?php if (isset($errorMessage)): ?>
		<p class="error-message" style="color: red;"><?php echo $errorMessage; ?></p>
	<?php endif; ?>
	<form id="passwordResetForm" action="../controllers/forget_password_controller.php" method="post" novalidate>
		<label for="email">Email:</label>
		<input type="email" name="email" id="email"><br>
		<span id="emailError" style="color: red;"></span><br>
		<button type="submit">Reset Password</button>
	</form>
</body>
<script>
 document.addEventListener('DOMContentLoaded', function() {
      var form = document.getElementById('passwordResetForm');
      form.addEventListener('submit', function(event) {
		event.preventDefault();
        var emailInput = document.getElementById('email');
        var emailError = document.getElementById('emailError');
        var emailValue = emailInput.value.trim();

        // Reset previous error messages
        emailError.textContent = '';

        // Check if email is empty
        if (emailValue === '') {
          event.preventDefault(); // Prevent form submission
          emailError.textContent = 'Email is required';
          return;
        }

		event.target.submit();
      });
    });
</script>
<style>
body {
	font-family: Arial, sans-serif;
	background-color: #f4f4f4;
}

form {
	max-width: 300px;
	margin: 20px auto;
	padding: 20px;
	background-color: #fff;
	border-radius: 5px;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
	display: block;
	margin-bottom: 5px;
}

input[type="email"] {
	width: 100%;
	padding: 10px;
	margin-bottom: 10px;
	border: 1px solid #ccc;
	border-radius: 3px;
	box-sizing: border-box;
}

button[type="submit"] {
	background-color: #007bff;
	color: #fff;
	border: none;
	padding: 10px 20px;
	border-radius: 3px;
	cursor: pointer;
	transition: background-color 0.3s;
}

button[type="submit"]:hover {
	background-color: #0056b3;
}

.error-message {
	color: red;
	font-size: 20px;
	text-align: center;
}

h1 {
  text-align: center;
}
</style>
</html>
