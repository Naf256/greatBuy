<?php
require_once('../model/Product.php');
require_once('../model/User.php');
require_once('../model/Order.php');

class CustomerController {
    private $productModel;
    private $userModel;
    private $orderModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();
    }
	
	public function findCartProducts($userId) {
		return $this->orderModel->getPendingOrderByUserId($userId);
	}

	public function getAllAvailableProducts() {
		return $this->productModel->getAllAvailableProducts();
	}
	
	public function findAllOrders($username) {
		$currUser = $this->userModel->getUserByUsername($username);

		$orders = $this->orderModel->getOrdersByUserId($currUser['user_id']);
			
		return $orders;
	}
	public function handleRequest() {
		if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart') { 

			if (isset($_POST['product_id']) && isset($_POST['username'])) {
				// Get the product ID and username from the POST data
				$productId = $_POST['product_id'];
				$username = $_POST['username'];
				
				$this->productModel->updateProductQuantityById($productId);
				$currUser = $this->userModel->getUserByUsername($username);
				$price = $this->productModel->getPriceById($productId);
				$this->orderModel->insertNewOrder($currUser['user_id'], $productId, "pending", $price['price']);
			}
		}
	}
}

$customer = new CustomerController();
$customer->handleRequest();
?>
