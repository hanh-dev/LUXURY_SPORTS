<?php
    class Cart extends Controller
    {
        public $CartModel;


        public function __construct() {
            $this->CartModel = $this->model('CartModel');
        }

        public function show() {
            $productCart = $this->CartModel->getProductCart();

            $this->view('master', [
                'ProductCart' => $productCart,
                'Page' => 'Cart'
            ]);
        }

        public function removeProduct() {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
           
            // Gọi phương thức từ model để xoá sản phẩm
            $result = $this->CartModel->removeProduct($data['productID']);
       
            // Trả về phản hồi JSON
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
            exit();
        }

       
    }
?>
