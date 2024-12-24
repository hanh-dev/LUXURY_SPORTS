<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Bootstrap CSS  -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
       
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="public/css/Cart.css">
</head>
<body>
    <div id="cart">
        <div class="container" id="cart_contain">
            <div class="main-title">
            <h3 class="d-flex justify-content-between align-items-center">
                CART
                <div class="note text-danger" style="font-size: 14px;">Note: Please push the enter button after changing the quantity</div>
            </h3>
                <div id="notification-deleted"></div>
            </div>
                <div class="product-cart" id="layout-page">
                    <div class="cartformpage">
                        <table class="cart cart-hidden">
                            <thead>
                                <tr>
                                <th class="image">Image</th>
                                    <th class="product-Name">Name</th>
                                    <th class="qty">Quantity</th>
                                    <th class="price">Price</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Delete</th>
                                    <th class="select">Select</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- RENDER DATABASE -->
                                <?php
                                    $productCart = $data['ProductCart'];
                                    foreach ($productCart as $product):
                                ?>
                                <tr class="item" data-id="<?= $product['ID'] ?>">
                                    <td class="image">
                                        <img src="<?= 'public/images/' .$product['Image'] . '.png'?>" alt="<?php echo $product['Name']?>" class="product-img">
                                    </td>
                                    <td class="product-Name">
                                        <span class="text-hover"><?php echo $product['Name']?></span>
                                    </td>
                                    <td class="qty">
                                        <input type="number" min="1" name="quantity" value="<?php echo $product['Qty'] ?>" class="item-quantity" data-price="<?= $product['Price'] ?>" onkeydown="updateQuantity(event, <?= $product['ID'] ?>)">
                                    </td>
                                    <td class="price">$<?= $product['Price'] ?></td>
                                    <td class="total">$<?= $product['Price'] * $product['Qty'] ?></td>
                                    <td class="remove">
                                        <a onclick="confirmDelete(<?= $product['ID'] ?>)">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </a>
                                    </td>
                                    <td class="select-product">
                                        <input type="checkbox" class="check-select">
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <!--CART TOTAL -->
                    <?php
                        $subtotal = 0;
                        foreach($productCart as $product){
                            $subtotal += $product['Price'] * $product['Qty'];
                        }
                    ?>
                    <div class="cart-total">
                        <h3 class="heading-title">CART TOTAL</h3>
                        <div class="subtotal">
                            <p class="subtotal-title">Subtotal</p>
                            <span class="subtotal-price" id="subtotal-value">$<?= $subtotal ?></span>
                        </div>
                        <div class="total">
                            <p class="total-title">TOTAL</p>
                            <span class="total-price" id="total-value">$<?= $subtotal ?></span>
                        </div>
                        <button type="button" class="btn-primary-checkout" onclick="checkout()">Proceed to Checkout</button>
                    </div>

                </div>
        </div>
    </div>
    <!-- Javascript -->
    <script src="public/js/ConfirmCart.js"></script>

</body>
</html>
