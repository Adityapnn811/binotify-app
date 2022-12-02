<?php
    require_once "../app/views/templates/penyanyi_premium.php";
    require_once "../app/views/templates/paginationButton.php";
    require_once '../app/views/templates/navbar.php';
    require_once '../app/views/templates/sidebar.php';

    // var_dump($data)
    $subsId = $_SESSION["user_id"];
?>
<body onload="pollValidate(<?=$subsId?>)">
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
    function approve(subsId, creatorId){
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
        xhttp.open("POST", "/subscription/approveRequest");
        xhttp.send(formData);
    }
    function reject(subsId, creatorId){
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
        xhttp.open("POST", "/subscription/rejectRequest");
        xhttp.send(formData);
    }

    function validateData(subsId) {
        const xhttp = new XMLHttpRequest();
        let change = false
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res) {
                    res.return.forEach((obj, idx) => {
                        const subsId = obj.subscriberId;
                        const creatorId = obj.creatorId;
                        const xhr2 = new XMLHttpRequest();
                        xhr2.onreadystatechange = function() {
                            const res2 = JSON.parse(this.responseText);
                            if (res2[0].status != obj.status) {
                                if (obj.status == "ACCEPTED") {
                                    approve(res2[0].subscriber_id, res2[0].creator_id)
                                }else if (obj.status == "REJECTED") {
                                    reject(res2[0].subscriber_id, res2[0].creator_id)
                                }
                                change = true;
                            }
                        }
                        xhr2.open("GET", "/subscription/checkRequestLocal/" + subsId + "/" + creatorId);
                        xhr2.send();
                    })
                }
            }
            if (change) {
                window.location.href = "list_premium";
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

    function poll(func, interval = 5000){
        let timer;
        clearInterval(timer);
        return (...args) => {
            timer = setInterval(() => { func.apply(this, args); }, interval);
        };
    }

    const pollCheckStatus = poll((subsId, creatorId) => checkStatus(subsId, creatorId));
    const pollValidate = poll((subsId) => validateData(subsId));
</script>
</body>