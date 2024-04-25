<?php
class RatingModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }
	
	public function getDelivsRatings() {
		$query = "select performances.rating as rating,
				  users.username from performances
				  join users on users.user_id = performances.user_id
				  where users.role = 'delivery Man'";
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		$rows = [];
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		return $rows;
	
	}

	public function getEmployeeRatings() {
		$query = "select performances.rating as rating,
				  users.username from performances
				  join users on users.user_id = performances.user_id
				  where users.role = 'employee'";
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		$rows = [];
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		return $rows;
	}
}
?>
