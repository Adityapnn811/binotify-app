<?php
function albumCard($id= "1", $judul = "Judul", $penyanyi = "penyanyi", $tahun="2022", $genre="genre", $img="./img/album.jpg"){
    if (!file_exists($img)) {
        $img = "./img/album.jpg";
    }
    $html = <<<"EOT"
        <div class="albumCard">
            <div class="imgCardContainer">
                <img src="$img" alt="cover album" class="laguImg">
            </div>
            <div class="info">
                <h2>$judul</h2>
                <p hidden>$id</p>
                <p>By $penyanyi</p>
                <p>Released in $tahun</p>
                <p>$genre</p>
            </div>
        </div>
    EOT;

   echo $html;
}
?>