<?php
    class Users extends Controller {
        // method default adalah index (harus ada)
        public function index(){
            $headerData["URLRedirect"] = "/home";
            $this->view('templates/headerRedirectWithoutBody', $headerData);
            $this->view('users/index');
            $this->view('templates/footerWithoutBody');
        }

        public function getUsers($page) {
            // page dipake buat paginasi data
            $data["users"] = $this->model("User_model")->getAllUser($page, 20);
            $this->view('users/getUsers', $data);
        }
    }
?>