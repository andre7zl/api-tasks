<?php
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    http_response_code(200);
    exit();
}

error_reporting(0); // Desativa mensagens de erro para evitar poluição da saída
ini_set('display_errors', 0);

header("Content-Type: application/json; charset=UTF-8");

require_once '../models/Task.php';

$task = new Task();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retorna todas as tarefas
    echo json_encode($task->getAll());
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados da requisição POST
    $data = json_decode(file_get_contents("php://input"));
    if ($task->create($data->title, $data->description, $data->task_date, $data->task_time, $data->user_id)) {
        echo json_encode(["message" => "Task created successfully"]);
    } else {
        echo json_encode(["message" => "Error creating task"]);
    }
} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>
