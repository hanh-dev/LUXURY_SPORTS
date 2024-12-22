<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
                    <form action="" id="frm-infor">
                        <div class="user-Name">
                            <input type="text" class="name" placeholder="User name">
                        </div>
                        <div class="user-Adress">
                            <input type="text" class="address" placeholder="Address">
                        </div>
                        <div class="user-Phone">
                            <input type="text" class="phone" placeholder="Phone">
                        </div>
                    </form>
                    <div class="payment">
                        <h4 class="heading-payment">Payment Options</h4>
                        <div class="method-payment">
                            <div class="momo">
                                <input type="radio" id="momo" name="payment-option" value="momo">
                                <label for="momo">Direct bank transfer</label>
                            </div>
                            <div class="cash">
                                <input type="radio" id="cash"  name="payment-option" value="cash">
                                <label for="cash">Cash on delivery</label>

                            </div>
                        </div>
                    </div>
                    <div class="return-order">
                        <button type="button" class="return"><i class="fa-solid fa-arrow-left"></i>Return to cart</button>
                        <button type="button" class="order">Place order</button>
                    </div>
                </div>
                <div class="form-right">
                    <!-- <h4 class="heading-order">Order Sumary</h4>
                    <div class="order-summary">
                        <div class="product-item">
                            <div class="box-quantity">1</div>
                            <div class="image">
                                <img src="public/images/Basketball-img.png" alt="">
                            </div>
                            <div class="tile-price">
                                <p class="title">Basketball</p>
                                <span class="price">$34</span>
                        </div>
                        <div class="total">
                            <span class="total-price">$34</span>
                        </div>
                    </div>
                    <div class="total-order">
                        <h5 class="heading-total">TOTAL</h5>
                        <span class="total">$34</span>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>