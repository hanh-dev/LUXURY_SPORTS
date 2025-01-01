<?php
class Product extends Controller
{
    public $ProductModel;
    // Hàm này luôn được khởi chạy đầu tiền khi tạo một đối tượng
    public function __construct() {
        $this->ProductModel = $this->model('ProductModel');
    }

    public function getAll() {
        $userID = $_SESSION['user_id'] ?? null; 
        $data = $this->ProductModel->getAll($userID);
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                if (strpos($row['Image'], 'public/images/') === false) {
                    $row['Image'] = 'public/images/' . $row['Image'] . '.png';
                }   
                $isSoldOut = $row['Qty_in_stock'] <= 0;
                $isFavorite = $row['isFavorite'];
                echo "<div class='product_item'>
                    <a href='Details/show/{$row['ID']}'>
                        <div class='product_image'>
                            <img src=".$row['Image']." alt=''>
                        </div>
                    </a>
                    <div class='wrapp_heart'>
                        <i class='" . ($isFavorite ? "fa-solid fa-heart" : "fa-regular fa-heart") . "' 
                            onclick='" . ($isFavorite ? "removeProductFromWishList({$row['ID']})" : "addToWishList({$row['ID']})") . "'>
                        </i>
                    </div>
                    <div class='wrapp_add'>
                       <span 
                            " . ($isSoldOut ? "" : "onclick='addToCart({$row['ID']})'") . "x
                            class='" . ($isSoldOut ? "disabled" : "") . "'
                        >
                            " . ($isSoldOut ? "Sold Out" : "Add to Cart") . "
                       </span>
                    </div>
                    <div class='product_name'>
                        <span>{$row['Name']}</span>
                    </div>
                    <div class='product_price'>
                        <span>\${$row['Price']}</span>
                    </div>
                </div>";
            }            
        }
    }


    public function searchProduct() {
            $key = $_POST['searchProduct'];
            $product = $this->ProductModel->searchProduct($key);
            if ($product && $product->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($product)) {
                    if (strpos($row['Image'], 'public/images/') === false) {
                        $row['Image'] = 'public/images/' . $row['Image'] . '.png';
                    }
                    echo "<div class='product_item'>
                            <a href='Details/show/{$row['ID']}'>
                                <div class='product_image'>
                                    <img src=".$row['Image']." alt=''>
                                </div>
                            </a>
                            <div class='wrapp_heart'>
                                <i class='" . ($isFavorite ? "fa-solid fa-heart" : "fa-regular fa-heart") . "' 
                                     onclick='" . ($isFavorite ? "removeProductFromWishList({$row['ID']})" : "addToWishList({$row['ID']})") . "'>
                                </i>
                        </div>
                            <div class='wrapp_add'>
                                <span onclick='addToCart({$row['ID']})'>Add to cart</span>
                            </div>
                            <div class='product_name'>
                                <span>{$row['Name']}</span>
                            </div>
                            <div class='product_price'>
                                <span>\${$row['Price']}</span>
                            </div>
                          </div>";
                }
            } else  {
                echo "<div>Not Found</div>";
            }
    }

    public function checkout() {
        echo '<div> Check out Page</div>
        <div> Check out Page</div>
        <div> Check out Page</div>
        <div> Check out Page</div>';
    }
}