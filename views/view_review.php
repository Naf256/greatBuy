<?php
session_start();

$products = $_SESSION['products'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Ecommerce Store</title>

</head>
<body>

    <header>
        <h1>Great Buy</h1>
        <nav>
            <ul>
                <li><a href="../controllers/home_page_controller.php">Home</a></li>
                <li><a href="../controllers/update_user.php">Update Profile</a></li>
                <li><a href="#">About</a></li>
                <li><a href="../controllers/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
		<section id="filter-sort">
			<h2>Filter and Sort</h2>
			<form id="price-filter-form">
				<label for="min-price">Min Price:</label>
				<input type="number" id="min-price" name="min-price" min="0"><br>
				<label for="max-price">Max Price:</label>
				<input type="number" id="max-price" name="max-price" min="0">
				<button type="submit">Filter</button>
			</form>
		</section>
		<section id="product-search">
			<h2>Product Search</h2>
			<form id="search-form" action="#" method="GET">
				<input type="text" id="search-input" name="search" placeholder="Search products...">
				<button type="submit">Search</button>
			</form>
		</section>

        <section id="shopping-cart" class="section-header">
            <h2><a href="../controllers/view_cart_controller.php">Shopping Cart</a></h2>
        </section>

        <section id="productFeedback" class="section-header">
            <h2><a href="../controllers/view_review_controller.php">Product Reviews</a></h2>
        </section>

        <section id="previous-orders" class="section-header">
            <h2><a href="../controllers/view_previous_orders_controller.php">Previous Orders</a></h2>
        </section>

        <section id="loyalty-programs" class="section-header">
            <h2><a href="../controllers/view_loyalty_controller.php">Loyalty Points</a></h2>
        </section>

		<div class="flex-container">

		<div id="product-feedback" class="section-header">
			<h2>Product Reviews & Questions</h2>

			<div id="error"></div>
			<form id="review-form" novalidate>
				<textarea id="review-text" placeholder="Write your review here..."></textarea>
				<select id="product-id">
					<?php foreach ($products as $product): ?>
						<option value="<?= $product['product_id'] ?>"><?= $product['name'] ?></option>
					<?php endforeach; ?>
				</select>
				<label for="rating">Rating:</label>
				<select id="rating" name="rating">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
				<button type="submit">Submit Review</button>

			</form>
			<div id="reviews-container">
			</div>
		</div>
		</div>

    </main>
</body>

<script>


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
		// console.log(data);
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
    event.preventDefault(); 

    const reviewText = document.getElementById('review-text').value.trim();
    const productId = document.getElementById('product-id').value;
	const rating = document.getElementById('rating').value;

    if (reviewText !== '') {

		removeErrorMessage();
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

            const reviewElement = document.createElement('div');
            reviewElement.classList.add('review');
            reviewElement.textContent = data.comment;

            document.getElementById('reviews-container').appendChild(reviewElement);


            document.getElementById('review-text').value = '';
            document.getElementById('rating').value = '';
        })
        .catch(error => {
            console.error('Error:', error);
        });
    } else {
		displayErrorMessage();
    }
});

function removeErrorMessage() {
	document.getElementById('error').textContent = '';
}

function displayErrorMessage() {
	document.getElementById('error').textContent = 'review message is missing';
}


</script>
<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
}

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

main {
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

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

footer {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
}

.product {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
    width: calc(33.333% - 40px); 
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
}

.product h2 {
    margin-bottom: 10px;
}

.product p {
    margin-bottom: 15px;
}

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
    transition: background-color 0.3s ease; 
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
    color: inherit; 
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
.flex-container {
    display: flex;
    justify-content: center;
}

#product-feedback {
    width: 900px; 
	height: 400px;
	margin-top: 20px;
    margin-left: 50%; 
    text-align: center;
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
    margin: 0 auto; 
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
    resize: vertical; 
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
#error {
	color: red;
}
</style>
</html>
