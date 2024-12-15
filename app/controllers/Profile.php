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
}