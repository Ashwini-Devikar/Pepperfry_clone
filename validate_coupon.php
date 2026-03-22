<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'] ?? '';
    $total = floatval($_POST['total'] ?? 0);

    // Define available coupons (In a real app, fetch these from a database)
    $coupons = [
        'WELCOME500' => ['type' => 'flat', 'value' => 500, 'min_order' => 2000],
        'PF20' => ['type' => 'percent', 'value' => 20, 'max_discount' => 1000, 'min_order' => 1000],
        'HELLO1500' => ['type' => 'flat', 'value' => 1500, 'min_order' => 5000]
    ];

    if (array_key_exists($code, $coupons)) {
        $coupon = $coupons[$code];
        
        if ($total >= $coupon['min_order']) {
            $discount = 0;
            if ($coupon['type'] === 'flat') {
                $discount = $coupon['value'];
            } else {
                $discount = ($total * $coupon['value']) / 100;
                if (isset($coupon['max_discount'])) {
                    $discount = min($discount, $coupon['max_discount']);
                }
            }
            
            // Ensure discount doesn't exceed total
            $discount = min($discount, $total);
            $newTotal = $total - $discount;

            echo json_encode([
                'status' => 'success',
                'message' => 'Coupon applied!',
                'discount' => $discount,
                'newTotal' => $newTotal
            ]);
        } else {
            echo json_encode([
                'status' => 'error', 
                'message' => 'Min order value is ₹' . number_format($coupon['min_order'])
            ]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid coupon code']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
