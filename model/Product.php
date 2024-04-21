<?php
class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }

    public function getProductByName($name) {
        $query = "SELECT * FROM products WHERE name = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

	public function getAll() {
        $query = "SELECT * FROM products";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
		return $result;
	}

	public function insertProduct($name, $description, $price, $category, $stock_quantity) {
		$query = "INSERT INTO products (name, description, price, category, stock_quantity)
				 VALUES(?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $name, $description, $price, $category, $stock_quantity);
        return  $stmt->execute();
	}


	public function updateProduct($product_id, $updatedValues) {
		$query = "UPDATE products SET name = ?, description = ?, price = ?, category = ?, stock_quantity = ? WHERE product_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param('ssssss', $updatedValues['name'], $updatedValues['description'], $updatedValues['price'], $updatedValues['category'], $updatedValues['stock_quantity'], $product_id);
		$stmt->execute();
	}

	public function deleteProductById($product_id) {
		$query = "DELETE FROM products WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $product_id);
        return $stmt->execute();
	}

}
?>
