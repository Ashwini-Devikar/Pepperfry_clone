<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);
    $wishlist_id = intval($_POST['wishlist_id']);
    $quantity = 1;

    // 1. Add to Cart (Upsert)
    // Check if product is already in cart
    $check_cart = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $check_cart->bind_param("ii", $user_id, $product_id);
    $check_cart->execute();
    $res = $check_cart->get_result();

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $new_qty = $row['quantity'] + $quantity;
        $update = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $update->bind_param("ii", $new_qty, $row['id']);
        $update->execute();
    } else {
        $insert = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $insert->bind_param("iii", $user_id, $product_id, $quantity);
        $insert->execute();
    }

    // 2. Remove from Wishlist
    $del = $conn->prepare("DELETE FROM wishlist WHERE id = ? AND user_id = ?");
    $del->bind_param("ii", $wishlist_id, $user_id);
    $del->execute();
    
    $_SESSION['message'] = "Item moved to cart successfully!";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guest User
    $product_id = intval($_POST['product_id']);
    
    if (isset($_SESSION['wishlist'][$product_id])) {
        $item = $_SESSION['wishlist'][$product_id];
        
        // Add to Cart Session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$product_id] = $item;
            $_SESSION['cart'][$product_id]['quantity'] = 1;
        }
        
        // Remove from Wishlist Session
        unset($_SESSION['wishlist'][$product_id]);
        $_SESSION['message'] = "Item moved to cart successfully!";
    }
}

header("Location: cart.php");
exit();
?>