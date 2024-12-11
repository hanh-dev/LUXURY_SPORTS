<?php
    class App {
        //http://localhost/CLINIC_YB/Home/SayHi/1/2/3
        protected $controller = "Home";
        protected $action = "show";
        protected $params = [];
        function __construct() {
            $arr = $this->UrlProcess();

            //Controller handling
            if(file_exists("./app/controllers/".$arr[0].".php")){
                $this->controller = $arr[0];
                unset($arr[0]);
            }
            require_once("./app/controllers/".$this->controller.".php");
            // Create an instance of the controller
            $controllerInstance = new $this->controller();

            //Action handling
            if(isset($arr[1])) {
                if(method_exists($controllerInstance, $arr[1])){
                    $this->action = $arr[1];
                }
            }
            unset($arr[1]);

            //Params handling
            $this->params = $arr?array_values($arr): [];
            call_user_func_array([$controllerInstance, $this->action], $this->params);
        }
        function UrlProcess() {
            //Home/SayHi/1/2/3
            if(isset($_GET['url'])) {
                $url = $_GET['url'];
                $url = filter_var(trim($url, '/'));
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>