<?php
function laguCard($id= "1", $judul = "Judul", $penyanyi = "penyanyi", $tahun="2022", $genre="genre", $img="./img/laguDefault.jpg"){
    if (!file_exists($img)) {
        $img = "./img/laguDefault.jpg";
    }
    $html = <<<"EOT"
        <div class="laguCard" onclick="goToSongPage($id)">
            <div class="imgCardContainer">
                <img src="$img" alt="cover lagu" class="laguImg">
            </div>
            <div class="info">
                <p hidden>$id</p>
                <div>
                    <p class="judulLagu">$judul</p>
                    <p class="penyanyi">$penyanyi</p>
                </div>
                <p class="tahun">$tahun</p>
                <p class="genre">$genre</p>
            </div>
        </div>
    EOT;

   echo $html;
}
?>

