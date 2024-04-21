<?php
class ReviewModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }
	public function updateReview($feedbackId, $updatedValues) {
		$query = "update productFeedback set rating = ?, comment = ? where feedback_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("sss", $updatedValues['rating'], $updatedValues['comment'], $feedbackId);
		$stmt->execute();
	}
	public function getAllReviews() {
		$query = "select productFeedback.comment, productFeedback.rating, productFeedback.date, productFeedback.feedback_id,
				products.name as product_name, users.username from productFeedback
				JOIN products ON products.product_id = productFeedback.product_id
				JOIN users ON users.user_id = productFeedback.user_id";

		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
}
?>
