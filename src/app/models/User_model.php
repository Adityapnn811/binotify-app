<?php
    class User_model {
        private $table = 'User';
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getAllUser($pageNow, $recordPerPage = 10) {
            $this->db->query("SELECT * FROM $this->table");
            $result = $this->db->allResult();
            $totalRecord = count($result);
            $maxPage = (int) ceil($totalRecord/$recordPerPage);
            $offset = $recordPerPage * ($pageNow-1);
            $paginatedRes = array_slice($result, $offset, $recordPerPage);
            return array($paginatedRes, $maxPage);
        }

        public function checkUsername($username) {
            $this->db->query("SELECT * FROM $this->table WHERE username = :username");
            $this->db->bind('username', $username);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function checkEmail($email) {
            $this->db->query("SELECT * FROM $this->table WHERE email = :email");
            $this->db->bind('email', $email);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }
?>