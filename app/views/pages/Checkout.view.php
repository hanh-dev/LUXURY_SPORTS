<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/LUXURY_SPORTS/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
      <!-- Bootstrap CSS  -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
       
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="public/css/Checkout.css">
</head>
<body>
    <div id="checkout">
        <div class="container">
            <h2 class="heading-title">CHECKOUT</h2>
            <div class="container-small">
                <div class="form-left">
                    <h4 class="heading-billing">Billing address</h4>
                    <form action="" id="frm-infor" onsubmit="validateForm(event)">
                        <div class="user-Name">
                            <input type="text" class="name" name="name" placeholder="User name" required>
                        </div>
                        <div class="user-Adress">
                            <input type="text" class="address" name="address" placeholder="Address" required>
                        </div>
                        <div class="user-Phone">
                            <input type="text" class="phone" name="phone" placeholder="Phone" required>
                        </div>
                        <div id="error-message" class="error-message" style="display: none;">
                            <span>Vui lòng điền đầy đủ thông tin.</span>
                        </div>
                    </form>
                    <div class="return-order">
                        <button type="button" class="return"><a  href="/LUXURY_SPORTS/Cart/show"><i class="fa-solid fa-arrow-left"></i>Return to cart</a></button>
                        
                        <button onclick="payment()">Pay</button>
                    </div>
                </div>
                <div class="form-right">
                    <h4 class="heading-order">Order Summary</h4>
                    <div class="order-summary">
                        <?php
                            if (isset($data['ProductOrder']) && is_array($data['ProductOrder'])) {
                                
                                $totalPrice = 0;
                                foreach ($data['ProductOrder'] as $product) {
                                    $totalPrice += $product['Price'] * $product['Qty'];
                                ?>
                                <div class="product-item">
                                    <div class="box-quantity"><?php echo $product['Qty']?></div>
                                    <div class="image">
                                        <img src="<?= 'public/images/' . $product['Image'] . '.png' ?>" alt="<?php echo $product['Name']?>">
                                    </div>
                                    <div class="tile-price">
                                        <p class="title"><?php echo $product['Name']?></p>
                                        <span class="price">$<?= $product['Price'] ?></span>
                                    </div>
                                    <div class="total">
                                        <span class="total-price">$<?= $product['Price'] * $product['Qty'] ?></span>
                                    </div>
                                </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="total-order">
                        <h5 class="heading-total">TOTAL</h5>
                        <span class="total">$<?= $totalPrice ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>