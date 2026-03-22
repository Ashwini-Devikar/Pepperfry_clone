<?php
session_start();
require 'db_connect.php';

if (isset($_SESSION['user_id'])) {
    if (isset($_POST['wishlist_id'])) {
        $user_id = $_SESSION['user_id'];
        $wishlist_id = intval($_POST['wishlist_id']);

        $stmt = $conn->prepare("DELETE FROM wishlist WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $wishlist_id, $user_id);
        $stmt->execute();
    }
} else {
    // Guest User
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        if (isset($_SESSION['wishlist'][$product_id])) {
            unset($_SESSION['wishlist'][$product_id]);
        }
    }
}

header("Location: wishlist.php");
exit();
?>
