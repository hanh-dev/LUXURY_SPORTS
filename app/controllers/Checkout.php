<?php
    class Checkout extends Controller 
    {
        
        public function __construct() {

        }

        public function show() {

            $this->view('master', [
                'Page' => 'Checkout'
            ]);
        }

    }
?>