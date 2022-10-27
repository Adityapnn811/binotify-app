<div class="login-background">
    <div class="login-title-container">
        <img src="img/logo.png" alt="BINOTIFY" class="login-logo">
        <a class="login-title" href="/home" > BINOTIFY </a>
    </div>
    <a class="login-line-divider"></a>


    <div class="login-container">
        <div class="login-form-container">

            <form class="login-form" name="form1" method="post" action="/login/run">
                <div class="login-input">
                    <label class="login-input-text" for="uname" required> Email address or username </label>
                    <input class="login-input-box" type="text" id="user_name" name="user_name" placeholder="Email address or username">

                </div>

                <div class="login-input" >
                    <label class="login-input-text"  for="pwd" required>Password</label>
                    <input class="login-input-box"  type="password" id="password" name="password" placeholder="Password">
                </div>

                <div class="login-button-container">
                    <button class="login-button" name="submit" type="submit" id="submit" value="Login"> LOG IN </button>
                </div>

                <p class="login-line-divider"></p>
        
            </form>
            
            <P class="login-register-text">Don't have an account?</P>

            <button class="login-register-button" onclick="window.location.href='/register'" > SIGN UP FOR SPOTIFY </button>                
<!-- 
            <p>New User 
                <a class="login-title" href="/register">Register Here</a>
            </p> -->

        </div>

    </div>

        <p style="color:blue;">
            <?= !empty($data) ? $data["error"] : "" ?> 
        </p>
</div>
