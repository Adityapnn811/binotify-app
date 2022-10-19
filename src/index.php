<!DOCTYPE html>
<html lang="en">

<head>
    <title>PHP Check</title>
    <neta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>PHP and DB Check</h1>
        <?php
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

            // get table
            if (!($tables = mysqli_query($db_conn, "SHOW TABLES"))) {
                echo "Error: " . mysqli_error($db_conn);
            }
            
            while ($table = mysqli_fetch_row($tables)) {
                echo $table[0] . "<br/>";
            }
            

            echo "Server is ready <br/>";

            $db_conn->close();

        ?>
    </div>
</body>
</html>