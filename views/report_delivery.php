<?php
session_start();
if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'delivery Man' ) {
	header('location: ../views/login.php');
	exit();
}

$delivs = $_SESSION['delivs'];

// var_dump($delivs);
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
	<h1 id="profile">Shipping Deliveries</h1>
		<table>
			<tr>
				<th>Delivery ID</th>
				<th>Product Name</th>
				<th>Status</th>
			</tr>
			<?php foreach ($delivs as $deliv): ?>	
				<tr>
					<td><?= $deliv['delivery_id'] ?></td>
					<td><?= $deliv['product_name'] ?></td>
                    <td class="editable" data-field="status">
                        <select>
                            <option value="shipped" <?= $deliv['status'] === 'shipped' ? 'selected' : '' ?>>Shipped</option>
                            <option value="delivered" <?= $deliv['status'] === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                        </select>
                    </td>
				</tr>
			<?php endforeach; ?>
		</table>
    </div>
</body>
<script>
	document.addEventListener('DOMContentLoaded', (e) => {
		let selectElements = document.querySelectorAll('td.editable select');
		selectElements.forEach(selectElement => {
			selectElement.addEventListener('change', () => {
				let status = selectElement.value;
				// console.log(status);
				// return;
				let deliveryId = selectElement.closest('tr').querySelector('td:first-child').textContent;

				let formData = new FormData();
				formData.append('delivery_id', deliveryId);
				formData.append('status', status);

				fetch('../controllers/report_delivery_controller.php', {
					method: 'POST',
					body: formData	
				})
				.then(response => {
					if (response.ok) {
						console.log('status changed hopefully');
					}
				})
				.catch(() => console.log('something went wrong in the server'))
			});
		});
	});
</script>
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
	max-width: 800px;
	margin: 5% auto;
	padding: 20px;
	background-color: #f9f9f9;
	border: 1px solid #ddd;
	border-radius: 5px;
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

#profile {
	margin-top: 0;
}

table {
	width: 100%;
	border-collapse: collapse;
}

th, td {
	padding: 10px;
	border-bottom: 1px solid #ddd;
	text-align: left;
}

th {
	background-color: #f2f2f2;
	font-weight: bold;
}
</style>
</html>
