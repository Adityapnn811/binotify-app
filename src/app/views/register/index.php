<div>
<a href="/home">SPOTIFY</a>
    <form method="post" action="/register/signup">
    Username:<br>
    <input type="text" name="username" id="username" class="" require onkeyup="processUsernameChange(this.value)">
    <br>
    Email:<br>
    <input type="text" name="email" id="email" class="" require onkeyup="processEmailChange(this.value)">
    <br><br>
    Password:<br>
    <input type="password" name="password" require>
    <br><br>
    Confirm Password:<br>
    <input type="password" name="confirm_password" require>
    <br><br>
    <button type="submit" value="Submit" id="registerButton">Register</button>
    </form> 
    <p style="color:blue;">
        <?= !empty($data) ? $data["error_msg"] : "" ?> 
    </p>
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
                            } else {
                                changeBorder(false, "username");
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
            let element = document.getElementById("username");
            element.classList = "";
            element.classList.add("noBorder");
        }
    }

    function checkEmail(emailInput) {
        // Masukkin xml di sini
        if (!emailInput == "") {
            let pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (!pattern.test(emailInput)) {
                changeBorder(false, "email");
                document.getElementById("registerButton").disabled = true;
            } else {
                const xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // ambil data html dari response di sini
                        try {
                            const res = JSON.parse(this.responseText);
                            if (res.count === 0) {
                                console.log("here")
                                changeBorder(true, "email");
                            } else {
                                changeBorder(false, "email");
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
            let element = document.getElementById("email");
            element.classList = "";
            element.classList.add("noBorder");
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