<?php
function penyanyiCardPremium($id= "1", $nama = "nama", $isSubscribe = "NONE", $subsId="1"){
    $html = <<<"EOT"
        <div class="penyanyi-prem-card">
        <p class="penyanyi-prem-content-number"> $id </p>
        <p class="penyanyi-prem-content-title">$nama</p>
        EOT;
    if($isSubscribe == "ACCEPTED"){
        $html .= <<<"EOT"
                <p class="penyanyi-prem-content-button" onclick="lagu_premium($id)"> Details </p>
            EOT;
    } else if ($isSubscribe == "PENDING"){
        $html .= <<<"EOT"
                <p class="penyanyi-prem-content-button-pending"> Pending </p>
        EOT;
    } else if ($isSubscribe == "REJECTED") {
        $html .= <<<"EOT"
                <p class="penyanyi-prem-content-button-rejected"> Rejected </p>
        EOT;
    } else {
        $html .= <<<"EOT"
            <p class="penyanyi-prem-content-button" onclick="subscribe($subsId, $id)"> Subscribe </p>
        EOT;
    }
    $html .= <<<"EOT"
        </div>
    EOT;

   echo $html;
}
?>