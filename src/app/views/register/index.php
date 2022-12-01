<div class="login-background">
    <div class="login-title-container">
        <img src="/img/spotify-logo.png" class="login-logo">
        <a class="login-title" href="/home" > BINOTIFY </a>
    </div>
        <div class="login-container">
            <div class="login-form-container">
                <?php if (!empty($data)) : ?>
                    <p class="login-error-msg">
                        <?=$data["error_msg"]?>
                    </p >
                <?php endif; ?>

                <form method="post" action="/register/signup" class="login-form">
                    <div class="login-input">
                        <label class="login-input-text" for="username" required> Username </label>
                        <input class="login-input-box" placeholder="Enter your username" type="text" name="username" id="username" required onkeyup="processUsernameChange(this.value)">
                        <p class="register-error-msg-ajax" id="errorMsgUsername">a</p>
                    </div>
                    
                    <div class="login-input">
                        <label class="login-input-text" requires> Email </label>
                        <input class="login-input-box" placeholder="Enter your email" type="text" name="email" id="email" class="" required onkeyup="processEmailChange(this.value)">
                        <p class="register-error-msg-ajax" id="EMAILL">b</p>
                    </div>

                    <div class="login-input">
                        <label class="login-input-text" required> Password </label>
                        <input class="login-input-box" placeholder="Enter your password" type="password" name="password" required>
                    </div>

                    <div class="login-input">
                        <label class="login-input-text" required> Confirm Password </label>
                        <input class="login-input-box" placeholder="Enter your password again" type="password" name="confirm_password" required>
                    </div>

                    
                    <div class="register-button-container">
                        <button class="register-button" type="submit" value="Submit" id="registerButton"> SIGN UP </button>
                    </div>
                    
                    <p class="register-login-button">
                        Have an account?
                        <a class="register-href" href="/login">Login</a>
                    </p>
                </form> 

            </div>
    </div>

</div>

<script type="text/javascript">
    function debounce(func, timeout = 100){
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
    }

    function checkUsername(usernameInput) {
        let errorMsgUsername = document.getElementById("errorMsgUsername")
        
        // Masukkin xml di sini
        if (!usernameInput == "") {
            let pattern = /^[a-zA-Z0-9_]+$/
            if (!pattern.test(usernameInput)) {
                changeBorder(false, "username");
                document.getElementById("registerButton").disabled = true;
            } else {
                const xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // ambil data html dari response di sini
                        try {
                            const res = JSON.parse(this.responseText);
                            if (res.count === 0) {
                                changeBorder(true, "username");
                                document.getElementById("registerButton").disabled = false;
                                errorMsgUsername.style.display = "none";
                            } else {
                                changeBorder(false, "username");
                                document.getElementById("registerButton").disabled = true;
                                errorMsgUsername.innerHTML = "This username already used";
                                errorMsgUsername.style.display = "block";
                            }
                        } catch {
                            // do nothing
                        }
                    }
                };
                xhttp.open("GET", "/register/checkUsername/" + usernameInput);
                xhttp.send();
            }
        } else {
            changeBorder(false, "username");
            document.getElementById("registerButton").disabled = true;
            errorMsgUsername.innerHTML = "You need to enter your username";
            errorMsgUsername.style.display = "block";
        }
    }

    function checkEmail(emailInput) {
        let errorMsgEmail = document.getElementById("EMAILL");
        // Masukkin xml di sini
        if (!emailInput == "") {
            let pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (!pattern.test(emailInput)) {
                changeBorder(false, "email");
                document.getElementById("registerButton").disabled = true;
                errorMsgEmail.innerHTML = "This email is invalid. Make sure it's written like example@email.com";
                errorMsgEmail.style.display = "block";
            } else {
                const xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // ambil data html dari response di sini
                        try {
                            const res = JSON.parse(this.responseText);
                            if (res.count === 0) {
                                console.log("here")
                                
                                document.getElementById("registerButton").disabled = false;
                                changeBorder(true, "email");
                                errorMsgEmail.style.display = "none";

                            }else {
                                changeBorder(false, "email");
                                document.getElementById("registerButton").disabled = true;
                                errorMsgEmail.innerHTML = "This email already used";
                                errorMsgEmail.style.display = "block";
                            }
                        } catch {
                            // do nothing
                        }
                    }
                };
                xhttp.open("GET", "/register/checkEmail/" + emailInput);
                xhttp.send();
            }
        } else {
            changeBorder(false, "email");
            errorMsgEmail.innerHTML = "You need to enter your email";
            errorMsgEmail.style.display = "block";
        }
    }

    function changeBorder(toGreen, id) {
        if (toGreen === true) {
            let element = document.getElementById(id);
            element.classList = "";
            element.classList.add("greenBorder");
            document.getElementById("registerButton").disabled = false;
        } else {
            let element = document.getElementById(id);
            element.classList = "";
            element.classList.add("redBorder");
            document.getElementById("registerButton").disabled = true;
        }
    }

    const processUsernameChange = debounce((usernameInput) => checkUsername(usernameInput))
    const processEmailChange = debounce((emailInput) => checkEmail(emailInput))
</script>