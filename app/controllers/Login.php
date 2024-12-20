<?php
class Login extends Controller
{
    public $UserModel;

    public function __construct() {
        $this->UserModel = $this->model('UserModel');
    }

    public function show() {
        $this->view('Login');
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = htmlspecialchars(trim($_POST['username'] ));
            $password = htmlspecialchars(trim($_POST['password'] ));
            if (empty($username) || empty($password)) {
                $this->view('Login', [
                    'Message' => 'Username and password cannot be empty.',
                    'Result' => false
                ]);
                return;
            }
            $result = $this->UserModel->checkUsernamePassword($username, md5($password));
            $userID = $this->UserModel->getUserID($username);
            $roleID = $this->UserModel->getRoleID($userID);
            if ($result) {
                if($roleID == 2) {
                    //đăng nhập thành công -> home
                    header('Location:/LUXURY_SPORTS/Home');
                    $_SESSION['user_id'] = $userID;
                    exit();
                } else {
                    //đăng nhập thành công -> home
                    $_SESSION['user_id'] = $userID;
                    if(isset($_SESSION['user_id'])) {
                        header('Location:/LUXURY_SPORTS/HomeAdmin');
                    }
                    exit();
                }
            } else {
                //thông báo lỗi khi đăng nhập không thành công
                $this->view('Login', [
                    'Message' => 'Invalid username or password ',
                    'Result' => false,
                ]);
            }
        }
    }
}
