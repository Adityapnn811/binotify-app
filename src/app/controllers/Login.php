<?php
    class Login extends Controller {
        // method default adalah index (harus ada)
        public function index(){
            // $data = [user => hasil query, count => int]
            $this->view('templates/headerLogin');
            $this->view('login/index');
            $this->view('templates/footer');
        }
        
        // Tambahin page/api di bawah
        
        function run(){
            $data["status"] = 504;
            $data["username"] = "";
            $data["is_admin"] = false;
            $data["error"] = "";
            $passwordInput = $_POST["password"];
            $rawData = $this->model("Login_model")->run();
            $count = $rawData[1];
            
            // Cek apakah user ketemu
            if ($count < 1 ){
                $data["status"] = 400;
                $data["username"] = "";
                $data["is_admin"] = false;
                $data["error"] = "Username atau password Anda salah";
            }else{
                $user = $rawData[0];
                if (password_verify($passwordInput, $user["password"])) {
                    // password sama
                    $data["status"] = 200;
                    $data["username"] = $user["username"];
                    $data["is_admin"] = $user["is_admin"];
                    $data["error"] = "";
                }else{
                    //password salah
                    $data["status"] = 400;
                    $data["username"] = "";
                    $data["is_admin"] = false;
                    $data["error"] = "Username atau password Anda salah";
                }
            }

            // $data = [user => hasil query, count => int]
            $this->view('templates/headerLogin', $data);
            $this->view('login/index', $data);
            $this->view('templates/footer');
	    }

        function logout(){
            session_destroy();
            header('location: /home');
            exit;
        }
    }
?>