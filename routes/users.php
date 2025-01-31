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

require_once '../models/User.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retorna todos os usuários
    echo json_encode($user->getAll());
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados da requisição POST
    $data = json_decode(file_get_contents("php://input"));

    if ($user->create($data->name, $data->email, $data->password)) {
        echo json_encode(["message" => "User created successfully"]);
    } else {
        echo json_encode(["message" => "Error creating user"]);
    }
} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>
