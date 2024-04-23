<?php
class DeliveryModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }
	
	public function insertNewDelivery($orderId, $userId) {
		$query = "insert into delivery (user_id, order_id) values (?, ?)";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ss", $userId, $orderId);
		$stmt->execute();
		
		$query2 = "update orders set status = 'shipped' where order_id = ?";
		$stmt2 = $this->db->prepare($query2);
		$stmt2->bind_param("s", $orderId);
		return $stmt2->execute();
	}

}
?>
