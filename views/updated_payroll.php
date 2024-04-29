<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'delivery Man' ) {
	header('Location: login.php');
	exit();
}

$delivNum = $_SESSION['delivNum'];
$earningsPerDelivery = 30;
$totalEarnings = $delivNum * $earningsPerDelivery;

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
    </div>
	<div class="container">
        <h1 class="profile">Today's Earnings</h1>
        <div class="info">
            <p>Total Delivery:</p>
            <p><?= $delivNum ?></p>
        </div>
        <div class="info">
            <p>Earnings per Delivery:</p>
            <p>$<?= $earningsPerDelivery ?></p>
        </div>
        <div>
            <p>Total Earnings:</p>
            <p class="bonus">$<?= $totalEarnings ?></p>
        </div>
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
	.container {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .profile {
            text-align: center;
            color: #333;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .info p {
            margin: 0;
            font-size: 16px;
            color: #555;
        }
        .bonus {
            font-size: 24px;
            color: #007bff;
        }
</style>
</html>
