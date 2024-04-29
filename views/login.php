<?php
session_start();

$errorMessage = isset($_SESSION['error_login']) ? $_SESSION['error_login'] : null;

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <?php if (isset($errorMessage)): ?>
    <p id="error-message" style="color: red;"><?php echo $errorMessage; ?></p>
  <?php endif; ?>
<form action="../controllers/login_controller.php" method="post" novalidate>
  <label for="username">Username:</label>
  <input type="text" name="username" id="username" value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>">
  <span id="username-error" style="color: red;"></span><br>

  <label for="password">Password:</label>
  <input type="password" name="password" id="password">
  <span id="password-error" style="color: red;"></span><br>

  <button type="submit">Login</button> or <a href="register.php">Register</a> / <a href="forget_password.php">Forgot password</a>
</form>
</body>
<script>
function validateForm(event) {
    event.preventDefault();

    var usernameInput = document.getElementById('username');
    var passwordInput = document.getElementById('password');

    var usernameValue = usernameInput.value.trim();
    var passwordValue = passwordInput.value.trim();

    var usernameError = document.getElementById('username-error');
    var passwordError = document.getElementById('password-error');

    usernameError.textContent = '';
    passwordError.textContent = '';

    if (usernameValue === '') {
      usernameError.textContent = 'Please enter a username';
      usernameInput.focus(); 
      return false; 
    }

    // Check if password is empty
    if (passwordValue === '') {
      passwordError.textContent = 'Please enter a password';
      passwordInput.focus(); 
      return false; 
    }


    event.target.submit();
  }


  document.querySelector('form').addEventListener('submit', validateForm);
</script>
<style>
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

label {
  display: block;
  margin-left: 40%;
  margin-bottom: 5px;
}

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

button[type="submit"]:hover {
  background-color: #0056b3;
}

#error-message {
  margin-left: 40%;
}
</style>
</html>
