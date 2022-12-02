<?php
    // Database
    getenv('MYSQL_DBUSER') ? define("MYSQL_DBUSER", getenv('MYSQL_DBUSER')) : define("MYSQL_DBUSER", "root");
    getenv('MYSQL_DBHOST') ? define("MYSQL_DBHOST", getenv('MYSQL_DBHOST')) : define("MYSQL_DBHOST", "localhost");
    getenv('MYSQL_DBPASS') ? define("MYSQL_DBPASS", getenv('MYSQL_DBPASS')) : define("MYSQL_DBPASS", "aditya962");
    getenv('MYSQL_DBNAME') ? define("MYSQL_DBNAME", getenv('MYSQL_DBNAME')) : define("MYSQL_DBNAME", "binotifydb");
    getenv('MYSQL_DBPORT') ? define("MYSQL_DBPORT", getenv('MYSQL_DBPORT')) : define("MYSQL_DBPORT", "3306");
    // SOAP URL and key
    getenv('SOAP_URL') ? define("SOAP_URL", getenv('SOAP_URL')) : define("SOAP_URL", "http://hostlocal:4040");
    getenv('SOAP_API_KEY') ? define("SOAP_API_KEY", getenv('SOAP_API_KEY')) : define("SOAP_API_KEY", "1fd89efa578ef3a8b81aef51cc868c0c4ec2b385cec0b7bc234e6ba7f53a02c4");
?>