<?php
    class Details extends Controller
    {
        public $DetailsModel;
         // Hàm này luôn được khởi chạy đầu tiền khi tạo một đối tượng
        public function __construct() {
            $this->DetailsModel = $this->model('DetailsModel');
        }

        public function show($productID = 1)
        {
            //lấy dữ liệu sản phẩm từ model mới
            $result = $this->DetailsModel->getProduct($productID);

            // // Lưu dữ liệu vào mảng
            $product = mysqli_fetch_assoc($result);
            // $products = [];
            // while($row = mysqli_fetch_assoc($result)) {
            //     $products[] = $row;
            // }

            // Truyền dữ liệu sang view
            $this->view('master',[
                'Product' => $product,
                'Page' => 'page_details'
            ]);
        }
    }

?>