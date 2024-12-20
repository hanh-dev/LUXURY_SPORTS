<?php
    class Cart extends Controller
    {
        public $CartModel;
        public $productModel;

        public function __construct() {
            $this->CartModel = $this->model('CartModel');
            $this->productModel = $this->model('ProductModel');
        }

        public function show() {
            $productCart = $this->CartModel->getProductCart();

            $this->view('master', [
                'ProductCart' => $productCart,
                'Page' => 'Cart'
            ]);
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
                $stock = $this->CartModel->getProductStock($productID);
                if ($quantity > $stock) {
                    echo json_encode([
                        'success' => false,
                        'message' => "Quantity exceeds inventory! Only $stock products left."
                    ]);
                    return;
                }
       
                // Cập nhật số lượng trong cơ sở dữ liệu
                $result = $this->CartModel->updateProductQty($productID, $quantity);
                if ($result) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Quantity update successful!',
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Quantity update failed!',
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid data!',
                ]);
            }
        }

       
    }
?>
