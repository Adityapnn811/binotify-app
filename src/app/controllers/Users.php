<?php
    class Users extends Controller {
        // method default adalah index (harus ada)
        public function index(){
            $headerData["URLRedirect"] = "/home";
            // $this->view('templates/headerWithRedirect', $headerData);
            $this->view('templates/header');
            $this->view('users/index');
            $this->view('templates/footer');
        }
    }
?>