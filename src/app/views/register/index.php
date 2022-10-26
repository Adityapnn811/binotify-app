<div>
<a href="/home">SPOTIFY</a>
    <form method="post" action="/register/signup">
    Username:<br>
    <input type="text" name="username" require>
    <br>
    Email:<br>
    <input type="text" name="email">
    <br><br>
    Password:<br>
    <input type="password" name="password">
    <br><br>
    Confirm Password:<br>
    <input type="password" name="confirm_password">
    <br><br>
    <button type="submit" value="Submit" id="registerButton">Register</button>
    </form> 
    <p style="color:blue;">
        <?= !empty($data) ? $data["error_msg"] : "" ?> 
    </p>
</div>