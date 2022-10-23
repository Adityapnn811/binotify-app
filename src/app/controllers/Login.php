<?php
    class Login extends Controller {
        // method default adalah index (harus ada)
        public function index(){
            $this->view('templates/header');
            $this->view('login/index');
            $this->view('templates/footer');
        }

        // Tambahin page/api di bawah
    }
?>