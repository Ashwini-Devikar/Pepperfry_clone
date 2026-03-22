<?php
session_start();
require 'db_connect.php';

$cartItems = [];
$totalPrice = 0;

if (isset($_SESSION['user_id'])) {
    // Logged in user: Fetch from DB
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("
        SELECT c.product_id, p.name, p.price, p.image, c.quantity 
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

if (empty($cartItems)) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Pepperfry Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .text-orange {
            color: #ff7043 !important;
        }

        .bg-orange {
            background-color: #ff7043 !important;
        }

        .border-orange {
            border-color: #ff7043 !important;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        /* Payment Option Cards */
        .payment-option-card {
            transition: all 0.2s ease-in-out;
            border: 1px solid #dee2e6;
        }

        .payment-option-card:hover {
            background-color: #fff8f5;
            border-color: #ffccbc;
        }

        .payment-option-card.selected {
            background-color: #fff5f0;
            border-color: #ff7043;
            box-shadow: 0 0 0 1px #ff7043;
        }

        /* Floating Labels Override */
        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
            color: #ff7043;
        }

        .form-control:focus {
            border-color: #ff7043;
            box-shadow: 0 0 0 0.25rem rgba(255, 112, 67, 0.25);
        }

        /* Order Summary Image */
        .summary-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }

        .btn-coupon {
            color: #ff7043;
            border-color: #ff7043;
        }

        .btn-coupon:hover {
            background-color: #ff7043;
            color: white;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 sticky-top">
        <div class="container position-relative">
            <a class="pf-logo" href="index.php">
                <img src="logo.svg" alt="Pepperfry" height="32">
            </a>
            <div class="ms-auto d-flex align-items-center gap-3">
                <a href="index.php" class="text-decoration-none text-dark fw-bold"><i class="bi bi-arrow-left me-1"></i>
                    Continue Shopping</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle"
                            data-bs-toggle="dropdown">
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

    <div class="container mb-5">
        <div class="row g-4">
            <!-- Left Column: Forms -->
            <div class="col-lg-8">
                <form action="place_order.php" method="POST" id="checkoutForm">

                    <!-- Shipping Details Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                            <h5 class="fw-bold mb-0"><i class="bi bi-geo-alt-fill me-2 text-orange"></i>Shipping Address
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" id="floatingName"
                                    placeholder="Full Name"
                                    value="<?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : ''; ?>"
                                    required>
                                <label for="floatingName">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea name="address" class="form-control" id="floatingAddress" placeholder="Address"
                                    style="height: 100px" required></textarea>
                                <label for="floatingAddress">Address (House No, Building, Street, Area)</label>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="city" class="form-control" id="floatingCity"
                                            placeholder="City" required>
                                        <label for="floatingCity">City</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="pincode" class="form-control" id="floatingPincode"
                                            placeholder="Pincode" required>
                                        <label for="floatingPincode">Pincode</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Card -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                            <h5 class="fw-bold mb-0"><i class="bi bi-wallet2 me-2 text-orange"></i>Payment Method</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex flex-column gap-3">

                                <!-- COD Option -->
                                <label class="card p-3 cursor-pointer payment-option-card selected" for="paymentCOD">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method"
                                                id="paymentCOD" value="COD" checked>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 fw-bold">Cash on Delivery</h6>
                                            <small class="text-muted">Pay with cash upon delivery.</small>
                                        </div>
                                        <i class="bi bi-cash-coin ms-auto fs-3 text-muted"></i>
                                    </div>
                                </label>

                                <!-- Online Payment Option -->
                                <label class="card p-3 cursor-pointer payment-option-card" for="paymentOnline">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method"
                                                id="paymentOnline" value="Online">
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 fw-bold">Online Payment</h6>
                                            <small class="text-muted">Credit/Debit Card, UPI, Net Banking.</small>
                                        </div>
                                        <i class="bi bi-credit-card-2-front ms-auto fs-3 text-muted"></i>
                                    </div>
                                </label>

                                <!-- Online Payment Sub-options (Hidden by default) -->
                                <div id="onlinePaymentOptions"
                                    class="ps-4 ms-2 border-start border-3 border-orange bg-white rounded p-3"
                                    style="display: none;">
                                    <h6 class="mb-3 small text-uppercase text-muted fw-bold">Select Payment Mode</h6>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input type="radio" class="btn-check" name="online_method" id="cc"
                                                value="Credit Card" autocomplete="off">
                                            <label class="btn btn-outline-secondary w-100" for="cc"><i
                                                    class="bi bi-credit-card me-1"></i> Card</label>
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" class="btn-check" name="online_method" id="upi"
                                                value="UPI" autocomplete="off">
                                            <label class="btn btn-outline-secondary w-100" for="upi"><i
                                                    class="bi bi-qr-code me-1"></i> UPI</label>
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" class="btn-check" name="online_method" id="nb"
                                                value="Net Banking" autocomplete="off">
                                            <label class="btn btn-outline-secondary w-100" for="nb"><i
                                                    class="bi bi-bank me-1"></i> NetBanking</label>
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" class="btn-check" name="online_method" id="dc"
                                                value="Debit Card" autocomplete="off">
                                            <label class="btn btn-outline-secondary w-100" for="dc"><i
                                                    class="bi bi-wallet me-1"></i> Debit</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="total_amount" value="<?php echo $totalPrice; ?>">

                    <button type="submit" class="btn btn-primary w-100 py-3 mt-4 fw-bold shadow-sm text-uppercase"
                        style="background-color: #ff7043; border: none; font-size: 1.1rem; letter-spacing: 0.5px;">
                        Place Order <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                    </button>
                </form>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 90px; z-index: 100;">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-uppercase text-muted small">Order Summary</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <?php foreach ($cartItems as $item): ?>
                                <div class="list-group-item py-3 px-3">
                                    <div class="d-flex gap-3 align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="<?php echo htmlspecialchars($item['image'] ?? 'images/default.jpg'); ?>"
                                                class="summary-img shadow-sm" alt="Product">
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h6 class="mb-1 small fw-bold text-truncate">
                                                <?php echo htmlspecialchars($item['name'] ?? 'Item'); ?></h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">Qty: <?php echo $item['quantity']; ?></small>
                                                <span
                                                    class="fw-bold text-dark small">₹<?php echo number_format(($item['price'] ?? 0) * $item['quantity']); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card-footer bg-light p-3 border-top">
                        <!-- Coupon Section -->
                        <div class="mb-3">
                            <label class="form-label small text-muted fw-bold mb-1">Have a Coupon?</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="couponInput"
                                    placeholder="Enter code">
                                <button class="btn btn-coupon btn-sm text-uppercase fw-bold" type="button"
                                    id="applyCouponBtn">Apply</button>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">Available: <span class="cursor-pointer text-orange fw-bold"
                                        onclick="document.getElementById('couponInput').value='WELCOME500'">WELCOME500</span>,
                                    <span class="cursor-pointer text-orange fw-bold"
                                        onclick="document.getElementById('couponInput').value='PF20'">PF20</span>, <span
                                        class="cursor-pointer text-orange fw-bold"
                                        onclick="document.getElementById('couponInput').value='HELLO1500'">HELLO1500</span></small>
                            </div>
                            <div id="couponFeedback" class="small mt-1"></div>
                        </div>
                        <div class="border-top border-dashed my-2"></div>

                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted">Subtotal</span>
                            <span>₹<?php echo number_format($totalPrice); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 small" id="discountRow" style="display:none;">
                            <span class="text-muted">Discount</span>
                            <span class="text-success" id="discountAmount"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 small">
                            <span class="text-muted">Shipping Charges</span>
                            <span class="text-success fw-bold">FREE</span>
                        </div>
                        <div class="border-top border-dashed my-2"></div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="fw-bold">Total Amount</span>
                            <span class="fw-bold fs-5 text-orange"
                                id="finalTotal">₹<?php echo number_format($totalPrice); ?></span>
                        </div>
                        <div class="mt-3 text-center">
                            <small class="text-muted d-flex align-items-center justify-content-center gap-1">
                                <i class="bi bi-shield-lock-fill text-success"></i> 100% Safe & Secure Payments
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
            const onlineOptions = document.getElementById('onlinePaymentOptions');
            const paymentCards = document.querySelectorAll('.payment-option-card');

            function updatePaymentSelection() {
                paymentRadios.forEach(radio => {
                    const card = radio.closest('.payment-option-card');
                    if (radio.checked) {
                        card.classList.add('selected');
                        if (radio.value === 'Online') {
                            onlineOptions.style.display = 'block';
                        } else {
                            onlineOptions.style.display = 'none';
                        }
                    } else {
                        card.classList.remove('selected');
                    }
                });
            }

            paymentRadios.forEach(radio => {
                radio.addEventListener('change', updatePaymentSelection);
            });

            // Initial call to set state
            updatePaymentSelection();

            // Coupon Logic
            const applyBtn = document.getElementById('applyCouponBtn');
            const couponInput = document.getElementById('couponInput');
            const feedback = document.getElementById('couponFeedback');
            const discountRow = document.getElementById('discountRow');
            const discountAmount = document.getElementById('discountAmount');
            const finalTotal = document.getElementById('finalTotal');
            const totalInput = document.querySelector('input[name="total_amount"]');
            const originalTotal = <?php echo $totalPrice; ?>;

            if (applyBtn) {
                applyBtn.addEventListener('click', function () {
                    const code = couponInput.value.trim();
                    if (code === '') {
                        feedback.className = 'small mt-1 text-danger';
                        feedback.innerText = 'Please enter a coupon code.';
                        return;
                    }

                    const formData = new FormData();
                    formData.append('code', code);
                    formData.append('total', originalTotal);

                    fetch('validate_coupon.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                feedback.className = 'small mt-1 text-success';
                                feedback.innerText = data.message;
                                discountRow.style.display = 'flex';
                                discountAmount.innerText = '-₹' + data.discount.toLocaleString('en-IN');
                                finalTotal.innerText = '₹' + data.newTotal.toLocaleString('en-IN');
                                if (totalInput) totalInput.value = data.newTotal;
                            } else {
                                feedback.className = 'small mt-1 text-danger';
                                feedback.innerText = data.message;
                                discountRow.style.display = 'none';
                                finalTotal.innerText = '₹' + originalTotal.toLocaleString('en-IN');
                                if (totalInput) totalInput.value = originalTotal;
                            }
                        })
                        .catch(err => console.error(err));
                });
            }

            // Validation: Full Name (Alphabets only)
            const nameInput = document.getElementById('floatingName');
            if (nameInput) {
                nameInput.addEventListener('input', function () {
                    const regex = /[^a-zA-Z\s]/g;
                    if (regex.test(this.value)) {
                        alert('Full Name should contain only alphabets.');
                        this.value = this.value.replace(regex, '');
                    }
                });
            }

            // Validation: Pincode (Digits only, max 6)
            const pincodeInput = document.getElementById('floatingPincode');
            if (pincodeInput) {
                pincodeInput.addEventListener('input', function () {
                    const regex = /\D/g;
                    if (regex.test(this.value)) {
                        alert('Pincode should contain only digits.');
                        this.value = this.value.replace(regex, '');
                    }
                    if (this.value.length > 6) {
                        alert('Pincode should be exactly 6 digits.');
                        this.value = this.value.slice(0, 6);
                    }
                });
            }
        });
    </script>
</body>

</html>