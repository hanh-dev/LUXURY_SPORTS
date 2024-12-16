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
        <div class="container">
            <div class="main-title">
                <h3 class="text-center" >CART</h3>
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
                                    <th class="remove">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- RENDER DATABASE -->
                                <tr class="item">
                                    <td class="image">
                                        <img src="#" class="product-img">
                                    </td>
                                    <td class="product-Name">
                                        <span class="text-hover">Sneaker</span>
                                    </td>
                                    <td class="qty">
                                        <input type="number" min="1" max="5000" value="5" class="item-quantity">
                                    </td>
                                    <td class="price">$20</td>
                                    <td class="remove">
                                        <a href="#" >
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--CART TOTAL -->
                    <div class="cart-total">
                        <h3 class="heading-title">CART TOTAL</h3>
                        <div class="subtotal">
                            <p class="subtotal-title">Subtotal</p>
                            <span class="subtotal-price">$20</span>
                        </div>
                        <div class="total">
                            <p class="total-title">TOTAL</p>
                            <span class="total-price">$20</span>
                        </div>
                        <button type="button" class="btn-primary-checkout">Checkout</button>
                    </div>

                </div>
        </div>
    </div>
</body>
</html>
