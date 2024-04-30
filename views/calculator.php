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

        <a href="../controllers/admin_dashboard_controller.php"><h1>Admin Dashboard</h1><a/>
        <h2>Product Management</h2>
        <ul>
            <li><a href="add_product.php">Add Product</a></li>
			<li><a href="../controllers/delete_product_controller.php">Delete Product</a></li>
            <li><a href="../controllers/edit_product_controller.php">Edit Product</a></li>
            <li><a href="../controllers/view_products_controller.php">View Products</a></li>
        </ul>

		<h2>User Management</h2>
        <ul>
            <li><a href="add_user.php">Add User</a></li>
            <li><a href="../controllers/delete_user_controller.php">Delete User</a></li>
            <li><a href="../controllers/edit_user_controller.php">Edit User</a></li>
            <li><a href="../controllers/view_users_controller.php">View Users</a></li>
        </ul>
		<h2>Work Management</h2>
        <ul>
            <li><a href="../controllers/view_tasks_controller.php">tasks</a></li>
            <li><a href="../controllers/view_attendence_controller.php">attendance</a></li>
        </ul>
		<a href="calculator.php"><h2>Calculator</h2></a>
		<a href="../controllers/view_orders_controller.php"><h2>Orders</h2></a>
		<a href="../controllers/review_admin_controller.php"><h2>Reviews</h2></a>
		<a href="../controllers/logout.php"><h2>Logout</h2></a>
    </div>
    <div class="container">
		<div class="expense-calculator">
		<h2 id="profile">Expense Calculator</h2>
		<form id="expense-form" novalidate>
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
  var expense1 = parseFloat(document.getElementById("salary").value) || 0;
  var expense2 = parseFloat(document.getElementById("bonus").value) || 0;
  var expense3 = parseFloat(document.getElementById("maintainance").value) || 0;
  var expense4 = parseFloat(document.getElementById("tax").value) || 0;

  var totalExpense = expense1 + expense2 + expense3 + expense4;

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
