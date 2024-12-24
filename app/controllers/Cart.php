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
                        'message' => "Only $stock products left.",
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

        public function getQuantityOfProduct() {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            $quantity = $this->CartModel->getProductStock($data['productID']);
            echo json_encode(['success'=>true,'quantity' => $quantity]);
        }

        // checkout
        public function checkout() {
            // $data = file_get_contents('php://input');
            // $data = json_decode($data, true);
        
            // if (!empty($data['selectedProducts'])) {
            //     // Trường hợp có sản phẩm được chọn
            //     $productsToCheckout = $data['selectedProducts'];
            // } else {
            //     $productsToCheckout = $this->CartModel->getProductCart();
            // }
        
            $productsToCheckout = $this->CartModel->getProductCart();

            // Kiểm tra nếu không phải là mảng, trả về lỗi
            // if (!is_array($productsToCheckout)) {
            //     $productsToCheckout = [];
            // }
        
            
            $this->view('master', [
                // 'ProductOrder' => $productsToCheckout,
                'Page' => 'Checkout',
            ]);
        }
        

        // public function execPostRequest($url, $data) {
        //     $ch = curl_init($url);
        //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
        //         'Content-Type: application/json',
        //         'Content-Length: ' . strlen($data)
        //     ]);
        //     $result = curl_exec($ch);
        //     curl_close($ch);
        //     return $result;
        // }

        // public function confirm_momo()
        // {
        //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //         function execPostRequest($url, $data)
        //         {
        //             $ch = curl_init($url);
        //             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //             curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //             curl_setopt(
        //                 $ch,
        //                 CURLOPT_HTTPHEADER,
        //                 array(
        //                     'Content-Type: application/json',
        //                     'Content-Length: ' . strlen($data)
        //                 )
        //             );
        //             curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        //             curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        //             $result = curl_exec($ch);
        //             curl_close($ch);
        //             return $result;
        //         }
        
        //         $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        //         $partnerCode = 'MOMOBKUN20180529';
        //         $accessKey = 'klm05TvNBzhg7h7j';
        //         $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        //         $orderInfo = "Thanh toán qua MoMo ATM";
        //         $amount = intval(100000); // Đảm bảo số nguyên
        //         $orderId = time() . "";
        //         $redirectUrl = "http://localhost:8080/LUXURY_SPORTS/Cart";
        //         $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
        //         $extraData = "";
        
        //         $requestId = time() . "";
        //         $requestType = "payWithATM";
        //         $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        //         $signature = hash_hmac("sha256", $rawHash, $secretKey);
        
        //         $data = array(
        //             'partnerCode' => $partnerCode,
        //             'partnerName' => "Test",
        //             "storeId" => "MomoTestStore",
        //             'requestId' => $requestId,
        //             'amount' => $amount,
        //             'orderId' => $orderId,
        //             'orderInfo' => $orderInfo,
        //             'redirectUrl' => $redirectUrl,
        //             'ipnUrl' => $ipnUrl,
        //             'lang' => 'vi',
        //             'extraData' => $extraData,
        //             'requestType' => $requestType,
        //             'signature' => $signature
        //         );
        
        //         $result = execPostRequest($endpoint, json_encode($data));
        //         $jsonResult = json_decode($result, true);

        //         // $jsonResult  = json_success($result, true);
                
        //         // Ghi log dữ liệu trả về từ MoMo
        //         // error_log(print_r($jsonResult, true), 3, "/path/to/momo-error.log");
                
        //         // Kiểm tra phản hồi
        //         if (isset($jsonResult['payUrl'])) {
        //             header('Location: ' . $jsonResult['payUrl']);
        //         } else {
        //             echo "Lỗi khi kết nối MoMo: " . ($jsonResult['message'] ?? 'Không xác định');
        //             error_log("Lỗi MoMo: " . print_r($jsonResult, true), 3, "/path/to/momo-error.log");
        //         }
                
        //     }
        // }
        
    }
?>
