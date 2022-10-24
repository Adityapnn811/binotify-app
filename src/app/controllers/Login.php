<?php
    class Login extends Controller {
        // method default adalah index (harus ada)
        public function index(){
            $this->view('templates/header');
            $this->view('login/index');
            $this->view('templates/footer');
        }

        // Tambahin page/api di bawah
        // function __construct(){
        //     parent::__construct();
        // }


        function run(){
		    $this->model("Login_model")->run();
	    }

        function logout(){
            session_destroy();
            header('location: '.'/home/index');
            exit;
        }
    }
?>