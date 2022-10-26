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
            $user_name=$_POST['user_name'];
            $email_id=$_POST['email_id'];
            $password=$_POST['password'];

            $count=$this->model("Register_model")->check_user($user_name,$email_id);

            if($count > 0){
                echo 'This User Already Exists';
            }else{
                $data = array(
                'id' =>null,
                'user_name' =>$_POST['user_name'],
                'email_id' =>$_POST['email_id'],
                'password' =>$_POST['password']
                );
                $this->model->insert_user($data);
            }
            header('location:index');
            }

    }

?>