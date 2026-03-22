<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
    $quantity = intval($_POST['quantity']);
    if ($quantity < 1) $quantity = 1; // Ensure minimum 1
    if ($quantity > 10) $quantity = 10; // Optional max limit

    if (isset($_SESSION['user_id'])) {
        // Logged in user: Update DB
        if (isset($_POST['cart_id']) && !empty($_POST['cart_id'])) {
            $cart_id = intval($_POST['cart_id']);
            $user_id = $_SESSION['user_id'];
            
            $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?");
            $stmt->bind_param("iii", $quantity, $cart_id, $user_id);
            $stmt->execute();
        }
    } else {
        // Guest user: Update Session
        if (isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] = $quantity;
            }
        }
    }
}

header("Location: cart.php");
exit();
?>
