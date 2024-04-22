<?php
class AttendanceModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }

	public function changeStatusById($attendanceId, $status) {
		$query = "update attendance set status = ? where attendance_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ss", $status, $attendanceId);
        $stmt->execute();
	}

	public function getAttendanceForAdmin() {
		$query = "select a.attendance_id, u.username,
				a.status, a.date from attendance a
				join users u on u.user_id = a.user_id";
	
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
