<?php
session_start();
require 'db_connect.php';

header('Content-Type: application/json');

$wishlist_ids = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT product_id FROM wishlist WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $wishlist_ids[] = $row['product_id'];
    }
} else {
    if (isset($_SESSION['wishlist'])) {
        $wishlist_ids = array_keys($_SESSION['wishlist']);
    }
}

echo json_encode($wishlist_ids);
?>