<?php
    require_once "../app/views/templates/penyanyi_premium.php";
    require_once "../app/views/templates/paginationButton.php";
    require_once '../app/views/templates/navbar.php';
    require_once '../app/views/templates/sidebar.php';

    // var_dump($data)
    $subsId = $_SESSION["user_id"];
?>
<body onload="validateData(<?=$subsId?>)">
<?= sidebar() ?>

<div class="main-body">
<?= navbar() ?>

<div class="cardContainerPrem">
    <div class="lagu-prem-title">
        List Penyanyi Premium
    </div>
    <div class="lagu-premium-container">
        <div class="lagu-pre-card-container" id="container-list">
            <?php foreach($data["list_penyanyi"] as $info): ?>
                <?php
                    $subscribed = "NONE";
                    foreach($data["user_subs"] as $subs) {
                        if ($subs["creator_id"] == $info["user_id"]) {
                            $subscribed = $subs["status"];
                            break;
                        }
                    }
                ?>
                <?= penyanyiCardPremium($info["user_id"], $info["name"], $subscribed, $_SESSION["user_id"])?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function lagu_premium(id) {
        window.location.href = "/lagu_premium/" + id;
    }

    function subscribe(subsId, creatorId){
        const xhttp = new XMLHttpRequest();
        let formData = new FormData();
        formData.append("creatorId", creatorId);
        formData.append("subscriberId", subsId);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = this.responseText;
                console.log(res);
                window.location.href = "/list_premium"
            }
        }
        xhttp.open("POST", "/subscription/createRequest");
        xhttp.send(formData);
    }

    function validateData(subsId) {
        console.log(subsId)
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = this.responseText;
                console.log(res);
                // if (dataUser.length != )
            }
        }
        xhttp.open("GET", "/subscription/getStatusById/" + subsId);
        xhttp.send();
    }

    function checkStatus(subsId, creatorId) {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = this.responseText;
                console.log(res);
                // window.location.href = "/list_premium"
            }
        }
        xhttp.open("GET", "/subscription/checkRequest/" + subsId + "/" + creatorId);
        xhttp.send();
    }

    function poll(func, interval = 3000){
        let timer;
        clearInterval(timer);
        return (...args) => {
            timer = setInterval(() => { func.apply(this, args); }, interval);
        };
    }

    const pollCheckStatus = poll((subsId, creatorId) => checkStatus(subsId, creatorId));
</script>
</body>