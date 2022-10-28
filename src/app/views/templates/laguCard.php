<?php
function laguCard($id= "1", $judul = "Judul", $penyanyi = "penyanyi", $tahun="2022", $genre="genre", $img="./img/laguDefault.jpg", $depth=0){
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

