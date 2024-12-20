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

        public function updateProductQty($productID) {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
       
            if (isset($data['quantity']) && is_numeric($data['quantity'])) {
                $quantity = intval($data['quantity']);
       
                // Kiểm tra tồn kho
                // $stock = $this->CartModel->getProductStock($productID);
                // if ($quantity > $stock) {
                //     echo json_encode([
                //         'success' => false,
                //         'message' => "Số lượng vượt quá tồn kho! Chỉ còn lại {$stock} sản phẩm."
                //     ]);
                //     return;
                // }
       
                // Cập nhật số lượng trong cơ sở dữ liệu
                $result = $this->CartModel->updateProductQty($productID, $quantity);
                if ($result) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Cập nhật số lượng thành công!',
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Cập nhật số lượng thất bại!',
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ!',
                ]);
            }
        }

       
    }
?>
