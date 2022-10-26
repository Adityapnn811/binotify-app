<?php
    class Register extends Controller {
        // method default adalah index (harus ada)
        public function index(){
            $this->view('templates/header');
            $this->view('register/index');
            $this->view('templates/footer');
        }

        // Tambahin page/api di bawah
        function signup(){
            $username=$_POST['username'];
            $confirm_password=$_POST['confirm_password'];
            $email=$_POST['email'];
            $password=$_POST['password'];

            if($password == $confirm_password){
                $count=$this->model("Register_model")->check_user($username,$email);
                
                if($count > 0){
                    $data = array(
                        'status' => '400',
                        'error_msg' => 'username or email already exist',
                    );
                }else{
                    $data = array(
                        'username' =>$_POST['username'],
                        'email' =>$_POST['email'],
                        'password' =>$_POST['password'],
                        'status' => '500',
                        'error_msg' => '',
                    );
    
                    $success = $this->model("Register_model")->insert_user($data);
    
                    if($success){
                        $data["status"] = 200;
                    }else{
                        $data["status"] = 500;
                        $data["error_msg"] = "gagal register";
                    }
                }
            }else{
                //ga sama
                $data = array(
                    'status' => '400',
                    'error_msg' => 'password sm confirm password beda',
                );
            }


            $this->view('templates/headerRegister', $data);
            $this->view('register/index', $data);
            $this->view('templates/footer');
        }

    }

?>