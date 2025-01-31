<?php
require_once '../config/database.php';

class Task {
    private $conn;
    private $table_name = "tasks";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($title, $description, $task_date, $task_time, $user_id) {
        $query = "INSERT INTO " . $this->table_name . " (title, description, task_date, task_time, user_id) 
                  VALUES (:title, :description, :task_date, :task_time, :user_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":task_date", $task_date);
        $stmt->bindParam(":task_time", $task_time);
        $stmt->bindParam(":user_id", $user_id);
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
