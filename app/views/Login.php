<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/LUXURY_SPORTS/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/Login.css">
    <title>Document</title>
</head>
<body>
    <div class="container-login">
        <img src="https://static1.squarespace.com/static/595ea7d6e58c62dce01d1625/t/5e5969dc3ca1436a76e4eac1/1564065314028/aspen-project-play-kids-sports-participation.jpeg?format=1500w" alt="">
        <div class="box-form-login">
            <div class="inform-loginlogin">
                <?php 
                    //kiểm tra $data['Result'] có tồn tại không
                    if (isset($data['Result'])) {
                        if ($data['Result'] === true) {
                            //chuyển đến trang Login nếu đăng ký thành công
                            header('Location: /LUXURY_SPORTS/home');
                            exit();
                        } 
                        // ?? tóan tử null-coalescing: nếu Message tồn tại và ko rỗng thì sẽ in ra, không tồn tại hoặc null thì sẽ thay thế bằng ''
                        echo $data['Message'] ?? '';
                    }
                ?>
            </div>
            <form action="/LUXURY_SPORTS/Login/login" method="POST">
                <div class="title-login">
                    <span>LOGIN</span>
                    <a href="/LUXURY_SPORTS/home"><i class="fa-solid fa-xmark"></i></a>
                </div>
                <input class="username-login" type="text" name="username" placeholder="Username">
                <input class="password-login" type="password" name="password" placeholder="Password">
                <div class="remind-login">
                    <input class="checkbox" type="checkbox">
                    <p>Remember me</p>
                </div>
                <button class="done-login" type="submit">Log In</button>
                <a class="forgot-password" href="">Lost your password?</a>
                <div class="question-login">
                    <p>Not a member?</p>
                    <a href="/LUXURY_SPORTS/Register">Register</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
  