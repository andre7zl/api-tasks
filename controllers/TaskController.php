<?php
// controllers/TaskController.php

require_once 'config/db.php';

class TaskController {

    public function getTasks() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM tasks");
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($tasks);
    }

    public function createTask($user_id, $title, $description) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $title, $description]);
        echo json_encode(["message" => "Task created successfully"]);
    }
}
?>
