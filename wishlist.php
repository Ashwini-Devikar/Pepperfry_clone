<?php
session_start();
require 'db_connect.php';

$wishlistItems = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Fetch wishlist items with product details from DB
    $stmt = $conn->prepare("
        SELECT w.id as wishlist_id, p.id as product_id, p.name, p.price, p.image 
        FROM wishlist w 
        JOIN products p ON w.product_id = p.id 
        WHERE w.user_id = ?
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $wishlistItems[] = $row;
    }
} else {
    // Fetch from Session for Guest
    if (isset($_SESSION['wishlist'])) {
        $wishlistItems = $_SESSION['wishlist'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist - Pepperfry Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .wishlist-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .wishlist-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .remove-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 2;
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            color: #ff7043;
        }
        .remove-btn:hover {
            background: #fff;
            color: #dc3545;
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<!-- Navbar (Simplified) -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container position-relative">
        <a class="pf-logo" href="index.php">
            <img src="logo.svg" alt="Pepperfry" height="32">
        </a>
        <div class="ms-auto d-flex align-items-center gap-3">
             <a href="index.php" class="text-decoration-none text-dark fw-bold">Continue Shopping</a>
             <a href="cart.php" class="text-decoration-none text-dark position-relative">
                <i class="bi bi-cart nav-icon" style="font-size: 1.5rem;"></i>
                <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem; display: none;">
                  0
                </span>
             </a>
             <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle fs-4 me-2"></i>
                    <span><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
             </div>
        </div>
    </div>
</nav>

<div class="container mb-5">
    <h3 class="fw-bold mb-4">My Wishlist <span class="text-muted fs-6">(<?php echo count($wishlistItems); ?> items)</span></h3>
    
    <?php if (!empty($wishlistItems)): ?>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach($wishlistItems as $row): ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm wishlist-card rounded-3 overflow-hidden">
                    <div class="position-relative">
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>" style="height: 250px; object-fit: cover;">
                        
                        <!-- Unlike (Remove) Form -->
                        <form action="remove_wishlist.php" method="POST" class="d-inline">
                            <input type="hidden" name="wishlist_id" value="<?php echo $row['wishlist_id'] ?? ''; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                            <button type="submit" class="remove-btn shadow-sm" title="Remove from Wishlist">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body d-flex flex-column p-3">
                        <h6 class="card-title text-truncate mb-1" title="<?php echo htmlspecialchars($row['name']); ?>">
                            <?php echo htmlspecialchars($row['name']); ?>
                        </h6>
                        <p class="card-text fw-bold fs-5 mb-3" style="color: #ff6a2d;">₹<?php echo number_format($row['price']); ?></p>
                        
                        <!-- Move to Cart Form -->
                        <form action="move_to_cart.php" method="POST" class="mt-auto">
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                            <input type="hidden" name="wishlist_id" value="<?php echo $row['wishlist_id'] ?? ''; ?>">
                            <button type="submit" class="btn btn-outline-orange w-100 rounded-pill fw-bold btn-sm">
                                MOVE TO CART
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="text-center p-5 bg-white rounded-3 shadow-sm">
                    <div class="mb-4">
                        <i class="bi bi-heart" style="font-size: 4rem; color: #ff7043;"></i>
                    </div>
                    <h4 class="fw-bold">Your Wishlist is Empty</h4>
                    <p class="text-muted mb-4">Looks like you haven’t added anything to your wishlist yet. <br>Start exploring and save your favorite items!</p>
                    <a href="index.php" class="btn btn-primary rounded-pill px-5 py-2" style="background-color: #ff7043; border-color: #ff7043;">Start Shopping</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Toast for Cart notifications -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
  <div id="cartToast" class="toast align-items-center text-white bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        <i class="bi bi-check-circle-fill text-success me-2"></i>
        Item added to your cart successfully!
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
