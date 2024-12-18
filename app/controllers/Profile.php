<?php
class Profile extends Controller 
{
    public $userModel;
    public function __construct()
    {
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
// Logout
    public function unsetUser() {
        unset($_SESSION['user_id']);
        echo json_encode(['success' => true, 'message'=>'Logged out successfully.']);
    }
}