<?php
session_start();
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];

            // Merge guest cart with user's database cart
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                $user_id = $_SESSION['user_id'];
                foreach ($_SESSION['cart'] as $product_id => $item) {
                    $quantity = $item['quantity'];
                    
                    // Ensure product exists in DB (Fix for Foreign Key Constraint)
                    $check_prod = $conn->prepare("SELECT id FROM products WHERE id = ?");
                    $check_prod->bind_param("i", $product_id);
                    $check_prod->execute();
                    if ($check_prod->get_result()->num_rows == 0) {
                        $name = $item['name'] ?? 'Unknown';
                        $price = $item['price'] ?? 0;
                        $image = $item['image'] ?? '';
                        $category = $item['category'] ?? 'General';
                        $ins_prod = $conn->prepare("INSERT INTO products (id, name, price, image) VALUES (?, ?, ?, ?)");
                        $ins_prod->bind_param("isds", $product_id, $name, $price, $image);
                        $ins_prod->execute();
                    }

                    // Check if product exists in user's DB cart
                    $stmt_check = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
                    $stmt_check->bind_param("ii", $user_id, $product_id);
                    $stmt_check->execute();
                    $result_check = $stmt_check->get_result();

                    if ($result_check->num_rows > 0) {
                        // Product exists, update quantity
                        $cart_row = $result_check->fetch_assoc();
                        $new_quantity = $cart_row['quantity'] + $quantity;
                        $stmt_update = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
                        $stmt_update->bind_param("ii", $new_quantity, $cart_row['id']);
                        $stmt_update->execute();
                    } else {
                        // Product does not exist, insert new record
                        $stmt_insert = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
                        $stmt_insert->bind_param("iii", $user_id, $product_id, $quantity);
                        $stmt_insert->execute();
                    }
                }
                unset($_SESSION['cart']); // Clear session cart
            }

            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Incorrect Password'); window.location.href='index.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('User not registered'); window.location.href='index.php';</script>";
        exit();
    }
}
?>
