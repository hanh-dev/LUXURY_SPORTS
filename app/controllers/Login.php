<?php
class Login extends Controller
{
    public $UserModel;
    // Hàm này luôn được khởi chạy đầu tiền khi tạo một đối tượng
    public function __construct() {
        $this->UserModel = $this->model('UserModel');
    }

    public function show() {
        // Lấy dữ liệu từ Model để chuyển sang View
        // $products = $this->ProductModel->getProduct();
        // Chuyển dữ liệu vừa mới lấy được từ Model
        $this->view('master', [
            'Page' => 'Login'
        ]);
    }

}