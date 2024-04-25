<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'admin' ) {
	header('Location: login.php');
	exit();
}

require_once('../controllers/AuthenticationController.php');
$authController = new AuthenticationController();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="sidebar">

        <h1>Admin Dashboard</h1>
        <h2>Product Management</h2>
        <ul>
            <li><a href="add_product.php">Add Product</a></li>
			<li><a href="delete_product.php">Delete Product</a></li>
            <li><a href="edit_product.php">Edit Product</a></li>
            <li><a href="view_products.php">View Products</a></li>
        </ul>

		<h2>User Management</h2>
        <ul>
            <li><a href="add_user.php">Add User</a></li>
            <li><a href="delete_user.php">Delete User</a></li>
            <li><a href="edit_user.php">Edit User</a></li>
            <li><a href="view_users.php">View Users</a></li>
        </ul>
		<h2>Work Management</h2>
        <ul>
            <li><a href="view_tasks.php">tasks</a></li>
            <li><a href="view_attendence.php">attendence</a></li>
        </ul>
		<a href="calculator.php"><h2>Calculator</h2></a>
		<a href="view_orders.php"><h2>Orders</h2></a>
		<a href="review_admin.php"><h2>Reviews</h2></a>
    </div>
    <div class="container">
		<div class="expense-calculator">
		<h2 id="profile">Expense Calculator</h2>
		<form id="expense-form">
			<label for="category1">Salary:</label>
			<input type="number" id="salary" name="salary" placeholder="Enter expense for salary"><br>

			<label for="category2">Bonus:</label>
			<input type="number" id="bonus" name="bonus" placeholder="Enter expense for bonus"><br>

			<label for="category2">Maintainance:</label>
			<input type="number" id="maintainance" name="maintainance" placeholder="Enter expense for maintainance"><br>

			<label for="category2">Tax:</label>
			<input type="number" id="tax" name="tax" placeholder="Enter expense for tax"><br>

			<button type="button" id="calculate-btn">Calculate Total Expense</button>
		</form>
		<p id="total-expense">Total Expense: $<span id="total-amount">0.00</span></p>
		</div>
    </div>
</body>
<script>
document.getElementById("calculate-btn").addEventListener("click", function() {
  // Get expense inputs for each category
  var expense1 = parseFloat(document.getElementById("salary").value) || 0;
  var expense2 = parseFloat(document.getElementById("bonus").value) || 0;
  var expense3 = parseFloat(document.getElementById("maintainance").value) || 0;
  var expense4 = parseFloat(document.getElementById("tax").value) || 0;

  // Add more variables for additional categories if needed

  // Calculate total expense
  var totalExpense = expense1 + expense2 + expense3 + expense4; // Add expenses for additional categories as needed

  // Display total expense
  document.getElementById("total-amount").textContent = totalExpense.toFixed(2);
});
</script>
<style>
	table {
		width: 100%;
		border-collapse: collapse;
	}
	th, td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}
	th {
		background-color: #f2f2f2;
	}
	body {
		font-family: Arial, sans-serif;
		background-color: #f4f4f4;
		margin: 0;
		padding: 0;
		display: flex;
	}
	.sidebar {
		width: 250px;
		background-color: #33b0ff;
		color: #fff;
		padding: 20px;
		position: fixed;
		height: 100%;
		overflow-y: auto;
	}
	.container {
		margin-top: 5%;
		margin-left: 30%;
		padding: 20px;
		<!-- background-color: red; -->
	}
	#profile {
		<!-- border-bottom: 1px solid #ddd; -->
		padding: 10px;
		padding-bottom: 20px;
		color: #181a1b;
	}
	h1 {
		text-align: center;
		color: #ffffff;
	}
	h2 {
		color: #eef4f8;
	}
	ul {
		list-style-type: none;
		padding: 0;
	}
	li {
		margin-bottom: 10px;
	}
	a {
		text-decoration: none;
		color: #fff;
		font-size: 16px;
	}
	a:hover {
		text-decoration: underline;
	}

.expense-calculator {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
}

.expense-calculator h2 {
  margin-top: 0;
}

.expense-calculator label {
  display: block;
  margin-bottom: 10px;
}

.expense-calculator input[type="number"] {
  width: 100%;
  padding: 8px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.expense-calculator button {
  background-color: #4caf50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.expense-calculator button:hover {
  background-color: #45a049;
}

#total-expense {
  font-size: 18px;
  font-weight: bold;
}
</style>
</html>
