<?php
    class Database {
        private $db_host = MYSQL_DBHOST;
        private $db_user = MYSQL_DBUSER;
        private $db_pass = MYSQL_DBPASS;
        private $db_name = MYSQL_DBNAME;

        private $dbh;
        private $que;

        public function __construct() {
            $option = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            $dsn = "mysql:host=$this->db_host;dbname=$this->db_name";

            try {
                $this->dbh = new PDO($dsn, $this->db_user, $this->db_pass, $option);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        public function query($query) {
            $this->que = $this->dbh->prepare($query);
        }

        public function bind($param, $value, $type = null) {
            if (is_null($type)) {
                switch (true) {
                    case is_int($value) :
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value) :
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value) :
                        $type = PDO::NULL;
                        break;
                    default :
                        $type = PDO::PARAM_STR;
                }
            }
            $this->que->bindValue($param, $value, $type);
        }

        public function execute() {
            $this->que->execute();
        }

        public function allResult() {
            $this->execute();
            return $this->que->fetchAll(PDO::FETCH_ASSOC);
        }

        public function singleResult() {
            $this->execute();
            return $this->que->fetch(PDO::FETCH_ASSOC);
        }

        public function rowCount() {
            return $this->que->rowCount();
        }
    }
?>