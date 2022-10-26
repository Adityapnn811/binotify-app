<div class="wrapper">
    <div class="floating-box">
    <a href="/home">SPOTIFY</a>
    <form name="form1" method="post" action="/login/run">
    <label for="uname">User Name</label>
    <input type="text" id="user_name" name="user_name"><br><br>
    <label for="pwd">Password</label>
    <input type="password" id="password" name="password"><br><br>
    <input name="submit" type="submit" id="submit" value="Login"><br>
    <p>New User 
        <a href="/register">Register Here</a>
    </p>
    <p style="color:blue;">
        <?= !empty($data) ? $data["error"] : "" ?> 
    </p>
</div>
