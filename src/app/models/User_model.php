<?php
    Class User_model {
        private $dbh;
        private $query;

        public function __construct() {
            getenv('MYSQL_DBHOST') ? $db_host=getenv('MYSQL_DBHOST') : $db_host='localhost';
            getenv('MYSQL_DBUSER') ? $db_user=getenv('MYSQL_DBUSER') : $db_user='root';
            getenv('MYSQL_DBPASS') ? $db_pass=getenv('MYSQL_DBPASS') : $db_pass='aditya962';
            getenv('MYSQL_DBNAME') ? $db_name=getenv('MYSQL_DBNAME') : $db_name='binotifydb';
            getenv('MYSQL_DBPORT') ? $db_port=getenv('MYSQL_DBPORT') : $db_port='3306';

            try {
                $this->dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            } catch (PDOException $e) {
                die($e->get_message());
            }
        }

        public function getUser() {
            $this->query = $this->dbh->prepare("SELECT * FROM User LIMIT 1");
            $this->query->execute();
            return $this->query->fetch(PDO::FETCH_ASSOC);
        }
    }
?>