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
       
    }
?>
