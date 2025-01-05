<?php
class HomeAdmin extends Controller
{
    public $ProductModel;
    public $UserModel;
    public function __construct() {
        $this->ProductModel = $this->model('ProductModel');
        $this->UserModel = $this->model('UserModel');
    }
    public function show() {
        if(!isset($_SESSION['admin_id'])) {
            header('Location:/LUXURY_SPORTS/Login');
        }
        $products = $this->ProductModel->getProduct();
        $users = $this->UserModel->getAllUser();
        $admin = $this->UserModel->getUserbyID($_SESSION['admin_id']);
        
        $this->view('admin', [
            'Admin' => $admin,
            'Product' => $products,
            'User' => $users,
            'Page' => 'admin/DashBoard'
        ]);
    }

    public function manageUser() {
        $this->view('admin', [
            'Page' => 'admin/ManageUser',
        ]);
    }

    public function getAllUser() {
        if(isset($_POST['datasend'])) {
            $users = $this->UserModel->getAllUser();
            $table = '<table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Action</th>
                </tr>
            </thead>';
            $number = 1;
            if (mysqli_num_rows($users) > 0) {
                while ($row = mysqli_fetch_assoc($users)) {
                    $id = $row['ID'];
                    $name = $row['UserName'];
                    $email = $row['EmailAddress'];
                    $password = $row['Password'];
                    $table .= '<tr>
                                <td>' . $number . '</td>
                                <td>' . $name . '</td>
                                <td>' . $email . '</td>
                                <td><input type="password" value="<?php echo '.$password .'?>" readonly style = "border: none; outline: none; background: transparent; width: 100%;"></td>
                                <td>
                                    <button class = "btn btn-dark" data-bs-toggle="modal" data-bs-target="#update" onclick="updateUser('.$id.')">Update</button>
                                    <button class = "btn btn-danger" onclick="deleteUser('.$id.')">Delete</button>
                                </td>
                                </tr>';
                    $number++;
                }
            } else {
                $table .= '<tr><td colspan="4">No data available</td></tr>';
            }
            $table .= '</table>';
            echo $table;
        }
    }


    public function createUser() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // check username
        if($this->UserModel->checkUsername($name)) {
            echo json_encode(['success'  => false, 'message' => 'Username already exists']);
            exit();
        }

        // check if the user already exists
        if($this->UserModel->checkEmail($email)) {
            echo json_encode(['success'  => false, 'message' => 'Email already exists']);
            exit();
        }

        // excute
        $this->UserModel->createUser($name, $email, md5($password));
    }
    // delete user
    public function deleteUser() {
        $id = $_POST['id'];
        $this->UserModel->deleteUser($id);
    }
    // get infor of user before
    public function getInfor() {
        if($_POST['id']) {
            $userID = $_POST['id'];
            $result = $this->UserModel->getUserbyID($userID);
            if($result) {
                echo json_encode($result);
            } else {
                echo json_encode(["error" => "User not found"]);
            }
        } else {
            echo json_encode(["error" => "ID is required"]);
        }
    }

    // update user
    public function updateUser() {
        if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
            $userID = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            if(!isset($_POST['password'])) {
                echo json_encode(['success'  => false, 'message' => 'Password is required']);
                exit();
            }
            $password = $_POST['password'];
            $hashPass = md5($password);
            $this->UserModel->updateInforUser($userID, $name, $email, $hashPass);
        }
    }

    // Manage Product
    public function manageProduct() {
        $this->view('admin', [
            'Page' => 'admin/ManageProduct',
        ]);
    }
    // get all product
    public function getAllProduct() {
        $products = $this->ProductModel->getProduct();
        if (isset($_POST['datasend'])) {
            $table = '<table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';
            
            $number = 1;
    
            if (!empty($products)) {
                foreach ($products as $row) {
                    $id = $row['ID'];
                    $image = $row['Image'];
                    if (strpos($image, 'public/images/') === false) {
                        $image = 'public/images/' . $image . '.png';
                    }                
                    $name = htmlspecialchars($row['Name']);
                    $description = htmlspecialchars($row['Description']);
                    $quantity = $row['Qty_in_stock'];
                    $price = $row['Price'];
                    
                    $table .= '<tr>
                                <td>' . $number . '</td>
                                <td><img src="' . $image . '" alt="Product Image" style="max-width: 50px;"></td>
                                <td>' . $name . '</td>
                                <td class="description">' . $description . '</td>
                                <td>' . $quantity . '</td>
                                <td>' . $price . '</td>
                                <td>
                                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#update" onclick="updateProduct(' . $id . ')">Update</button>
                                    <button class="btn btn-danger" onclick="deleteProduct(' . $id . ')">Delete</button>
                                </td>
                            </tr>';
                    $number++;
                }
            } else {
                $table .= '<tr><td colspan="7" class="text-center">No data available</td></tr>';
            }
    
            $table .= '</tbody></table>';
            echo $table;
        }
    }

    // create product
    public function createProduct() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = $_POST['category'];
            // get categoryID
            $categoryID = $this->ProductModel->getCategoryID($category);
            $name = $_POST['name'] ?? '';
            $des = $_POST['description'] ?? '';
            $qty = $_POST['quantity'] ?? 1;
            $price = $_POST['price'] ?? 0;
            if(isset($_FILES['image'])) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $file_name = $_FILES['image']['name'];
                $uploadFolder = 'public/images/';

                $dest_path = $uploadFolder . $file_name;
                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                    echo json_encode(['success' => true, 'message' => 'Updated the product successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error moving the uploaded file']);
                    exit();
                }
            }
            // create
            $result = $this->ProductModel->createProduct($name, $des, $price, $dest_path, $categoryID, $qty);
            if($result) {
                echo json_encode(['success' => true, 'message' => 'Product created successfully']);
            }
        }
    }
    // delete product
    public function deleteProduct() {
        $id = $_POST['id'];
        $result = $this->ProductModel->deleteProduct($id);
        if($result) {
            echo json_encode(['success' => true, 'message' => 'Product deleted successfully']);
        }else {
            echo json_encode(['success' => false, 'message' => 'Error deleting product']);
        }
    }
    // product infor
    public function productInfo() {
        $id = $_POST['id'];
        $result = $this->ProductModel->getProduct($id);
        if(!empty($result)) {
            echo json_encode($result);
        }else {
            echo json_encode(['success' => false, 'message' => 'Product not found']);
        }
    }
    // update product
    public function updateProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $category = $_POST['category'];
            // get categoryID
            $categoryID = $this->ProductModel->getCategoryID($category);
            $name = $_POST['name'] ?? '';
            $des = $_POST['description'] ?? '';
            $qty = $_POST['quantity'] ?? 1;
            $price = $_POST['price'] ?? 0;
    
            $dest_path = null;
    
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $file_name = $_FILES['image']['name'];
                $uploadFolder = 'public/images/';
                $dest_path = $uploadFolder . $file_name;
    
                if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                    $dest_path = null;
                }
            }
    
            // update
            $result = $this->ProductModel->updateProduct($id, $name, $des, $price, $dest_path, $categoryID, $qty);
    
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Product updated successfully', 'path' => $dest_path]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update product', 'path' => $dest_path]);
            }
        }
    }    


    // manage oder
    public function manageOrder() {
        $this->view('admin', [
            'Page' => 'admin/ManageOrder',
        ]);
    }
    // get all oder
    public function getAllOrder() {
        $status = 'admin';
        $products = $this->ProductModel->getOrder($status);
        if (isset($_POST['datasend'])) {
            $table = '
            <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>';

            $number = 1;
    
            if (!empty($products)) {
                foreach ($products as $row) {
                    $id = $row['ID'];
                    $image = $row['Image'];
                    if (strpos($image, 'public/images/') === false) {
                        $image = 'public/images/' . $image . '.png';
                    }                
                    $name = htmlspecialchars($row['Name']);
                    $quantity = $row['Qty'];
                    $status = $row['StatusName'];
                    $userName = $row['UserName'];
                    $total = $row['Total'];
                    
                    $table .= '<tr data-id="' . $id . '">
                            <td>' . $number . '</td>
                            <td class="userName">' . $userName . '</td>
                            <td><img src="' . $image . '" alt="Product Image" style="max-width: 50px;"></td>
                            <td>' . $name . '</td>
                            <td>' . $quantity . '</td>
                            <td>$' . $total . '</td>
                            <td class="status">' . $status . '
                                <span onclick="changeStatus(' . $id . ')">change status</span>
                            </td>
                    </tr>';
                    $number++;
                }
            } else {
                $table .= '<tr><td colspan="7" class="text-center">No data available</td></tr>';
            }
    
            $table .= '</tbody></table>';
            echo $table;
        }
    }

    public function updateStatus() {
        $data = file_get_contents('php://input');
        
        // Kiểm tra xem dữ liệu có tồn tại không
        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'No data received']);
            return;
        }

        // Giải mã JSON và kiểm tra xem nó có hợp lệ không
        $data = json_decode($data, true);

        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Data not valid']);
            return;
        }

        // Kiểm tra xem các trường cần thiết có tồn tại trong dữ liệu không
        if (!isset($data['id'], $data['status'], $data['userName'])) {
            echo json_encode(['success' => false, 'message' => 'Missing required data fields']);
            return;
        }

        // Lấy giá trị và gọi phương thức updateStatus
        $productID = $data['id'];
        $status = $data['status'];
        $userName = $data['userName'];
        
        // Cập nhật trạng thái
        $result = $this->ProductModel->updateStatus($productID, $status, $userName);
        if (!$result) {
            echo json_encode(['success' => false, 'message' => 'Error']);
        } else {
            echo json_encode(['success' => true, 'message' => 'Updated Successfully']);
        }
    }

    public function getPendingConfirmationOrder() {
        $data = file_get_contents('php://input');
        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'No data received']);
            return;
        }
    
        $status = 'Pending Confirmation';
        $products = $this->ProductModel->getOrder($status);
        $container = '<div class="container"></div>';
    
        if (!empty($products)) {
            $container = '';
            $userOrders = [];
    
            foreach ($products as $row) {
                $userName = $row['UserName'];
                $createdAtFull = $row['createdAt'];
                $createdAt = substr($createdAtFull, 0, 16); 
                $id = $row['ID'];
                $image = $row['Image'];
                $name = htmlspecialchars($row['Name']);
                $quantity = $row['Qty'];
                $price = $row['Price'];
    
                if (!isset($userOrders[$userName][$createdAt])) {
                    $userOrders[$userName][$createdAt] = [
                        'amount' => 0,
                        'products' => []
                    ];
                }
    
                $userOrders[$userName][$createdAt]['amount'] += $price * $quantity;
                $userOrders[$userName][$createdAt]['products'][] = [
                    'id' => $id,
                    'image' => $image,
                    'name' => $name,
                    'quantity' => $quantity,
                    'price' => $price
                ];
            }
            foreach ($userOrders as $userName => $ordersByDate) {
                foreach ($ordersByDate as $createdAt => $order) {
                    $collapseId = 'collapse' . md5($userName . $createdAt);
                    $table = '
                    <table class="table table-hover collapse" id="' . $collapseId . '" style="margin-top: 20px;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>';
    
                    foreach ($order['products'] as $product) {
                        $image = $product['image'];
                        if (strpos($image, 'public/images/') === false) {
                            $image = 'public/images/' . $image . '.png';
                        }
    
                        $table .= '<tr data-id="' . $product['id'] . '">
                                    <td><img src="' . $image . '" alt="Product Image" style="max-width: 50px;"></td>
                                    <td>' . $product['name'] . '</td>
                                    <td>' . $product['quantity'] . '</td>
                                    <td>$' . $product['price'] . '</td>
                                </tr>';
                    }
    
                    $table .= '<tfoot>
                    <tr>
                        <td colspan="4" style="width: 100%;">
                            <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
                            <button class="btn btn-dark" 
                                onclick="handleAction(\'confirm\', \'' . $collapseId . '\', \'' . $userName . '\')">Confirm</button>
                            <button class="btn btn-danger" 
                                onclick="handleAction(\'cancel\', \'' . $collapseId . '\', \'' . $userName . '\')">Cancel</button>
                            </div>
                        </td>
                    </tr>
                </tfoot>';
    
                    $table .= '</tbody></table>';
                    $container .= '<div class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">
                        <strong>' . $userName . '</strong> has made an online transaction of <strong>$' . $order['amount'] . '</strong> on <strong>' . $createdAt . '</strong></div>';
                    $container .= $table;
                }
            }
        } else {
            $container = '<div class="no-orders">No pending confirmation order found.</div>';
        }
    
        echo $container;
    }
    
    // logout
    public function unsetAdmin() {
        unset($_SESSION['admin_id']);
        echo json_encode(['success' => true, 'message' => 'Admin logged out']);
    }
}