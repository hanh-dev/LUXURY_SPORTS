<?php
class Register extends Controller
{
    public $UserModel; //biến lưu trữ đối tượng của lớp UserModel
    public $result = false; //trạng thái mặc định là false và sẽ thành true khi đăng ký thành công
    // Hàm này luôn được khởi chạy đầu tiên khi tạo một đối tượng
    public function __construct() {
        $this->UserModel = $this->model('UserModel');
    }

    //hàm gọi đến file giao diện để hiển thị
    public function show() {
        $this->view('master',[
            'Page' => 'Register'
        ]);
    }

    public function register() {
        //chỉ lấy data từ post
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //kiểm tra điền đầy đủ thông tin không
            if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                $email = $_POST['email'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirmPassword'];

                
                //biến lưu pass đã được mã hóa
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                //gọi đến hàm createUser ở lớp UserModel có kết quả trả về
                $kq = $this->UserModel->createUser($email, $username, $hashedPassword);
                $this->result = $kq;
            }
        }
        $this->view('master',[
            'Message' => 'Please enter all field!',
            'Result' => $this->result,
            'Page' => 'Register'
        ]);
    }

}