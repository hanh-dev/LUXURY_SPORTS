<?php
class Profile extends Controller 
{
    public $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    public function show() {
        // $data = $this->userModel->getUserbyID();
        $this->view('master',[
            'Page' => 'Profile'
        ]);
    }
}