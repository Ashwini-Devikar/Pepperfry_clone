<?php
session_start();
include "db_connect.php";

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

header('Content-Type: application/json');

$cartData = [];
$totalPrice = 0;
$totalItems = 0;

if (isset($_SESSION['user_id'])) {
    // Fetch from DB
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT c.product_id, c.quantity, p.name, p.price, p.image 
            FROM cart c 
            LEFT JOIN products p ON c.product_id = p.id 
            WHERE c.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $cartData[] = $row;
        $totalPrice += ($row['price'] * $row['quantity']);
        $totalItems += $row['quantity'];
    }
} else {
    // Fetch from Session
    if (isset($_SESSION['cart'])) {
        $cartData = array_values($_SESSION['cart']);
        foreach ($cartData as $item) {
            $totalPrice += ($item['price'] * $item['quantity']);
            $totalItems += $item['quantity'];
        }
    }
}

echo json_encode([
    'items' => $cartData,
    'totalPrice' => $totalPrice,
    'count' => $totalItems
]);
?>