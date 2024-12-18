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

                <div class="AccountDetail">
                    <div class="form_detail form">
                        <i class="fa-solid fa-user"></i>
                        <span class="detail">Account Detail</span>
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
                <div class="right_hold">
                    <div class="name">
                        <label for="name">Display Name</label>
                        <input type="text" value="<?=$data['data']['Name']!=Null ?$data['data']['Name']: ''?>" readonly id="name">
                    </div>
                    <div class="email">
                        <label for="email">Email Address</label>
                        <input type="email" value="<?=$data['data']['EmailAddress']!=Null ?$data['data']['EmailAddress']: ''?>" readonly id="email">
                    </div>
                    <div class="phoneNumber">
                        <label for="phoneNumber">PhoneNumber</label>
                        <input type="text" value="<?=$data['data']['PhoneNumber']!=Null ?$data['data']['PhoneNumber']: ''?>" readonly id="phone">
                    </div>
                </div>
                <div class="form_btn">
                    <button id="edit" type="button">Edit</button>
                    <button id="save" type="button">Save Changes</button>
                </div>
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
    <script src="public/js/Profile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</body>
</html>