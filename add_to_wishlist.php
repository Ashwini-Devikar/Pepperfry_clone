<?php
session_start();
require 'db_connect.php';

$product_id = intval($_POST['product_id']);
$name = $_POST['name'] ?? 'Unknown';
$price = $_POST['price'] ?? 0;
$image = $_POST['image'] ?? '';

if (!isset($_SESSION['user_id'])) {
    // Guest User: Use Session
    if (!isset($_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = [];
    }

    if (isset($_SESSION['wishlist'][$product_id])) {
        unset($_SESSION['wishlist'][$product_id]);
        echo json_encode(['status' => 'removed', 'message' => 'Removed from Wishlist']);
    } else {
        $_SESSION['wishlist'][$product_id] = ['product_id' => $product_id, 'name' => $name, 'price' => $price, 'image' => $image];
        echo json_encode(['status' => 'added', 'message' => 'Added to Wishlist']);
    }
    exit;
}

// Logged In User: Use Database
$user_id = $_SESSION['user_id'];

// 1. Ensure Product Exists in DB (Fix for Foreign Key Constraint)
$check_prod = $conn->prepare("SELECT id FROM products WHERE id = ?");
$check_prod->bind_param("i", $product_id);
$check_prod->execute();
if ($check_prod->get_result()->num_rows == 0) {
    // Insert product if missing so wishlist insertion doesn't fail
    $ins_prod = $conn->prepare("INSERT INTO products (id, name, price, image) VALUES (?, ?, ?, ?)");
    $ins_prod->bind_param("isds", $product_id, $name, $price, $image);
    $ins_prod->execute();
}

// 2. Check if exists in wishlist
$check = $conn->prepare("SELECT id FROM wishlist WHERE user_id = ? AND product_id = ?");
$check->bind_param("ii", $user_id, $product_id);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    // Remove
    $del = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
    $del->bind_param("ii", $user_id, $product_id);
    $del->execute();
    echo json_encode(['status' => 'removed', 'message' => 'Removed from Wishlist']);
} else {
    // Add
    $ins = $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
    $ins->bind_param("ii", $user_id, $product_id);
    $ins->execute();
    echo json_encode(['status' => 'added', 'message' => 'Added to Wishlist']);
}
?>