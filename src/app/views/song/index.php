<?php
require_once '../app/views/templates/navbar.php';
?>
<?= navbar() ?>
<?php
$id = $data["id"];
$body = <<<"EOT"
            <body onload="loadData($id)">
                <div class="songContainer">
                    <div class="infoContainer">
                        <div class="playerContainer">
                            <img id="imgLagu" alt="cover lagu" class="laguImg">
                            <audio id="playerLagu" class="songPlayer" preload="auto" controls muted loop autoplay></audio>
                        </div>
                        <div class="detailContainer">
                            <h6 id="genreLagu" class="songGenre"></h6>
                            <h1 id="judulLagu" class="songTitle"></h1>
                            <div class="minuteContainer">
                                <h6 id="penyanyi" class="minuteDetail"></h6>
                                <h6 id="tanggalTerbit" class="minuteDetail"></h6>
                                <h6 id="durasi" class="minuteDetail"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            EOT;
echo $body;
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
                setData(res);
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
        console.log(data);
        document.getElementById("imgLagu").src = "." + data[0].Image_path;
        document.getElementById("genreLagu").innerHTML = data[0].Genre;
        document.getElementById("judulLagu").innerHTML = data[0].Judul;
        document.getElementById("penyanyi").innerHTML = data[0].Penyanyi;
        document.getElementById("tanggalTerbit").innerHTML = data[0].Tanggal_terbit;
        document.getElementById("durasi").innerHTML = toMinutes(data[0].Duration);
        document.getElementById("playerLagu").src = "." + data[0].Audio_path;
    }

    function toMinutes(time) {
        var mins = (~~(time / 60));
        var secs = (time - mins * 60).toFixed().toString().padStart(2, "0");
        return `${mins}:${secs}`;
    }
</script>