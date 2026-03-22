<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT product_id FROM wishlist WHERE user_id = $user_id");
$ids = [];
while($row = $result->fetch_assoc()) {
    $ids[] = $row['product_id'];
}
echo json_encode($ids);
?>