<?php
session_start();

$errorMessage = isset($_SESSION['error_register']) ? $_SESSION['error_register'] : null;

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
  <form id="registrationForm" action="../controllers/register_controller.php" method="post" novalidate>
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" ><br>

    <label for="username">Username:</label>
    <input type="text" name="username" id="username" ><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" ><br>

    <label for="role">Role:</label>
    <select name="role" id="role" >
      <option value="">Select Role</option>
      <option value="customer">Customer</option>
      <option value="employee">Employee</option>
      <option value="delivery Man">Delivery Man</option>
    </select><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" ><br>

    <label for="phone_number">Phone Number:</label>
    <input type="tel" name="phone_number" id="phone_number" ><br>

    <label for="address">Address:</label>
    <input type="text" name="address" id="address" ><br>

    <button type="submit">Register</button>
  </form>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var form = document.getElementById('registrationForm');
  form.addEventListener('submit', function(event) {
    event.preventDefault();
    var name = document.getElementById('name');
    var username = document.getElementById('username');
    var password = document.getElementById('password');
    var role = document.getElementById('role');
    var email = document.getElementById('email');
    var phone_number = document.getElementById('phone_number');
    var address = document.getElementById('address');

    var isValid = true;

    var errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(function(errorMessage) {
      errorMessage.textContent = '';
    });

    if (name.value.trim() === '') {
      showError(name, 'Name is required');
      isValid = false;
	  return;
    }

    if (username.value.trim() === '') {
      showError(username, 'Username is required');
      isValid = false;
	  return;
    }

    // Password must contain at least one lowercase letter, one uppercase letter, one special character, and be at least 8 characters long
	var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/;
    // Email validation regex
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

	if (!passwordRegex.test(password.value)) {
      showError(password, 'Password must contain at least one lowercase letter, one uppercase letter, one special character, and be at least 8 characters long');
      isValid = false;
	  return;
    }

    if (role.value === '') {
      showError(role, 'Please select a role');
      isValid = false;
	  return;
    }

	if (!emailRegex.test(email.value)) {
      showError(email, 'Try with a valid email');
      isValid = false;
	  return;
    }

    if (email.value.trim() === '') {
      showError(email, 'Email is required');
      isValid = false;
	  return;
    }

    if (phone_number.value.trim() === '') {
      showError(phone_number, 'Phone Number is required');
      isValid = false;
	  return;
    }

    if (address.value.trim() === '') {
      showError(address, 'Address is required');
      isValid = false;
	  return;
    }

    if (isValid) {
      form.submit();
    }
  });

	function showError(input, message) {
		var parent = input.parentElement;
		var errorMessage = parent.querySelector('.error-message');

		if (!errorMessage) {
			errorMessage = document.createElement('span');
			errorMessage.className = 'error-message';
			parent.appendChild(errorMessage);
		}

		errorMessage.textContent = message;
	}
});

</script>
<style>
body {
  font-family: Arial, sans-serif;
}

h1 {
  text-align: center;
  margin-top: 20px;
}

form {
  width: 300px;
  margin: 0 auto;
}

label {
  display: block;
  margin-bottom: 5px;
}

input,
select,
button {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

.error-message {
  color: red;
  font-size: 12px;
}
</style>
</html>
