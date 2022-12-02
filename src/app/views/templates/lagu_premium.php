<?php
function laguCardPremium($number="0", $id= "1", $judul = "Judul", $audiopath ='./songpath' ){
    $html = <<<"EOT"
        <div class="lagu-prem-card">
                <p class="lagu-prem-content-number"> $number </p>
                <p class="lagu-prem-content-title">$judul</p>
                <img src="/img/play.png" class="lagu-prem-image-play" onClick="Play($number)" id="play$number">
                <img src="/img/stop.png" class="lagu-prem-image-stop" onClick="Play($number)" id="stop$number">
                
                <audio
                    controls id=$number
                    src="$audiopath" hidden >
                </audio>
        </div>
    EOT;

   echo $html;
}
?>

