<?php
class Home extends Controller
{
    public $ProductModel;

    public function __construct() {
        $this->ProductModel = $this->model('ProductModel');
    }
    public function show() {
        $products = $this->ProductModel->getProduct();
        $category = $this->ProductModel->getCategory();
        
        $this->view('master', [
            'Product' => $products,
            'Category' => $category,
            'Page' => 'Home'
        ]);
    }

    public function getUserID() {
        header('Content-Type: application/json');
        if (isset($_SESSION['user_id'])) {
            echo json_encode(['success' => true, 'id' => $_SESSION['user_id']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
        }
    }
    
}