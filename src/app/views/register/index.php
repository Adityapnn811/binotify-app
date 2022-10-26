<div>
<a href="/home">SPOTIFY</a>
    <form method="post" action="/register/signup">
    Username:<br>
    <input type="text" name="username" >
    <br>
    Email:<br>
    <input type="text" name="email">
    <br><br>
    Password:<br>
    <input type="password" name="password">
    <br><br>
    <input type="submit" value="Submit">
    </form> 
    <p style="color:blue;">
        <?= !empty($data) ? $data["error_msg"] : "" ?> 
    </p>
</div>