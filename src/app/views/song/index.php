<?php
require_once '../app/views/templates/navbar.php';
require_once '../app/views/templates/sidebar.php';

$id = $data["id"];
$edit = ($data["edit"] == "edit");
$body = <<<"EOT"
                        <body onload="loadData($id)">
                            <div class="main-body">
                        EOT;
echo sidebar();
echo $body;
if (!$edit) {
    echo navbar("..");
} else {
    echo navbar("../..");
}
?>
<?php if (!$edit) : ?>
    <div class="mediaContainer">
        <div class="infoContainer">
            <div class="playerContainer">
                <img id="imgCover" alt="cover lagu" class="coverImg">
                <audio id="playerLagu" class="songPlayer" preload="auto" controls></audio>
            </div>
            <div class="detailContainer">
                <h6 id="genreLagu" class="songGenre"></h6>
                <h1 id="judulLagu" class="title"></h1>
                <div class="minuteContainer">
                    <h6 id="penyanyi" class="minuteDetail"></h6>
                    <h6 id="tanggalTerbit" class="minuteDetail"></h6>
                    <h6 id="durasi" class="minuteDetail"></h6>
                </div>
                <h6 id="albumLagu" class="songAlbum"></h6>
                <?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]) : ?>
                    <div id="editLagu" class="editButton" onclick="toEdit(<?= $id ?>)">Edit</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </body>
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
                } else if (this.readyState == 4 && this.status == 404) {
                    const elem = document.getElementsByClassName("mediaContainer")[0];
                    const parent = document.getElementsByClassName("main-body")[0];
                    parent.removeChild(elem);

                    var notFound = document.createElement("div");
                    notFound.innerHTML = "404: Song Not Found";
                    notFound.style.position = "absolute";
                    notFound.style.left = "50%"
                    notFound.style.top = "50%"
                    parent.appendChild(notFound);
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
                window.location.href = "/album/" + id;
            });
        }


        <?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]) : ?>

            function toEdit(id) {
                window.location.href = "/song/" + id + "/edit";
            }
        <?php endif; ?>
    </script>
<?php else : ?>
    <form class="formEdit" method="post" action="/song/postSongUpdate">
        <div class="formContainer">
            <h1 id="labelForm">Edit Lagu</h1>
            <label for="Judul" id="labelJudul">Judul</label>
            <input type="text" class="inputField" name="Judul" id="inputJudul">
            <label for="Tanggal" id="labelTanggal">Tanggal Terbit</label>
            <input type="text" class="inputField" name="Tanggal" id="inputTanggal">
            <label for="Genre" id="labelGenre">Genre</label>
            <input type="text" class="inputField" name="Genre" id="inputGenre">
            <input type="hidden" name="id" id="id">
            <input type="submit" class="saveEdit" value="Save" id="submitButton">
        </div>
    </form>
    </body>
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
                } else if (this.readyState == 4 && this.status == 404) {
                    const elem = document.getElementsByClassName("formEdit")[0];
                    const parent = document.getElementsByClassName("main-body")[0];
                    parent.removeChild(elem);

                    var notFound = document.createElement("div");
                    notFound.innerHTML = "404: Song Not Found";
                    notFound.style.position = "absolute";
                    notFound.style.left = "50%"
                    notFound.style.top = "50%"
                    parent.appendChild(notFound);
                }
            };
            xhttp.open("GET", "/song/getSongById/" + id);
            xhttp.send();
        };

        function setData(data) {
            document.getElementById("id").value = data.song_id;
            document.getElementById("inputJudul").placeholder = "Old: " + data.Judul;
            document.getElementById("inputTanggal").placeholder = "Old: " + data.Tanggal_terbit;
            document.getElementById("inputGenre").placeholder = "Old: " + data.Genre;
            document.getElementById("inputJudul").value = data.Judul;
            document.getElementById("inputTanggal").value = data.Tanggal_terbit;
            document.getElementById("inputGenre").value = data.Genre;
        };
    </script>
<?php endif; ?>