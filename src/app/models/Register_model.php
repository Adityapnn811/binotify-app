<?php
    class Register_model {
        private $table = 'User';
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function check_user($username,$email){

            // $this->db->query("SELECT * FROM `User` WHERE username=:username");
            // $this->db->bind(':username', $username);
            // $this->db->execute();
            
            // $count = $this->db->rowCount();
            // $user = $this->db->singleResult();
            
            
            // $result= $this->db->select("SELECT * FROM `User` WHERE user_name = '".$user_name."' OR email_id = '".$email_id."'");
            // $count = count($result);
            
            $this->db->query("SELECT * FROM `User` WHERE username=:username OR email=:email");
            $this->db->bind(':username', $username);
            $this->db->bind(':email', $email);
            $this->db->execute();

            $count = $this->db->rowCount();
            

            return $count;
        }
        
        public function insert_user($data){
            $this->db->insert('register', $data);
        }
    }
?>