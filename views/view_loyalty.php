<?php
session_start();
require_once('../controllers/CustomerController.php');

if (!isset($_COOKIE['username']) || $_COOKIE['role'] != 'customer' ) {
	header('Location: login.php');
	exit();
}

$customer = new CustomerController();

$loyaltyInfo = $customer->findLoyaltyInfo($_SESSION['user_id']);

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
	<main>
        <div class="loyalty-info">
            <div class="username">User: <?= $_SESSION['username'] ?></div>
            <?php foreach ($loyaltyInfo as $l): ?>
                <div><strong>Loyalty points:</strong> <?= $l['loyalty_points']?></div>
                <div><strong>Discount percentage:</strong> <?= $l['discount_percentage']?>%</div>
                <div><strong>Expiration date:</strong> <?= $l['expiration_date']?></div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
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
 body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        main {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .loyalty-info {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .loyalty-info div {
            margin-bottom: 10px;
        }

        .loyalty-info div:last-child {
            margin-bottom: 0;
        }

        .loyalty-info strong {
            font-weight: bold;
        }

        .loyalty-info .username {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }

</style>
</html>