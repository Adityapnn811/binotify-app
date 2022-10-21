<?php
    class App {
        protected $controller = 'home';
        protected $method = 'index';
        protected $params = [];

        public function __construct() {
            $url = $this->parseURL();
            if (!is_null($url)) {
                // untuk controller
                if (file_exists('../app/controllers/' . $url[0] . '.php')) {
                    $this->controller = $url[0];
                    unset($url[0]);
                }

                require_once '../app/controllers/' . $this->controller . '.php';
                $this->controller = new $this->controller;
            
                // untuk method
                if (isset($url[1])) {
                    if (method_exists($this->controller, $url[1])) {
                        $this->method = $url[1];
                        unset($url[1]);
                    }
                }

                // untuk params
                if (!empty($url)) {
                    $this->params = array_values($url);
                }

            } else {
                require_once '../app/controllers/' . $this->controller . '.php';
                $this->controller = new $this->controller;
            }
            // jalankan controller dan method serta paramsnya
            call_user_func_array([$this->controller, $this->method], $this->params);
        }

        public function parseURL(){
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }

        public function connect_db() {
            getenv('MYSQL_DBHOST') ? $db_host=getenv('MYSQL_DBHOST') : $db_host='localhost';
            getenv('MYSQL_DBUSER') ? $db_user=getenv('MYSQL_DBUSER') : $db_user='root';
            getenv('MYSQL_DBPASS') ? $db_pass=getenv('MYSQL_DBPASS') : $db_pass='aditya962';
            getenv('MYSQL_DBNAME') ? $db_name=getenv('MYSQL_DBNAME') : $db_name='binotifydb';
            getenv('MYSQL_DBPORT') ? $db_port=getenv('MYSQL_DBPORT') : $db_port='3306';

            $db_conn = new mysqli("$db_host:$db_port", $db_user, $db_pass, $db_name);

            // check connection error
            if ($db_conn->connect_error) {
                die("Connection failed: " . $db_conn->connect_error);
            }

            return $db_conn;
        }
    }
?>