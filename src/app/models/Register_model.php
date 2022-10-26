<?php
    class Register_model {
        private $table = 'User';
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function check_user($username,$email){

            
            $this->db->query("SELECT * FROM `User` WHERE username=:username OR email=:email");
            $this->db->bind(':username', $username);
            $this->db->bind(':email', $email);
            $this->db->execute();

            $count = $this->db->rowCount();
            
            return $count;
        }
        
        public function insert_user($data){
            $email = $data["email"];
            $username = $data["username"];
            $password = password_hash($data["password"], PASSWORD_BCRYPT);

            try{
                $this->db->query("INSERT INTO `User`(email, password, username, is_admin) VALUE (:email, :password, :username, 0)");
                $this->db->bind(':email', $email);
                $this->db->bind(':username', $username);
                $this->db->bind(':password', $password);
    
                $this->db->execute();

                return true;

            } catch (PDOException $e){
                return false;
            }


            // if ($this->db->execute()){
            //     return true;
            // }else{

            //     return false;
            // }
        }
    }
?>