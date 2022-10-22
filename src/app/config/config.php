<?php
    // Database
    getenv('MYSQL_DBUSER') ? define("MYSQL_DBUSER", getenv('MYSQL_DBUSER')) : define("MYSQL_DBUSER", "user");
    getenv('MYSQL_DBHOST') ? define("MYSQL_DBHOST", getenv('MYSQL_DBHOST')) : define("MYSQL_DBHOST", "localhost");
    getenv('MYSQL_DBPASS') ? define("MYSQL_DBPASS", getenv('MYSQL_DBPASS')) : define("MYSQL_DBPASS", "aditya962");
    getenv('MYSQL_DBNAME') ? define("MYSQL_DBNAME", getenv('MYSQL_DBNAME')) : define("MYSQL_DBNAME", "binotifydb");
    getenv('MYSQL_DBPORT') ? define("MYSQL_DBPORT", getenv('MYSQL_DBPORT')) : define("MYSQL_DBPORT", "3306");
?>