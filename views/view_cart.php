<?php
session_start();
require_once('../controllers/CustomerController.php');

if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'customer' ) {
	header('Location: login.php');
	exit();
}

$customer = new CustomerController();

$products = [];
// $products = $customer->getAllAvailableProducts();
$products = $customer->findCartProducts($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Ecommerce Store</title>
    <!-- CSS stylesheets -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header section -->
    <header>
        <h1>Great Buy</h1>
        <!-- Navigation menu -->
        <nav>
            <ul>
                <li><a href="home_page.php">Home</a></li>
                <li><a href="home_page.php">Products</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main content section -->
    <main>
        <!-- Product filter and sorting section -->
		<section id="filter-sort">
			<h2>Filter and Sort</h2>
			<!-- Price range filter -->
			<form id="price-filter-form">
				<label for="min-price">Min Price:</label>
				<input type="number" id="min-price" name="min-price" min="0"><br>
				<label for="max-price">Max Price:</label>
				<input type="number" id="max-price" name="max-price" min="0">
				<button type="submit">Filter</button>
			</form>
		</section>
        <!-- Product search section -->
		<section id="product-search">
			<h2>Product Search</h2>
			<!-- Search form -->
			<form id="search-form" action="#" method="GET">
				<input type="text" id="search-input" name="search" placeholder="Search products...">
				<button type="submit">Search</button>
			</form>
		</section>

        <section id="shopping-cart" class="section-header">
            <h2><a href="view_cart.php">Shopping Cart</a></h2>
        </section>

        <section id="product-feedback" class="section-header">
            <h2><a href="view_review.php">Product Reviews</a></h2>
        </section>

        <!-- Previous orders section -->
        <section id="previous-orders" class="section-header">
            <h2><a href="view_previous_orders.php">Previous Orders</a></h2>
        </section>

        <section id="loyalty-programs" class="section-header">
            <h2><a href="view_loyalty.php">Loyalty Points</a></h2>
        </section>

		<h2 id="actual-header">Shopping Cart</h2>

		<table>
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Product Name</th>
					<th>Order Date</th>
					<th>Status</th>
					<th>Total Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($products as $product): ?>
					<tr>
						<td><?= $product['order_id'] ?></td>
						<td><?= $product['product_name'] ?></td>
						<td><?= $product['order_date'] ?></td>
						<td><?= $product['status'] ?></td>
						<td><?= $product['total_amount'] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
    </main>

    <footer>
        <p>&copy; 2024 Great Buy. All rights reserved.</p>
    </footer>

</body>

<style>

/* Reset default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.title {
	margin-left: auto;
	margin-right: auto;
}
/* Body styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
}

/* Header styles */
header {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
}

header h1 {
    margin-bottom: 10px;
}

nav ul {
    list-style-type: none;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
}

nav ul li a:hover {
    text-decoration: underline;
}

/* Main content styles */
main {
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

/* Section styles */
section {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
    width: calc(33.333% - 40px);
}

section h2 {
    margin-bottom: 10px;
}

/* Product search form styles */
#product-search form {
    display: flex;
}

#product-search input[type="text"] {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px 0 0 5px;
}

#product-search button {
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
}

#product-search button:hover {
    background-color: #555;
}

/* Footer styles */
footer {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
}

/* Product card styles */
.product {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
    width: calc(33.333% - 40px); /* Adjust the width as needed */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
}

.product h2 {
    margin-bottom: 10px;
}

.product p {
    margin-bottom: 15px;
}

/* Add to Cart button styles */
.product form {
    display: flex;
    align-items: center;
}

.product button {
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth transition */
}

.product button:hover {
    background-color: #555;
}

<!-- .section-header h2 { -->
<!--             background-color: #333; -->
<!--             color: #fff; -->
<!--             padding: 10px 20px; -->
<!--             margin-bottom: 20px; -->
<!--         } -->

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f2f2f2;
        }
a {
    color: inherit; /* Use the color of the parent element (white) */
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
#actual-header {
	text-align: center;
	padding: 20px;
}
</style>
</html>
