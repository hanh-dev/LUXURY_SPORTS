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
    <!-- Link Bootstrap -->
    <title>Home</title>
</head>
<body>
    <div class="wrapper_image">
        <img src="public/images/teambanner.jpg" alt="banner_iamge">
    </div>
    <!-- Hãy luôn nhớ khi mà đặt tên page thì là: page_name.view.php -->
    <div class="site_product">
        <div class="wrapper_main_content">
            <div class="slide-show-container">
                <button class="nav-button prev" onclick="slideProduct('prev')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <?php foreach($data['Category'] as $category) { ?>
                    <div class="product-grid">
                        <div class="product-slide active">
                            <div class="product-card">
                                <div class="image-container">
                                    <img src="<?= 'public/images/'.$category['Image'] .'.png'?>" alt="">
                                    <div class="content">
                                    <h2><?php echo $category['Name'] ?></h2>
                                    <div class="form-btn">
                                        <button class="shop-now">Shop Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <button class="nav-button next" onclick="slideProducts('next')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
                <!-- EndSlideShow -->
        </div>
    </div>
</div>
    <script src="public/js/Slider.js"></script>
</body>
</html>