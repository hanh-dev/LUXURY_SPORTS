<?php
class Product extends Controller
{
    public $ProductModel;
    // Hàm này luôn được khởi chạy đầu tiền khi tạo một đối tượng
    public function __construct() {
        $this->ProductModel = $this->model('ProductModel');
    }

    public function getAll() {
        $data = $this->ProductModel->getAll();
        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                echo "<div class='product_item'>
                        <a href='Details/show/{$row['ID']}'>
                            <div class='product_image'>
                                <img src='public/images/{$row['Image']}.png' alt=''>
                            </div>
                        </a>
                        <div class='wrapp_heart'>
                            <i class='fa-regular fa-heart'></i>
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
        }
    }


    public function searchProduct() {
            $key = $_POST['searchProduct'];
            $product = $this->ProductModel->searchProduct($key);
            if ($product) {
                while ($row = mysqli_fetch_assoc($product)) {
                    echo "<div class='product_item'>
                            <a href='Details/show/{$row['ID']}'>
                                <div class='product_image'>
                                    <img src='public/images/{$row['Image']}.png' alt=''>
                                </div>
                            </a>
                            <div class='wrapp_heart'>
                                <i class='fa-regular fa-heart'></i>
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
            }
        }
        }