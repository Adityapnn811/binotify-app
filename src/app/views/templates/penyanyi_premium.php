<?php
function penyanyiCardPremium($id= "1", $nama = "nama", $isSubscribe ="FALSE"){
    if($isSubscribe == "SUBSCRIBE"){
        $html = <<<"EOT"
            <div class="penyanyi-prem-card">
                <p class="penyanyi-prem-content-number"> $id </p>
                <p class="penyanyi-prem-content-title">$nama</p>
                <p class="penyanyi-prem-content-button"> Details </p>

            </div>
            EOT;
    }else{
        $html = <<<"EOT"
            <div class="penyanyi-prem-card">
                <p class="penyanyi-prem-content-number"> $id </p>
                <p class="penyanyi-prem-content-title">$nama</p>
                <p class="penyanyi-prem-content-button"> Subscribe </p>
            </div>
        EOT;
    }

   echo $html;
}
?>