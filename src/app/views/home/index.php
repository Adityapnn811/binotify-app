
<h1> Welcome to Binotify </h1>
<?php
    if ($data['username'] == "username default") {
        echo "Hi there! Register here!";
    } else {
        echo "Hello, " . $data['username'];
    }
?>
