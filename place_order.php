<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // In a real application, you would save the order details (address, payment info) 
    // to an 'orders' table here before clearing the cart.

    // Clear Cart Logic
    if (isset($_SESSION['user_id'])) {
        // For logged-in users: Remove items from database
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    } else {
        // For guest users: Remove items from session
        unset($_SESSION['cart']);
    }

    // Redirect to the stylish success page
    header("Location: order_success.php");
    exit();
} else {
    // If accessed directly without submitting the form, go back to home
    header("Location: index.php");
    exit();
}
?>