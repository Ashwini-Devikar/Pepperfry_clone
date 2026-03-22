<?php
session_start();
include "db_connect.php";

header('Content-Type: application/json');

$wishlistData = [];
$count = 0;

if (isset($_SESSION['user_id'])) {
    // Logged in: Fetch from DB
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT p.id, p.name, p.price, p.image 
            FROM wishlist w 
            JOIN products p ON w.product_id = p.id 
            WHERE w.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $wishlistData[] = $row;
    }
    $count = count($wishlistData);
} else {
    // Guest: Fetch from Session
    if (isset($_SESSION['wishlist'])) {
        $wishlistData = array_values($_SESSION['wishlist']);
        $count = count($wishlistData);
    }
}

echo json_encode(['items' => $wishlistData, 'count' => $count]);
?>