<?php
require_once('../model/Product.php');
require_once('../model/User.php');

class CustomerController {
    private $productModel;
    private $userModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
    }
	
	public function getAllAvailableProducts() {
		return $this->productModel->getAllAvailableProducts();
	}
}
?>
