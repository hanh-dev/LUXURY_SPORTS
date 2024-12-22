<?php
    class Checkout extends Controller
    {
        public $CheckoutModel;
        
        public function __construct() {
            $this->CheckoutModel = $this->model('CheckoutModel');
        }

        public function show() {
            $productOrder = $this->CheckoutModel->getProductOrder();

            $this->view('master', [
                'ProductOrder' => $productOrder,
                'Page' => 'Checkout'
            ]);
        }


    }
?>
