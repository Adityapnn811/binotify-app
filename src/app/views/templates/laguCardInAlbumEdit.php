<?php
function laguCardInEdit($album_id, $album_id_now, $id= "1", $judul = "Judul", $penyanyi = "penyanyi", $tahun="2022", $genre="genre", $img="./img/laguDefault.jpg", $depth=0){
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
        <div class="laguCardInEdit">
            <div class="imgCardContainer">
                <img src="$img" alt="cover lagu" class="laguImg">
            </div>
            <div class="infoEdit">
                <p hidden>$id</p>
                <div>
                    <p class="judulLagu">$judul</p>
                    <p class="penyanyi">$penyanyi</p>
                </div>
                <p class="tahun">$tahun</p>
                <p class="genre">$genre</p>
    EOT;

    if ($album_id == $album_id_now) {
        $html .= <<<"EOT"
                <form method="post" action="/album/deleteSongFromAlbum" >
                    <input type="hidden" name="song_id" value="$id"/>
                    <input type="hidden" name="Penyanyi" value="$penyanyi"/>
                    <input type="hidden" name="album_id" value="$album_id_now"/>
                    <button type="submit" class="editButtonAlbumDelete">Delete</button>
                </form>
            </div>
            <script src="./js/script.js"></script>
            </div>
        EOT;
    } else {
        $html .= <<<"EOT"
                <form method="post" action="/album/addSongToAlbum" >
                    <input type="hidden" name="song_id" value="$id"/>
                    <input type="hidden" name="Penyanyi" value="$penyanyi"/>
                    <input type="hidden" name="album_id" value="$album_id_now"/>
                    <button type="submit" class="editButtonAlbumAdd">Add</button>
                </form>
            </div>
            </div>
        EOT;
    }

   echo $html;
}
?>

