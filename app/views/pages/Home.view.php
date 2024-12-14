<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <!-- Link Header css -->
     <base href="/LUXURY_SPORTS/">
    <link rel="stylesheet" href="public/css/Home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Home</title>
</head>
<body>
    <div class="wrapper_image">
        <img src="public/images/teambanner.jpg" alt="banner_iamge">
    </div>
    <div class="site_product">
        <!-- SliderShow -->
        <div class="wrapper_main_content">
        <div class="slide-show-container">
            <button class="nav-button prev-btn" onclick="slideProduct('prev')">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="slides-wrapper">
                <div class="slides-track">
                    <?php foreach($data['Category'] as $category) { ?>
                        <div class="product-card">
                            <div class="image-container">
                                <img src="<?= 'public/images/'.$category['Image'] .'.png'?>" alt="">
                            </div>
                            <div class="content">
                                <h2><?php echo $category['Name'] ?></h2>
                                <div class="form-btn">
                                    <button class="shop-now">Shop Now</button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <button class="nav-button next-btn" onclick="slideProduct('next')">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
            <!-- EndSlideShow -->
            <!-- Product-->
        <div class="main_product">
            <div class="main_wrapper">
                <div class="main_title">
                    <h1>PRODUCTS</h1>
                </div>
                <div class="product_menu">
                    <?php foreach($data['Product'] as $product) { ?>
                        <a href="Details/show/<?= $product['ID'] ?>">
                            <div class="product_item">
                                <div class="product_image">
                                    <img src="<?= 'public/images/'.$product['Image'].'.png' ?>" alt="">
                                </div>
                                <div class="wrapp_heart">
                                    <i class="fa-regular fa-heart"></i>
                                </div>
                                <div class="wrapp_add">
                                    <span>Add to cart</span>
                                </div>
                                <div class="product_name">
                                    <span><?= $product['Name'] ?></span>
                                </div>
                                <div class="product_price">
                                    <span>$<?= $product['Price'] ?></span>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
    <script src="public/js/Slider.js"></script>
</body>
</html>