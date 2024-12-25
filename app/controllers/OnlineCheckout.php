
<?php
    require __DIR__ . "/../../vendor/autoload.php";
    use Stripe\Stripe;
    $stripe_secret_key = "sk_test_51QZrQoJpm6tI6IlWAEWzV5YkTzi9HAdPawp3Myfe70206SxU1ru4zRKwgdDLwmahJkVmBr8COuuTgs9SvrbJgcrn00SXJH7JX6";

    Stripe\Stripe::setApiKey($stripe_secret_key);

    $checkout_session =  \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "USD",
                    "unit_amout" => 2000,
                    "product_data" => [
                        "name" => "T-Shirt"
                    ]
                ]
            ]
        ]
    ]);

?>