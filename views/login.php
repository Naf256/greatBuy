<?php
require_once('../controllers/AuthenticationController.php');
session_start();

$errorMessage = isset($_SESSION['error_login']) ? $_SESSION['error_login'] : null;
// echo "errorMessage: " . $errorMessage;
// unset($_SESSION['error_login']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
    $password = $_POST['password'];
     
    $authController = new AuthenticationController();
    $authController->login($username, $password);
}

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
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>
    <button type="submit">Login</button> or <a href="register.php">Register</a> / <a href="forget_password.php">Forgot password</a>
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
