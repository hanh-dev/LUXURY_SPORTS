<?php
class Home extends Controller
{
    public $ProductModel;
    // Hàm này luôn được khởi chạy đầu tiền khi tạo một đối tượng
    public function __construct() {
        $this->ProductModel = $this->model('ProductModel');
    }

    public function show() {
        // Lấy dữ liệu từ Model để chuyển sang View
        $products = $this->ProductModel->getProduct();
        // Chuyển dữ liệu vừa mới lấy được từ Model
        $this->view('master', [
            // Dữ liệu mà mình muốn truyền vào Page của mình
            'ProductList' => $products,
            // Luôn luôn truyền trang mà mình mong muốn sẽ hiển thị ở đây
            'Page' => 'Home'
        ]);
    }

}