<?php
require_once('../controllers/AuthenticationController.php');
session_start();

$errorMessage = isset($_SESSION['error_email']) ? $_SESSION['error_email'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $email = $_POST['email'];

	$authController = new AuthenticationController();

	$authController->emailExists($email);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Forget Password</title>
</head>
<body>
    <h1>Forget Password</h1>
	<?php if (isset($errorMessage)): ?>
		<p id="error-message" style="color: red;"><?php echo $errorMessage; ?></p>
	<?php endif; ?>
    <form action="forget_password.php" method="post" novalidate>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
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
