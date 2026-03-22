<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed - Pepperfry Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .success-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            padding: 60px 40px;
            text-align: center;
            max-width: 550px;
            width: 100%;
            margin: auto;
            position: relative;
            overflow: hidden;
            animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }
        @keyframes slideUp {
            from { transform: translateY(40px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .check-container {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 35px;
            box-shadow: 0 10px 25px rgba(76, 175, 80, 0.3);
            animation: scaleIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) 0.3s both;
        }
        @keyframes scaleIn {
            from { transform: scale(0); }
            to { transform: scale(1); }
        }
        .check-icon {
            color: white;
            font-size: 50px;
            stroke-width: 2px;
        }
        .order-id-badge {
            background: #fff5f0;
            color: #ff7043;
            padding: 12px 25px;
            border-radius: 50px;
            display: inline-block;
            margin: 25px 0;
            font-weight: 600;
            font-size: 1rem;
            border: 1px dashed #ffccbc;
            letter-spacing: 0.5px;
        }
        .btn-continue {
            background-color: #ff7043;
            border: none;
            padding: 14px 40px;
            font-weight: bold;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(255, 112, 67, 0.3);
        }
        .btn-continue:hover {
            background-color: #f4511e;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 112, 67, 0.4);
        }
        .confetti-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
        }
    </style>
</head>
<body>

    <!-- Navbar (Simplified) -->
    <nav class="navbar navbar-light bg-white shadow-sm py-3">
        <div class="container justify-content-center">
            <a class="navbar-brand" href="index.php">
                <img src="logo.svg" alt="Pepperfry" height="36">
            </a>
        </div>
    </nav>

    <div class="container flex-grow-1 d-flex align-items-center justify-content-center py-5">
        <div class="success-card">
            <div class="check-container">
                <i class="bi bi-check-lg check-icon"></i>
            </div>
            
            <h2 class="fw-bold mb-3 text-dark display-6">Order Placed Successfully!</h2>
            <p class="text-muted mb-0 fs-5" style="line-height: 1.6;">
                Thank you for your purchase. <br>
                Your order has been confirmed and will be shipped shortly.
            </p>
            
            <div class="order-id-badge">
                Order ID: #PF<?php echo rand(1000000, 9999999); ?>
            </div>

            <div class="d-grid gap-3 col-lg-10 mx-auto">
                <a href="index.php" class="btn btn-primary btn-continue rounded-pill">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>

    <!-- Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <script>
        // Trigger confetti animation on load
        window.onload = function() {
            var duration = 3 * 1000;
            var animationEnd = Date.now() + duration;
            var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

            function random(min, max) {
              return Math.random() * (max - min) + min;
            }

            var interval = setInterval(function() {
              var timeLeft = animationEnd - Date.now();

              if (timeLeft <= 0) {
                return clearInterval(interval);
              }

              var particleCount = 50 * (timeLeft / duration);
              
              // Confetti from left and right
              confetti(Object.assign({}, defaults, { 
                  particleCount, 
                  origin: { x: random(0.1, 0.3), y: Math.random() - 0.2 },
                  colors: ['#ff7043', '#4CAF50', '#2196F3', '#FFC107']
              }));
              confetti(Object.assign({}, defaults, { 
                  particleCount, 
                  origin: { x: random(0.7, 0.9), y: Math.random() - 0.2 },
                  colors: ['#ff7043', '#4CAF50', '#2196F3', '#FFC107']
              }));
            }, 250);
        };
    </script>
</body>
</html>