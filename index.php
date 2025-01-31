<?php
echo json_encode([
    "message" => "Welcome to the API",
    "routes" => [
        "/routes/users.php" => "Manage users",
        "/routes/tasks.php" => "Manage tasks"
    ]
]);
?>
