<?php
require __DIR__ . "/../../vendor/autoload.php";

use Stripe\Stripe;
use Stripe\Checkout\Session;

// Khóa bí mật của Stripe
$stripe_secret_key = "sk_test_51QZrQoJpm6tI6IlWAEWzV5YkTzi9HAdPawp3Myfe70206SxU1ru4zRKwgdDLwmahJkVmBr8COuuTgs9SvrbJgcrn00SXJH7JX6";

// Đặt khóa API
Stripe::setApiKey($stripe_secret_key);


// Tạo phiên thanh toán
$checkout_session = Session::create([
    "payment_method_types" => ["card"], // Loại phương thức thanh toán
    "mode" => "payment", // Chế độ thanh toán
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 2000,
                "product_data" => [
                    "name" => "T-Shirt",
                ],
            ],
        ],
    ],
    "success_url" => "http://localhost:8080/LUXURY_SPORTS/Home/show", // URL khi thanh toán thành công
    "cancel_url" => "http://localhost/LUXURY_SPORTS/Cart/cancel", // URL khi hủy thanh toán
]);

// Chuyển hướng tới giao diện thanh toán của Stripe
header("Location: " . $checkout_session->url);
exit;
?>
