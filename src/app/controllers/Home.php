<?php
    class Home extends Controller {
        // method default adalah index (harus ada)
        public function index($username='username default'){
            $this->view('templates/header');
            $this->view('home/index');
            $this->view('templates/footer');
        }

        // Tambahin page/api di bawah
    }
?>