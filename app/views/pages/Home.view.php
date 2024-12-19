<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <!-- Link Header css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                    <!-- Hiển thị dữ liệuliệu -->
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Toast Updated Successfully -->
    <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" id="myToast">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fa-solid fa-circle-check" id="icon_noti"></i>
                <span id="content_toast">Added product to cart successfully</span>
            </div>
        </div>
    </div>
    <script src="/LUXURY_SPORTS/public/js/Search.js"></script>
    <script src="public/js/Slider.js"></script>
    <script src="public/js/Cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
</html>