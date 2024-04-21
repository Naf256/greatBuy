<?php
require_once('../model/Product.php');
require_once('../model/User.php');
require_once('../model/Order.php');
require_once('../model/Review.php');

class AdminController {
    private $productModel;
	private $userModel;
	private $orderModel;
	private $reviewModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();
        $this->reviewModel = new ReviewModel();
    }

	public function fetchAllReviews() {
		return $this->reviewModel->getAllReviews();
	}

	public function deleteUserById($user_id) {
		$this->userModel->deleteUser($user_id);
		header('Location: view_users.php');
		exit();
	}

	public function fetchAllUsers() {
		$users = $this->userModel->getAllUsers();
		return $users;
	}

	public function addUser($name, $username, $password, $role, $email, $phone_number, $address) {
		$this->userModel->addUser($name, $username, $password, $role, $email, $phone_number, $address);
        header('Location: view_users.php');
		exit();
	}

	public function addProduct($name, $description, $price, $category, $stock_quantity) {
		$success = $this->productModel->insertProduct($name, $description, $price, $category, $stock_quantity);
		if ($success) {
			echo "product added successfully";
		} else {
			echo "error adding the product";
		}
	}

	public function handleRequest() {
        // Check if the action parameter is set
        if (isset($_POST['action'])) {
            // Perform corresponding action based on the action parameter
            switch ($_POST['action']) {
                case 'delete_user':
                    // Check if product_id parameter is set
                    if (isset($_POST['user_id'])) {
                        // Call the deleteProductById method to delete the product
                        $result = $this->userModel->deleteUser($_POST['user_id']);
                        // Check if deletion was successful
                        if ($result) {
                            // Return success message or handle any other logic
                            echo "User deleted successfully.";
                        } else {
                            // Return error message or handle any other logic
                            echo "Error deleting user.";
                        }
                    } else {
                        // Handle error if product_id parameter is not set
                        echo "User ID not provided.";
                    }
                    break;
                case 'delete_product':
                    // Check if product_id parameter is set
                    if (isset($_POST['product_id'])) {
                        // Call the deleteProductById method to delete the product
                        $result = $this->productModel->deleteProductById($_POST['product_id']);
                        // Check if deletion was successful
                        if ($result) {
                            // Return success message or handle any other logic
                            echo "Product deleted successfully.";
                        } else {
                            // Return error message or handle any other logic
                            echo "Error deleting product.";
                        }
                    } else {
                        // Handle error if product_id parameter is not set
                        echo "Product ID not provided.";
                    }
                    break;
				case 'update_order':
					// Check if user_id and updated_values parameters are set
					if (isset($_POST['product_id'], $_POST['updated_values'])) {
						// Decode the JSON string to get the updated values
						$productId = $_POST['product_id'];
						$updatedValues = json_decode($_POST['updated_values'], true);
						// Call the updateUser method to update the user
						$this->orderModel->updateOrder($productId, $updatedValues);
					} else {
						// Handle error if user_id or updated_values parameters are not set
						echo "User ID or updated values not provided.";
					}
					break;
				case 'update_user':
					// Check if user_id and updated_values parameters are set
					if (isset($_POST['user_id'], $_POST['updated_values'])) {
						// Decode the JSON string to get the updated values
						$userId = $_POST['user_id'];
						$updatedValues = json_decode($_POST['updated_values'], true);
						// Call the updateUser method to update the user
						$this->userModel->updateUser($userId, $updatedValues);
					} else {
						// Handle error if user_id or updated_values parameters are not set
						echo "User ID or updated values not provided.";
					}
					break;
				case 'update_review':
                // Check if product_id and updated_values parameters are set
					if (isset($_POST['feedback_id'], $_POST['updated_values'])) {
						// Decode the JSON string to get the updated values
						$feedbackId = $_POST['feedback_id'];
						$updatedValues = json_decode($_POST['updated_values'], true);
						// Call the updateProduct method to update the product
						$this->reviewModel->updateReview($feedbackId, $updatedValues);
					} else {
						// Handle error if product_id or updated_values parameters are not set
						echo "Product ID or updated values not provided.";
					}
					break;
				case 'update_product':
                // Check if product_id and updated_values parameters are set
					if (isset($_POST['product_id'], $_POST['updated_values'])) {
						// Decode the JSON string to get the updated values
						$productId = $_POST['product_id'];
						$updatedValues = json_decode($_POST['updated_values'], true);
						// Call the updateProduct method to update the product
						$this->productModel->updateProduct($productId, $updatedValues);
					} else {
						// Handle error if product_id or updated_values parameters are not set
						echo "Product ID or updated values not provided.";
					}
					break;

                // Add more cases for other actions if needed
                default:
                    // Handle unknown action
                    echo "Unknown action.";
                    break;
            }
        } else {
            // Handle error if action parameter is not set
            echo "";
        }
    }
	public function fetchAllProducts() {
		$rows = $this->productModel->getAll();
		return $rows;
	}

	public function fetchOrdersForAdmin() {
		$rows = $this->orderModel->findAllPendingOrders();
		return $rows;
	}

	public function delete_product($product_id) {
        // Call the deleteProduct method from the ProductModel
        $result = $this->productModel->deleteProductById($product_id);
        
        // Check if the deletion was successful
        if ($result) {
            // Return success message or handle any other logic
            return "Product deleted successfully.";
        } else {
            // Return error message or handle any other logic
            return "Error deleting product.";
        }
    }
}

$adminController = new AdminController();
$adminController->handleRequest();
?>
