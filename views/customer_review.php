<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'delivery Man' ) {
	header('Location: login.php');
	exit();
}

$reviews = isset($_SESSION['reviews']) ? $_SESSION['reviews'] : null;

$avg = isset($_SESSION['avg']) ? $_SESSION['avg'] : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Dashboard</title>
</head>
<body>
    <div class="sidebar">

        <a href="../controllers/delivery_dashboard_controller.php"><h1>Delivery Dashboard</h1></a>
		<a href="../controllers/update_user.php"><h2>Update Profile</h2></a>
        <h2>Order Details</h2>
        <ul>
			<li><a href="../controllers/pending_orders_controller.php">pending orders</a></li>
        </ul>

		<h2>Earning Tracker</h2>
        <ul>
            <li><a href="../controllers/updated_payroll_controller.php">updated payroll</a></li>
        </ul>
		<h2>Delivery Management</h2>
        <ul>
            <li><a href="../controllers/report_delivery_controller.php">report delivery</a></li>
        </ul>
        <a href="../controllers/customer_review_controller.php"><h2>Customer Reviews</h2></a>
        <a href="../controllers/promotional_notify_controller.php"><h2>Promotional Notifications</h2></a>
        <a href="../controllers/logout.php"><h2>Logout</h2></a>
    </div>
    <div class="container">
    <h1 id="profile">Customer Reviews</h1>
<table>
    <thead>
        <tr>
            <th>Review ID</th>
            <th>Delivery Man ID</th>
            <th>Comment</th>
            <th>Rating</th>
        </tr>
    </thead>
    <tbody>
		<?php foreach ($reviews as $review): ?>
			<tr>
				<td><?= $review['review_id'] ?></td>
				<td><?= $review['delivery_man_id'] ?></td>
				<td><?= $review['comment'] ?></td>
				<td><?= $review['rating'] ?></td>
			</tr>
		<?php endforeach; ?>
        <tr class="average-row">
            <td colspan="3" style="text-align: right;">Average Rating:</td>
			<td><?= $avg ?></td>
        </tr>
    </tbody>
</table>
    </div>
</body>
<style>
	body {
		font-family: Arial, sans-serif;
		background-color: #f4f4f4;
		margin: 0;
		padding: 0;
		display: flex;
	}
	.sidebar {
		width: 250px;
		background-color: #966977;
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
table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 2px solid #ddd;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .average-row td {
            background-color: #f2f2f2;
            font-weight: bold;
        }
</style>
</html>
