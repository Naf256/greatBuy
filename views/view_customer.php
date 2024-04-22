<?php
session_start();
require_once('../controllers/CustomerController.php');
if (empty($_SESSION['username'])) {
	header('Location: login.php');
	exit();
}

$customer = new CustomerController();

$products = $customer->getAllAvailableProducts();

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
        <h1>Welcome to My Ecommerce Store</h1>
        <!-- Navigation menu -->
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Products</a></li>
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

        <!-- Shopping cart section -->
        <section id="shopping-cart">
            <h2>Shopping Cart</h2>
            <!-- Display shopping cart contents -->
            <!-- Implement shopping cart functionality using JavaScript -->
        </section>

        <!-- Product review and question section -->
        <section id="product-feedback">
            <h2>Product Reviews & Questions</h2>
            <!-- Display product reviews and questions -->
            <!-- Implement review and question submission functionality -->
        </section>

        <!-- Previous orders section -->
        <section id="previous-orders">
            <h2>Previous Orders</h2>
            <!-- Display order history -->
            <!-- Implement order history functionality -->
        </section>

        <!-- Loyalty programs section -->
        <section id="loyalty-programs">
            <h2>Loyalty Programs</h2>
            <!-- Display loyalty program details -->
            <!-- Implement loyalty program functionality -->
        </section>
		<?php foreach ($products as $product): ?>
			<section class="product">
				<h2><?= $product['name'] ?></h2>
				<p>Description: <?= $product['description'] ?></p>
				<p class="price">Price: $<?= $product['price'] ?></p>
				<p>Category: <?= $product['category'] ?></p>
				<p>Stock Quantity: <?= $product['stock_quantity'] ?></p>
				<!-- Add to cart button -->
				<form action="#" method="post">
					<input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
					<button type="submit" name="add_to_cart">Add to Cart</button>
				</form>
			</section>
		<?php endforeach; ?>
    </main>

    <!-- Footer section -->
    <footer>
        <p>&copy; 2024 My Ecommerce Store. All rights reserved.</p>
    </footer>

    <!-- JavaScript scripts -->
    <script src="script.js"></script>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const priceFilterForm = document.getElementById('price-filter-form');
        const products = document.querySelectorAll('.product');

        priceFilterForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission behavior

            const minPrice = parseFloat(document.getElementById('min-price').value);
            const maxPrice = parseFloat(document.getElementById('max-price').value);

            products.forEach(function(product) {
                const productPrice = parseFloat(product.querySelector('.price').textContent.replace('$', ''));

                // Reset display style for all products
                product.style.display = 'block';

                // Apply filter based on price range
                if (productPrice < minPrice || productPrice > maxPrice) {
                    product.style.display = 'none'; // Hide product if it falls outside the price range
                }
            });
        });

        const searchForm = document.getElementById('search-form');
        const searchInput = document.getElementById('search-input');

        searchForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission behavior

            const searchQuery = searchInput.value.toLowerCase(); // Get search query and convert to lowercase

            products.forEach(function(product) {
                const productName = product.querySelector('h2').textContent.toLowerCase(); // Get product name and convert to lowercase

                if (productName.includes(searchQuery)) {
                    product.style.display = 'block'; // Show product if it matches the search query
                } else {
                    product.style.display = 'none'; // Hide product if it does not match the search query
                }
            });
        });
    });
</script>
<style>

/* Reset default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
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
</style>
</html>
