<?php
session_start();
if (empty($_SESSION['username'])) {
	header('Location: login.php');
	exit();
}

require_once('../controllers/AdminController.php');

$adminController = new AdminController();

$reviews = [];

// Assuming you have a method in AdminController to fetch reviews
$result = $adminController->fetchAllReviews();

while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
		<h1 id="heading">Feedback</h1>
		<table id="feedback-table">
			<tr>
				<th>Product</th>
				<th>Username</th>
				<th>Rating</th>
				<th>Comment</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
			<?php foreach ($reviews as $review): ?>
				<tr data-feedback-id="<?= $review['feedback_id'] ?>">
					<td><?= $review['product_name'] ?></td>
					<td><?= $review['username'] ?></td>
					<td class="editable" data-field="rating"><?= $review['rating'] ?></td>
					<td class="editable" data-field="comment"><?= $review['comment'] ?></td>
					<td><?= $review['date'] ?></td>
					<td><button class="save-btn">Edit</button></td>
				</tr>
			<?php endforeach; ?>
		</table>
    </div>
	<script>
	$(document).ready(function() {
		$('#feedback-table').on('click', '.editable', function() {
			$(this).attr('contenteditable', 'true').focus();
		});

		$('#feedback-table').on('click', '.save-btn', function() {
			var $row = $(this).closest('tr');
			var feedbackId = $row.data('feedback-id');
			var updatedValues = {};
			$row.find('.editable').each(function() {
				var fieldName = $(this).data('field');
				var editedValue = $(this).text();
				updatedValues[fieldName] = editedValue;
			});

			var jsonData = JSON.stringify(updatedValues);
			$.ajax({
				url: '../controllers/AdminController.php',
				type: 'POST',
				data: {
					action: 'update_review',
					feedback_id: feedbackId,
					updated_values: jsonData
				},
				success: function(response) {
					console.log('Review updated successfully.');
				},
				error: function(xhr, status, error) {
					console.error('Error updating review:', error);
				}
			});
		});
	});
	</script>
</body>
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
		margin-left: 20%;
		padding: 20px;
		<!-- background-color: red; -->
	}
	#heading {
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

	.save-btn {
		background-color: #4caf50; /* Green */
		border: none;
		color: white;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		border-radius: 4px;
		cursor: pointer;
	}

	.save-btn:hover {
		background-color: #45a049; /* Darker green */
	}
</style>
</html>
