<?php
    require_once __DIR__ . '/../../vendor/autoload.php';
    use Stripe\Stripe;
    class Cart extends Controller
    {
        public $CartModel;
        public $productModel;
        public $userModel;

        public function __construct() {
            $this->CartModel = $this->model('CartModel');
            $this->productModel = $this->model('ProductModel');
            $this->userModel = $this->model('UserModel');
        }

        public function show() {
            $productCart = $this->CartModel->getProductCart();

            $this->view('master', [
                'ProductCart' => $productCart,
                'Page' => 'user/Cart'
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

        public function checkout() {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
        
            // Lấy sản phẩm từ giỏ hàng hoặc từ dữ liệu được gửi lên
            if (!empty($data['selectedProducts']) && is_array($data['selectedProducts'])) {
                $productsToCheckout = $data['selectedProducts'];
            } else {
                $productsToCheckout = $this->CartModel->getProductCart(); // Giả sử `getProductCart()` trả về mảng sản phẩm
            }
            // Tính tổng giá và hiển thị nội dung
            $totalPrice = 0;
            echo "<div id='checkout'>
                <div class='container'>
                    <h2 class='heading-title'>CHECKOUT</h2>
                    <div class='container-small'>
                        <div class='form-left'>
                            <h4 class='heading-billing'>Billing address</h4>
                            <form action='' id='frm-infor' onsubmit='validateForm(event)'>
                                <div class='user-Name'>
                                    <input type='text' id ='name' class='name' name='name' placeholder='User name' required>
                                </div>
                                <div class='user-Adress'>
                                    <input type='text' id='address' class='address' name='address' placeholder='Address' required>
                                </div>
                                <div class='user-Phone'>
                                    <input type='text' id='phone' class='phone' name='phone' placeholder='Phone' required>
                                </div>
                                <div id='error-message' class='error-message' style='display: none;'>
                                    <span>Vui lòng điền đầy đủ thông tin.</span>
                                </div>
                            </form>
                            <div class='return-order'>
                                <button type='button' class='return'><a href='/LUXURY_SPORTS/Cart/show'><i class='fa-solid fa-arrow-left'></i>Return to cart</a></button>
                                <button onclick='payment()'>Pay</button>
                            </div>
                        </div>
                        <div class='form-right'>
                            <h4 class='heading-order'>Order Summary</h4>
                            <div class='order-summary'>";
                            // Hiển thị danh sách sản phẩm trong giỏ hàng
                            if (!empty($productsToCheckout) && is_array($productsToCheckout)) {
                                foreach ($productsToCheckout as $product) {
                                    $productPrice = $product['Price'] * $product['Qty'];
                                    $totalPrice += $productPrice;
        
                                    echo "<div class='product-item' data-id='{$product['ID']}'>
                                        <div class='box-quantity'>{$product['Qty']}</div>
                                        <div class='image'>
                                            <img src='public/images/{$product['Image']}.png' alt='{$product['Name']}'>
                                        </div>
                                        <div class='tile-price'>
                                            <p class='title'>{$product['Name']}</p>
                                            <span class='price'>\${$product['Price']}</span>
                                        </div>
                                        <div class='total'>
                                            <span class='total-price'>\${$productPrice}</span>
                                        </div>
                                    </div>";
                                }
                            } else {
                                echo "<p>No products in cart.</p>";
                            }
                            echo "</div>
                            <div class='total-order'>
                                <h5 class='heading-total'>TOTAL</h5>
                                <span class='total' id='total'>\${$totalPrice}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
        }        

        // checkout stripe
        public function checkoutStripe()
        {
            header('Content-Type: application/json');
            try {
                $input = json_decode(file_get_contents('php://input'), true);
                $total = isset($input['total']) ? $input['total'] : 0;
        
                if (!$total || $total <= 0) {
                    echo json_encode(['success' => false, 'message' => 'Invalid total amount']);
                    return;
                }
                $stripe_secret_key = "sk_test_51QZrQoJpm6tI6IlWAEWzV5YkTzi9HAdPawp3Myfe70206SxU1ru4zRKwgdDLwmahJkVmBr8COuuTgs9SvrbJgcrn00SXJH7JX6";

                // Đặt khóa API
                Stripe::setApiKey($stripe_secret_key);
                // Tạo session Stripe Checkout:
                $session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Total'],
                            'unit_amount' => $total * 100,
                        ],
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'success_url' => 'http://localhost/LUXURY_SPORTS/Home/show',
                ]);
        
                echo json_encode(['success' => true, 'url' => $session->url]);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
        public function updateStatus($userName = null) {
            try {
                // Lấy và kiểm tra dữ liệu đầu vào
                $data = json_decode(file_get_contents('php://input'), true);
                if (!$data || !isset($data['productIds'])) {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'Invalid data']);
                    exit();
                }
        
                $action = $data['action'] ?? null;
                $productIDs = $data['productIds'];
                if($action!= null) {
                    $result = $this->CartModel->updateOrderStatus($productIDs, $action);
                }else {
                    $result = $this->CartModel->updateOrderStatus($productIDs);
                }
        
                // Lấy thông tin user ID nếu username tồn tại
                $userID = null;
                if ($userName !== null) {
                    $userName = htmlspecialchars($userName, ENT_QUOTES, 'UTF-8');
                    $userID = $this->userModel->getUserID($userName);
                }
        
                // Trả kết quả
                if ($result) {
                    http_response_code(200);
                    echo json_encode([
                        'success' => true,
                        'message' => 'Order status updated successfully',
                        'userID' => $userID
                    ]);
                } else {
                    http_response_code(500);
                    echo json_encode([
                        'success' => false,
                        'message' => 'Failed to update order status'
                    ]);
                }
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }        

        // quantity pending confirmation
        public function pendingQuantity() {
            if(isset($_SESSION['admin_id'])) {
                $result = $this->CartModel->getPendingQuantity();
                echo '<div>'.$result.'</div>';
            }
        }
    }
?>
