<?php

class Cart extends Controller {
    public $productModel;
    public function __construct() {
        $this->productModel = $this->model('ProductModel');
    }


    public function createOrder() {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        $result = $this->productModel->createOrder($_SESSION['user_id'],$data['productID'], $data['quantity']);
        if($result) {
            echo json_encode(['success' => true, 'message' => 'Added to order successfully']);
        }else {
            echo json_encode(['success' => false, 'message' => 'Error creating order']);
        }
    }

    public function getQuantityCart() {
        if(isset($_SESSION['user_id'])) {
            $result = $this->productModel->getQuantityCart($_SESSION['user_id']);
            echo '<div class="count_badge">' . $result . '</div>';
        }
    }
}