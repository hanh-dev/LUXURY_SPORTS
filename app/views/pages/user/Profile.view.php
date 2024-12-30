<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Link Header css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <base href="/LUXURY_SPORTS/">
    <link rel="stylesheet" href="public/css/Profile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="main_profile">
            <div class="element_left">
                <div class="image_container">
                    <div class="image_hold">
                        <img id='image' src="<?= $data['data']['Image'] != null ? $data['data']['Image'] : '' ?>" alt="">
                        <input type="file" id="fileInput" style="display: none;" accept="image/*">
                    </div>
                </div>

                <div class="AccountDetail" id="accountDetail">
                    <div class="form_detail form">
                        <i class="fa-solid fa-user"></i>
                        <span class="detail">Account Detail</span>
                    </div>
                </div>
                <hr>
                <div class="OrderTrack" id='ordertrack'>
                    <div class="form_detail form">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span class="detail">Orders</span>
                    </div>
                </div>
                <hr>
                <div class="WishListTrack" id='wishlisttrack'>
                    <div class="form_detail form">
                        <i class="fa-solid fa-heart"></i>
                        <span class="detail">WishList</span>
                    </div>
                </div>
                <hr>
                <div class="AccountLogout">
                    <div class="form_logout form">
                        <i class="fas fa-sign-out-alt"></i> 
                        <span class="logout" id="logout">Logout</span>
                    </div>
                </div>
            </div>
            <div class="element_right">
                <div id="profile_display">
                    <!-- Display content -->
                </div>
            </div>
        </div>
    <!-- Toast Updated Successfully -->
    <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" id="myToast">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fa-solid fa-circle-check" id="icon_noti"></i>
                <span id="content_toast">Updated Successfully</span>
            </div>
        </div>
    </div>
    <!-- script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="public/js/Profile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>
</html>