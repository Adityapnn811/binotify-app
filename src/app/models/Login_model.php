<?php
    class Login_model {
        private $table = 'User';
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function run(){
            
            $username=$_POST['user_name'];
            $password=$_POST['password'];

            $this->db->query("SELECT * FROM `User` WHERE username=:username");
            $this->db->bind(':username', $username);
            $this->db->execute();
            
            $count = $this->db->rowCount();
            if($count<1){
                // Kosong, tidak ada user dg username itu
            } else{
                $user = $this->db->singleResult();
            
                if (password_verify($password, $user["password"])) {
                    // password sama
                    $_SESSION["username"] = $user["username"];
                    $_SESSION["is_admin"] = $user["is_admin"];
                    header('location: '.'/home/index');
                } else {
                    // password beda
                    header('location: '.'search/index');
                }
            }

            
            
            
        }
    }
?>