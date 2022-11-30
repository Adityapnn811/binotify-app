<?php
function laguCardPrem($number="0", $id= "1", $judul = "Judul", $penyanyi = "penyanyi", $tahun="2022", $genre="genre", $img="./img/laguDefault.jpg", $depth=0){
    if (!file_exists($img)) {
        $img = "./img/laguDefault.jpg";
    }
    if ($depth > 0) {
        $img = "." . $img;
        $depth = $depth - 1;
        for ($x = 0; $x <= $depth; $x++) {
            $img = "../" . $img;
        }
    }
    $html = <<<"EOT"
        <div class="lagu-prem-card">
                <p class="lagu-prem-content-number"> $number </p>
                <p class="lagu-prem-content-title">$judul</p>
                <button type="button" onClick="Play()">Play|Pause</button>
                <audio
                    controls id="audioval"
                    src="../songs/34+35.mp3" hidden >
                </audio>
        </div>
        <script>
            function Play(){
                var myAudio = document.getElementById("audioval");
                if(myAudio.paused) {
                    myAudio.play();
                }else {
                    myAudio.pause();
                }
            }
        
        
        
        </script>
    EOT;

   echo $html;
}

function laguCardPremium($number="0", $id= "1", $judul = "Judul", $audiopath ='./songpath' ){
    $html = <<<"EOT"
        <div class="lagu-prem-card">
                <p class="lagu-prem-content-number"> $number </p>
                <p class="lagu-prem-content-title">$judul</p>
                <button type="button" onClick="Play()">Play|Pause</button>
                <audio
                    controls id="audioval"
                    src="../songs/34+35.mp3" hidden >
                </audio>
        </div>
        <script>
            function Play(){
                var myAudio = document.getElementById("audioval");
                if(myAudio.paused) {
                    myAudio.play();
                }else {
                    myAudio.pause();
                }
            }
        
        
        
        </script>
    EOT;

   echo $html;
}
?>

