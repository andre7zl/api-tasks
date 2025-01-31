<?php
// controllers/UserController.php

require_once 'config/db.php';

class UserController {

    public function getUsers() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
    }

    public function createUser($username, $password) {
        global $pdo;
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $passwordHash]);
        echo json_encode(["message" => "User created successfully"]);
    }
}
?>
