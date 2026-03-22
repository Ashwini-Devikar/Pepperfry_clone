<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
        // Logged in user: Remove from DB
        if (isset($_POST['cart_id']) && !empty($_POST['cart_id'])) {
            $cart_id = intval($_POST['cart_id']);
            $user_id = $_SESSION['user_id'];
            
            $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
            $stmt->bind_param("ii", $cart_id, $user_id);
            $stmt->execute();
        }
    } else {
        // Guest user: Remove from Session
        if (isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
            if (isset($_SESSION['cart'][$product_id])) {
                unset($_SESSION['cart'][$product_id]);
            }
        }
    }
    $_SESSION['message'] = "Item removed from cart.";
}

header("Location: cart.php");
exit();
?>
