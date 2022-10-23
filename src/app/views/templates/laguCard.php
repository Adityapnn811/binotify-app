<?php
function laguCard($id= "1", $judul = "Judul", $penyanyi = "penyanyi", $tahun="2022", $genre="genre", $img="./img/laguDefault.jpg"){
    if (!file_exists($img)) {
        $img = "./img/laguDefault.jpg";
    }
    $html = <<<"EOT"
        <div class="laguCard">
            <div class="imgCardContainer">
                <img src="$img" alt="cover lagu" class="laguImg">
            </div>
            <div class="info">
                <h2>$judul</h2>
                <p hidden>$id</p>
                <p>$penyanyi</p>
                <p>$tahun</p>
                <p>$genre</p>
            </div>
        </div>
    EOT;

   echo $html;
}
?>