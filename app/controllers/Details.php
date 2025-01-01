<?php
class Details extends Controller
{
    public $ProductModel;

    // Hàm này luôn được khởi chạy đầu tiên khi tạo một đối tượng
    public function __construct() {
        $this->ProductModel = $this->model('ProductModel');
    }

    public function show($productID = null) {
        {
             // Kiểm tra xem người dùng đã đăng nhập chưa
            if (!isset($_SESSION['user_id'])) {
                // Xử lý khi người dùng chưa đăng nhập, ví dụ: chuyển hướng đến trang đăng nhập
                header("Location: /login");
                exit();
            }

            $userID = $_SESSION['user_id']; // Lấy ID người dùng từ session
            // Lấy dữ liệu sản phẩm hiện tại
            $result = $this->ProductModel->getProductDetail($userID, $productID);
            $product = mysqli_fetch_assoc($result);

            // Lấy danh sách sản phẩm liên quan
            $relatedProducts = [];
            if ($product && isset($product['Category_ID'])) {
                $relatedResult = $this->ProductModel->getRelatedProducts($productID, $product['Category_ID'], $userID);
                while ($row = mysqli_fetch_assoc($relatedResult)) {
                    $relatedProducts[] = $row;
                }
            } else {
                // Xử lý khi không tìm thấy sản phẩm
                $product = null;
            }

            // Truyền dữ liệu sang view
            $this->view('master', [
                'Product' => $product,
                'RelatedProducts' => $relatedProducts,
                'Page' => 'user/PageDetail'
            ]);
        }
    }
}
?>