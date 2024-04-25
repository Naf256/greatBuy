<?php
session_start();
require_once('../controllers/CustomerController.php');

if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'customer' ) {
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

        <section class="section-header">
            <h2><a href="view_review.php">Product Reviews</a></h2>
        </section>

        <section id="previous-orders" class="section-header">
            <h2><a href="view_previous_orders.php">Previous Orders</a></h2>
        </section>

        <section id="loyalty-programs" class="section-header">
            <h2><a href="view_loyalty.php">Loyalty Points</a></h2>
        </section>

		<div class="flex-container">

		<div id="product-feedback" class="section-header">
			<h2>Product Reviews & Questions</h2>

			<!-- Review form -->
			<form id="review-form">
				<!-- <h3>Write a Review</h3> -->
				<textarea id="review-text" placeholder="Write your review here..."></textarea>
				<select id="product-id">
					<!-- Populate this dropdown with product IDs -->
					<?php foreach ($products as $product): ?>
						<option value="<?= $product['product_id'] ?>"><?= $product['name'] ?></option>
					<?php endforeach; ?>
				</select>
				<label for="rating">Rating:</label>
				<input type="number" id="rating" name="rating" min="1" max="5" required>
				<button type="submit">Submit Review</button>
			</form>

			<!-- Display product reviews -->
			<div id="reviews-container">
				<!-- Reviews will be dynamically added here -->
			</div>
		</div>
		</div>

    </main>

    <!-- <footer> -->
    <!--     <p>&copy; 2024 Great Buy. All rights reserved.</p> -->
    <!-- </footer> -->

</body>

<script>

// Function to handle review form submission

document.addEventListener('DOMContentLoaded', () => {
    const productIdDropDown = document.getElementById('product-id');
	const productId = document.getElementById('product-id').value;
	
	const formData = new FormData();
	formData.append('product_id', productId);
	formData.append('action', 'get_reviews');

	fetch('../controllers/CustomerController.php', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
		console.log(data);
		data.forEach(r => {
            const reviewElement = document.createElement('div');
            reviewElement.classList.add('review');
            reviewElement.textContent = r.comment;
            document.getElementById('reviews-container').appendChild(reviewElement);
		})
	})
	
	productIdDropDown.addEventListener('change', () => {
		const productId = document.getElementById('product-id').value;
		
		const formData = new FormData();
		formData.append('product_id', productId);
		formData.append('action', 'get_reviews');

		fetch('../controllers/CustomerController.php', {
			method: 'POST',
			body: formData,
		})
		.then(response => response.json())
		.then(data => {
			console.log(data);
			document.getElementById('reviews-container').innerHTML = '';
			data.forEach(r => {
				const reviewElement = document.createElement('div');
				reviewElement.classList.add('review');
				reviewElement.textContent = r.comment;
				document.getElementById('reviews-container').appendChild(reviewElement);
			})
		})
	})
})

document.getElementById('review-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission behavior

    const reviewText = document.getElementById('review-text').value.trim();
    const productId = document.getElementById('product-id').value;
	const rating = document.getElementById('rating').value;

    if (reviewText !== '') {
        // Code to submit review to backend
        // After successful submission, add the review to the DOM
        const formData = new FormData();
        formData.append('product_id', productId);
        formData.append('comment', reviewText);
        formData.append('action', 'add_to_review');
        formData.append('rating', rating);
		formData.append('user_id', <?php echo $_SESSION['user_id'] ?>);

        fetch('../controllers/CustomerController.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            // Assuming the backend returns the newly added review data
            const reviewElement = document.createElement('div');
            reviewElement.classList.add('review');
            reviewElement.textContent = data.comment;

            document.getElementById('reviews-container').appendChild(reviewElement);

            // Clear the review text area
            document.getElementById('review-text').value = '';
            document.getElementById('rating').value = '';
        })
        .catch(error => {
            console.error('Error:', error);
        });
    } else {
        alert('Please enter a review before submitting.');
    }
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

header {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
}

section {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
    width: calc(33.333% - 40px);
}

a {
    color: inherit; /* Use the color of the parent element (white) */
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
.flex-container {
    display: flex;
    justify-content: center;
}

/* Centered content */
#product-feedback {
    width: 900px; 
	height: 400px;
	margin-top: 20px;
    margin-left: 50%; /* Center horizontally */
    text-align: center; /* Center the text inside the div */
	<!-- background-color: red; -->
}

#product-feedback h2 {
	padding: 20px;
}

#reviews-container {
   padding: 10px;
}

.review {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
	margin-top: 10px;
    margin-bottom: 10px;
	font-weight: bold;
    color: #333;
}
#review-form {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
    max-width: 500px;
    margin: 0 auto; /* Center the form horizontally */
}

#review-form textarea,
#review-form select,
#review-form input[type="number"],
#review-form button {
    display: block;
    width: 100%;
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

#review-form textarea {
    resize: vertical; /* Allow vertical resizing of textarea */
}

#review-form button {
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
}

#review-form button:hover {
    background-color: #555;
}
</style>
</html>
