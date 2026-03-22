<?php
session_start();
include "db_connect.php";

$product_id = intval($_POST['product_id']);
$price = floatval($_POST['price']);
$quantity = intval($_POST['quantity']);
$name = isset($_POST['name']) ? $_POST['name'] : 'Unknown Product';
$image = isset($_POST['image']) ? $_POST['image'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : 'General';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id) {
    // 1. Ensure Product Exists in DB (Fix for Foreign Key Constraint)
    $check_prod = $conn->prepare("SELECT id FROM products WHERE id = ?");
    $check_prod->bind_param("i", $product_id);
    $check_prod->execute();
    if ($check_prod->get_result()->num_rows == 0) {
        // Insert product if missing so cart insertion doesn't fail
        $ins_prod = $conn->prepare("INSERT INTO products (id, name, price, image) VALUES (?, ?, ?, ?)");
        $ins_prod->bind_param("isds", $product_id, $name, $price, $image);
        $ins_prod->execute();
    }

    // --- LOGGED IN USER (DATABASE) ---
    $stmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_qty = $row['quantity'] + $quantity;
        $update_stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $update_stmt->bind_param("ii", $new_qty, $row['id']);
        $update_stmt->execute();
    } else {
        $insert_stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $insert_stmt->bind_param("iii", $user_id, $product_id, $quantity);
        $insert_stmt->execute();
    }

    // Get Updated Cart Count
    $count_stmt = $conn->prepare("SELECT SUM(quantity) as total FROM cart WHERE user_id = ?");
    $count_stmt->bind_param("i", $user_id);
    $count_stmt->execute();
    $count_res = $count_stmt->get_result();
    $count_row = $count_res->fetch_assoc();
    $total_count = $count_row['total'] ?? 0;

} else {
    // --- GUEST USER (SESSION) ---
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = [
            'product_id' => $product_id,
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'quantity' => $quantity,
            'category' => $category
        ];
    }
    
    $total_count = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_count += $item['quantity'];
    }
}

echo json_encode([
    'status' => 'success',
    'cart_count' => $total_count
]);
?>