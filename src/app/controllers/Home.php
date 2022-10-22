<?php
    class Home extends Controller {
        // method default adalah index (harus ada)
        public function index($username='username default'){
            $data = $this->model("User_model")->getUser();
            $this->view('templates/header');
            $this->view('home/index', $data);
            $this->view('templates/footer');
        }

        // Tambahin page/api di bawah
    }
?>