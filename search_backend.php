<?php
require 'db_connect.php';

header('Content-Type: application/json');

$query = trim($_GET['query'] ?? '');

if (empty($query)) {
    echo json_encode([]);
    exit;
}

// Validate and prepare search term
$searchTerm = "%" . $query . "%";

// Search in products table (matching keyword with stored data)
$stmt = $conn->prepare("SELECT id, name, price, image FROM products WHERE name LIKE ? LIMIT 10");
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Results are sent back to the frontend
echo json_encode($data);
?>