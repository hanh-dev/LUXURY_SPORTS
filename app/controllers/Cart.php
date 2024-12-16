<?php
    class Cart extends Controller
    {
        public $CartModel;


        public function __construct() {
            $this->CartModel = $this->model('CartModel');
        }

        public function show() {

            $this->view('master', [
                'Page' => 'Cart'
            ]);
        }
       
    }
?>
