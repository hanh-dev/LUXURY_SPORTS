<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
use Cloudinary\Cloudinary;

// Enviroment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$cloudinaryCloudName = $_ENV['CLOUDINARY_CLOUD_NAME'];
$cloudinaryApiKey = $_ENV['CLOUDINARY_API_KEY'];
$cloudinaryApiSecret = $_ENV['CLOUDINARY_API_SECRET'];

class UploadImage extends Controller {
    public $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    public function updateImage() {
        $cloudinaryCloudName = $_ENV['CLOUDINARY_CLOUD_NAME'];
        $cloudinaryApiKey = $_ENV['CLOUDINARY_API_KEY'];
        $cloudinaryApiSecret = $_ENV['CLOUDINARY_API_SECRET'];
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $cloudinaryCloudName,
                'api_key' => $cloudinaryApiKey,
                'api_secret' =>$cloudinaryApiSecret,
            ],
        ]);

        if (isset($_FILES['image'])) {
            $file = $_FILES['image']['tmp_name'];
        
            try {
                $uploadResult = $cloudinary->uploadApi()->upload(
                    $file, ['folder' => 'user_picture/']
                );

                $result = $this->userModel->updateImageUser($_SESSION['user_id'],$uploadResult['secure_url']);

                if ($result) {
                    echo json_encode(['success' => true, 'imageUrl' => $uploadResult['secure_url']]);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No file uploaded.']);
        }
    }
}
