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
        $products = $this->ProductModel->getProduct();
        $users = $this->UserModel->getAllUser();
        $admin = $this->UserModel->getUserbyID($_SESSION['admin_id']);
        
        $this->view('admin', [
            'Admin' => $admin,
            'Product' => $products,
            'User' => $users,
            'Page' => 'DashBoard'
        ]);
    }

    public function manageUser() {
        $this->view('admin', [
            'Page' => 'ManageUser',
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
                    $name = $row['Name'];
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
            'Page' => 'ManageProduct',
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
    
    // logout
    public function unsetAdmin() {
        session_destroy();
        echo json_encode(['success' => true, 'message' => 'Admin logged out']);
    }
}