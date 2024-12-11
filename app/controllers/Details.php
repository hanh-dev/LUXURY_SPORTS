<?php
    class Details extends Controller
    {
        public function show($id= null)
        {
            // Hiện tại chỉ hiển thị view (chưa cần lấy dữ liệu sản phẩm)
            $this->view('master',[
                'Page' => 'page_details'
            ]);
        }
    }

?>