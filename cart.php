<?php
session_start();
require 'db_connect.php';

$cartItems = [];
$totalPrice = 0;

if (isset($_SESSION['user_id'])) {
    // Logged in user: Fetch from DB
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("
        SELECT c.id as cart_id, c.product_id, p.name, p.price, p.image, c.quantity 
        FROM cart c 
        LEFT JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = ?
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
        $totalPrice += ($row['price'] * $row['quantity']);
    }
} else {
    // Guest user: Fetch from Session
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $cartItems = $_SESSION['cart'];
        foreach ($cartItems as $item) {
            $totalPrice += ($item['price'] * $item['quantity']);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - Pepperfry Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .cart-item-card {
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
        }
        .cart-item-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-color: #ff7043;
        }
        .qty-input {
            width: 40px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: bold;
        }
        .qty-btn {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 1px solid #ddd;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            color: #555;
        }
        .qty-btn:hover {
            background: #ff7043;
            color: white;
            border-color: #ff7043;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container position-relative">
        <a class="pf-logo" href="index.php">
            <img src="logo.svg" alt="Pepperfry" height="32">
        </a>
        <div class="ms-auto d-flex align-items-center gap-3">
             <a href="index.php" class="text-decoration-none text-dark fw-bold">Continue Shopping</a>
             <?php if (isset($_SESSION['user_id'])): ?>
             <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle fs-4 me-2"></i>
                    <span><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
             </div>
             <?php endif; ?>
        </div>
    </div>
</nav>

    <div class="container mt-5 mb-5">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <h2 class="mb-4">My Cart</h2>
        
        <div class="row">
            <?php if (!empty($cartItems)): ?>
                <div class="col-lg-8">
                    <?php foreach($cartItems as $row): ?>
                        <div class="card mb-3 shadow-sm border-0 cart-item-card rounded-3 overflow-hidden">
                            <div class="row g-0 align-items-center">
                                <div class="col-4 col-md-3">
                                    <img src="<?php echo htmlspecialchars($row['image'] ?? 'images/default.jpg'); ?>" class="img-fluid h-100 w-100" alt="Product" style="object-fit: cover; min-height: 140px;">
                                </div>
                                <div class="col-8 col-md-9">
                                    <div class="card-body py-3 pe-4">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="card-title fw-bold mb-1"><?php echo htmlspecialchars($row['name'] ?? 'Product Not Found'); ?></h6>
                                                <p class="text-muted small mb-0">Furniture</p>
                                            </div>
                                            <h5 class="text-primary fw-bold">₹<?php echo number_format($row['price'] ?? 0); ?></h5>
                                        </div>
                                        
                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                            <!-- Quantity Update Form -->
                                            <form action="update_cart_quantity.php" method="POST" class="d-flex align-items-center">
                                                <input type="hidden" name="cart_id" value="<?php echo $row['cart_id'] ?? ''; ?>">
                                                <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?? ''; ?>">
                                                
                                                <div class="d-flex align-items-center bg-light rounded-pill px-2 py-1 border">
                                                    <button type="button" class="qty-btn" onclick="updateQty(this, -1)"><i class="bi bi-dash"></i></button>
                                                    <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" class="qty-input" readonly>
                                                    <button type="button" class="qty-btn" onclick="updateQty(this, 1)"><i class="bi bi-plus"></i></button>
                                                </div>
                                            </form>

                                            <!-- Remove Item Form -->
                                            <form action="remove_cart.php" method="POST">
                                                <input type="hidden" name="cart_id" value="<?php echo $row['cart_id'] ?? ''; ?>">
                                                <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?? ''; ?>">
                                                <button type="submit" class="btn btn-link text-danger text-decoration-none p-0 small fw-bold">
                                                    <i class="bi bi-trash me-1"></i>REMOVE
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm p-4 rounded-4 sticky-top" style="top: 100px;">
                        <h5 class="card-title fw-bold mb-4">Price Details</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Price (<?php echo count($cartItems); ?> items)</span>
                            <span>₹<?php echo number_format($totalPrice); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Delivery Charges</span>
                            <span class="text-success">FREE</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="fw-bold text-dark">Total Amount</h5>
                            <h5 class="fw-bold text-primary">₹<?php echo number_format($totalPrice); ?></h5>
                        </div>
                        <a href="checkout.php" class="btn btn-warning w-100 fw-bold text-white py-2 rounded-pill shadow-sm" style="background-color: #ff7043; border: none;">PLACE ORDER</a>
                        <a href="index.php" class="btn btn-outline-secondary w-100 mt-3 rounded-pill border-0">Continue Shopping</a>
                    </div>
                </div>

            <?php else: ?>
                <div class="col-12">
                    <div class="text-center p-5 bg-white rounded-3 shadow-sm" style="margin: 0 auto; max-width: 600px;">
                        <div class="mb-4">
                            <i class="bi bi-cart-x" style="font-size: 4rem; color: #ff7043;"></i>
                        </div>
                        <h4 class="fw-bold">Your Shopping Cart is Empty</h4>
                        <p class="text-muted mb-4">You have no items in your shopping cart. <br>Let's go find something for you!</p>
                        <a href="index.php" class="btn btn-primary rounded-pill px-5 py-2" style="background-color: #ff7043; border-color: #ff7043;">Continue Shopping</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateQty(btn, change) {
            const form = btn.closest('form');
            const input = form.querySelector('input[name="quantity"]');
            let val = parseInt(input.value) + change;
            if (val < 1) val = 1;
            if (val > 10) val = 10;
            input.value = val;
            form.submit();
        }
    </script>
</body>
</html>
