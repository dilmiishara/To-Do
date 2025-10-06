<?php

// -------------------- CORS HEADERS --------------------
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
// --------------------------------------------------------

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/db.php";

$database = new Database();
$conn = $database->getConnection();

// Get the raw POST data (JSON from frontend)
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->title) && !empty($data->description)) {

    $query = "INSERT INTO tasks (title, description,is_completed) VALUES (:title, :description,0)";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":title", $data->title);
    $stmt->bindParam(":description", $data->description);

    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(["message" => "Task created successfully."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Unable to create task."]);
    }

} else {
    http_response_code(400);
    echo json_encode(["message" => "Incomplete data."]);
}
?>
