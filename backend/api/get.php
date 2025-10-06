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
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/db.php";

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT id, title, description, is_completed, created_at 
          FROM tasks 
          ORDER BY created_at DESC ";

$stmt = $conn->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();

if ($num > 0) {
    $tasks_arr = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $tasks_arr[] = $row;
    }
    echo json_encode($tasks_arr);
} else {
    echo json_encode([]);
}
?>
