<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/LUXURY_SPORTS/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/Register.css">
    <title>Document</title>
</head>
<body>
    <div class="container-register">
        <img src="https://www.strathroy-caradoc.ca/en/getting-active/resources/InteriorBannerImages/SportsOrganizations_-_INSIDEPAGE.jpg" alt="">
        <div class="box-form-register">
            <?php 
                //kiểm tra $data['Result'] có tồn tại không
                if (isset($data['Result'])) {
                    if ($data['Result'] === true) {
                        //chuyển đến trang Login nếu đăng ký thành công
                        header('Location: /LUXURY_SPORTS/Login');
                        exit();
                    } 
                    
                }
            ?>
            <form action="/LUXURY_SPORTS/Register/register" method="POST">
                <div class="title">
                    <span>REGISTER</span>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <input class="email" type="email" name="email" placeholder="Email address">
                <input class="username" type="text" name="username" placeholder="Username">
                <input class="password" type="password" name="password" placeholder="Password">
                <input class="confirmpass" type="password" name="confirmPassword" placeholder="Confirm password">
                <h4 class="remind">Please ensure your information!</h4>
                <button class="done-register" type="submit">Register</button>
                <div class="question">
                    <p>Aready a member?</p>
                    <a href="/LUXURY_SPORTS/Login">Login</a>
                </div>
            </form> 
        </div>
    </div>
</body>
</html>