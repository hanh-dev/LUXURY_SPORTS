<?php
class Profile extends Controller 
{
    public $userModel;
    public $cartModel;
    public function __construct()
    {
        $this->cartModel = $this->model('CartModel');
        $this->userModel = $this->model('UserModel');
    }

    public function show() {
        $id = $_SESSION['user_id'];
        $data = $this->userModel->getUserbyID($id);
        $this->view('master',[
            'Page' => 'Profile',
            'data' => $data
        ]);
    }

    public function update() {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'User is not logged in.']);
            exit;
        }        
        $id = $_SESSION['user_id'];
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        $result = $this->userModel->updateUser($id, $data['name'], $data['email'], $data['phone']);
    
        if ($result) {
            $_SESSION['update'] = true;
            echo json_encode(['success' => true, 'message' => 'Profile updated successfully!']);
        } else {
            $_SESSION['update'] = false;
            echo json_encode(['success' => false, 'message' => 'Failed to update profile.']);
        }
    }
    // Account Detail Page
    public function accountDetailPage() {
        $id = $_SESSION['user_id'];
        $user = $this->userModel->getUserbyID($id);
        $name = $user['Name'];
        $email = $user['EmailAddress'];
        $phone = isset($user['PhoneNumber'])?$user['PhoneNumber']:'';
        echo '<div class="right_hold">
                <div class="name">
                    <label for="name">Display Name</label>
                    <input type="text" value="'.$name.'" readonly id="name">
                </div>
                <div class="email">
                    <label for="email">Email Address</label>
                    <input type="email" value="'.$email.'" readonly id="email">
                </div>
                <div class="phoneNumber">
                    <label for="phoneNumber">PhoneNumber</label>
                    <input type="text" value="'.$phone.'" readonly id="phone">
                </div>
            </div>
            <div class="form_btn">
                <button id="edit" type="button">Edit</button>
                <button id="save" type="button">Save Changes</button>
            </div>';
    }
    // Order Page
    public function orderPage() {
        $productCart = $this->cartModel->getProductCart();
        
        echo '<div class="cartformpage">
            <div class="statusType">
                <h6>Status</h6>
                <div>
                    <select id="status">
                        <option value="All">All</option>
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="shipped">Shipped</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
                <table class="cart cart-hidden" id="cart">
                    <thead>
                        <tr>
                            <th class="image">Image</th>
                            <th class="product-Name">Name</th>
                            <th class="product-Name">Status</th>
                            <th class="total">Total</option>
                        </select>
                    </div>
                </div>
                <tbody id="table_body">';
            
            if (!empty($productCart)) {
                foreach ($productCart as $product) {
                    $imagePath = 'public/images/' . htmlspecialchars($product['Image']) . '.png';
                    $productName = htmlspecialchars($product['Name']);
                    $status = $product['Status'];
                    $statusName = $this->cartModel->getStatus($status);
                    $productId = $product['ID'];
                    $productQty = $product['Qty'];
                    $productPrice = $product['Price'];
                    $productTotal = $productPrice * $productQty;
        
                    echo '<tr class="item" data-id="' . $productId . '">
                    <td class="image">
                        <img src="' . $imagePath . '" alt="' . $productName . '" class="product-img">
                    </td>
                    <td class="product-Name">
                        <span class="text-hover">' . $productName . '</span>
                    </td>
                    <td class="product-Status">
                        <span class="text-hover">' . $statusName . '</span>
                    </td>
                    <td class="total">$' . $productTotal . ' for ' . $productQty . ' ' . (($productQty > 1) ? 'items' : 'item') . '</td>
                </tr>';        
                }
            } else {
                echo '<tr><td colspan="5">No products in cart.</td></tr>';
            }
        
            echo '      </tbody>
                    </table>
                </div>';
        }
        // OrderPage_Status
        public function OrderPage_Status() {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            $status = $data['status'];
            $productCartStatus = $this->cartModel->getProductCart($status);
            echo '<div class="cartformpage">
                <table class="cart cart-hidden" id="cart">
                    <thead>
                        <tr>
                            <th class="image">Image</th>
                            <th class="product-Name">Name</th>
                            <th class="product-Name">Status</th>
                            <th class="total">Total</option>
                        </select>
                    </div>
                </div>
                <tbody id="table_body">';
            
            if (!empty($productCartStatus)) {
                foreach ($productCartStatus as $product) {
                    $imagePath = 'public/images/' . htmlspecialchars($product['Image']) . '.png';
                    $productName = htmlspecialchars($product['Name']);
                    $status = $product['Status'];
                    $statusName = $this->cartModel->getStatus($status);
                    $productId = $product['ID'];
                    $productQty = $product['Qty'];
                    $productPrice = $product['Price'];
                    $productTotal = $productPrice * $productQty;
        
                    echo '<tr class="item" data-id="' . $productId . '">
                    <td class="image">
                        <img src="' . $imagePath . '" alt="' . $productName . '" class="product-img">
                    </td>
                    <td class="product-Name">
                        <span class="text-hover">' . $productName . '</span>
                    </td>
                    <td class="product-Status">
                        <span class="text-hover">' . $statusName . '</span>
                    </td>
                    <td class="total">$' . $productTotal . ' for ' . $productQty . ' ' . (($productQty > 1) ? 'items' : 'item') . '</td>
                </tr>';        
                }
            } else {
                echo '<tr><td colspan="5">No products in cart.</td></tr>';
            }
        
            echo '      </tbody>
                    </table>
                </div>';
        }
        // Logout
        public function unsetUser() {
            unset($_SESSION['user_id']);
            echo json_encode(['success' => true, 'message'=>'Logged out successfully.']);
        }
    }