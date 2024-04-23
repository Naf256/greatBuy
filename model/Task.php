<?php
class TaskModel {
	private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }
	
	public function insertNewTask($description, $assigned_to) {
		$query = "insert into tasks (task_description, assigned_to) values (?, ?)";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ss", $description, $assigned_to);
        return $stmt->execute();
	}

	public function changeStatusById($taskId, $status) {
		$query = "update tasks set status = ? where task_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ss", $status, $taskId);
        $stmt->execute();
	}

	public function getTasksForAdmin() {
		$query = "select t.task_id, t.task_description, 
				 t.due_date, t.status, u.username, u.role
				 from tasks t
				 join users u on t.assigned_to = u.user_id";

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
