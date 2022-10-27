<?php
    require_once '../app/views/templates/navbar.php';
    require_once '../app/views/templates/sidebar.php';
    $id = $data["id"];
    $body = <<<"EOT"
            <body onload="loadData($id)">
            <div class="main-body">
    EOT;
    $body_end = <<<"EOT"
                    <div class="mediaContainer">
                        <div class="infoContainer">
                            <div class="playerContainer">
                                <img id="imgCover" alt="cover lagu" class="coverImg">
                                <audio id="playerLagu" class="songPlayer" preload="auto" controls></audio>
                            </div>
                            <div class="detailContainer">
                                <h6 id="genreLagu" class="songGenre"></h6>
                                <h1 id="judulLagu" class="songTitle"></h1>
                                <div class="minuteContainer">
                                    <h6 id="penyanyi" class="minuteDetail"></h6>
                                    <h6 id="tanggalTerbit" class="minuteDetail"></h6>
                                    <h6 id="durasi" class="minuteDetail"></h6>
                                </div>
                                <h6 id="albumLagu" class="songAlbum"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            EOT;
    echo sidebar();
    echo $body;
    echo navbar("..");
    echo $body_end;
?>
<!-- <table id="detilLagu"></table> -->

<script type="text/javascript">
    function loadData(id) {
        // Masukkin xml di sini
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // ambil data html dari response di sini
                const res = JSON.parse(this.responseText);
                // tambahin row di sini
                setData(res[0]);
            } else if (this.status == 404) {
                const elem = document.getElementsByClassName("laguContainer")[0];
                elem.parentNode.removeChild(elem);
                document.body.appendChild(document.createElement("h1").appendChild(document.createTextNode("404: Not Found")));
            }
        };
        xhttp.open("GET", "/song/getSongById/" + id);
        xhttp.send();
    }

    function setData(data) {
        document.getElementById("imgCover").src = "." + data.Image_path;
        document.getElementById("genreLagu").innerHTML = data.Genre;
        document.getElementById("judulLagu").innerHTML = data.Judul;
        document.getElementById("penyanyi").innerHTML = "by " + data.Penyanyi;
        document.getElementById("tanggalTerbit").innerHTML = data.Tanggal_terbit;
        document.getElementById("durasi").innerHTML = toMinutes(data.Duration);
        document.getElementById("playerLagu").src = "." + data.Audio_path;

        const id = data.album_id;
        if (id !== null) {
            // Masukkin xml di sini
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // ambil data html dari response di sini
                    const res = JSON.parse(this.responseText);
                    // tambahin row di sini
                    setLink(res[0], id);
                }
            };
            xhttp.open("GET", "/song/getAlbumNameById/" + id);
            xhttp.send();
        }
    }

    function toMinutes(time) {
        var mins = (~~(time / 60));
        var secs = (time - mins * 60).toFixed().toString().padStart(2, "0");
        return `${mins}:${secs}`;
    }

    function setLink(data, id) {
        document.getElementById("albumLagu").innerHTML = "in " + data.Judul;
        document.getElementById("albumLagu").style.display = "block";
        document.getElementById("albumLagu").addEventListener("click", function() {
            window.location.href = "/Album/" + id;
        });
    }
</script>