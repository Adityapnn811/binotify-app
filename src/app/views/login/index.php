<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <div class="wrapper">
        <div class="floating-box">
        <form name="form1" method="post" action="login/run">
        <label for="uname">User Name</label>
        <input type="text" id="user_name" name="user_name"><br><br>
        <label for="pwd">Password</label>
        <input type="password" id="password" name="password"><br><br>
        <input name="submit" type="submit" id="submit" value="Login"><br>
        <p>New User 
            <a href="signup.php">Register Here</a>
        </p>
    </div>
</body>
</html>