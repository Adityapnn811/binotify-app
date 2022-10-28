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
    <div class="formEdit">
        <div class="formWrapperLeft">
            <form class="coverForm" action="/song/uploadCover" method="post" enctype="multipart/form-data">
                <img id="imgCover" alt="cover lagu" class="editImg">
                <div class="coverSelector">
                    <input type="file" name="file" id="fileCover" accept="image/*" onchange="handleImageFiles(this.files)">
                    <label id="selector" for="fileCover">Select Cover</label>
                    <h6 class="dragDetail" id="coverDetail">or Drag and Drop to Image Box</h6>
                </div>
            </form>
            <form method="post" action="/song/postSongUpdate">
                <div class="formContainer">
                    <label for="Judul" id="labelJudul">Judul</label>
                    <input type="text" class="inputField" name="Judul" id="inputJudul">
                    <label for="Tanggal" id="labelTanggal">Tanggal Terbit</label>
                    <input type="text" class="inputField" name="Tanggal" id="inputTanggal">
                    <label for="Genre" id="labelGenre">Genre</label>
                    <input type="text" class="inputField" name="Genre" id="inputGenre">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="Duration" id="dur">
                    <input type="hidden" name="Audio_path" id="ap">
                    <input type="hidden" name="Image_path" id="ip">
                    <input type="submit" class="saveEdit" value="Save" id="submitButton">
                    <div class="editButton" id="deleteButton">Delete</div>
                </div>
            </form>
        </div>
        <div class="dropSong" id="dropArea">
            <form action="/song/uploadSong" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="fileSong" accept="audio/*" onchange="handleFiles(this.files)">
                <label id="selector" for="fileSong">Select Song</label>
            </form>
            <h6 class="dragDetail" id="songDetail">or Drag and Drop Here</h6>
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
            document.getElementById("imgCover").src = "../." + data.Image_path;
            document.getElementById("id").value = data.song_id;
            document.getElementById("dur").value = data.Duration;
            document.getElementById("ap").value = data.Audio_path;
            document.getElementById("ip").value = data.Image_path;
            document.getElementById("inputJudul").placeholder = "Old: " + data.Judul;
            document.getElementById("inputTanggal").placeholder = "Old: " + data.Tanggal_terbit;
            document.getElementById("inputGenre").placeholder = "Old: " + data.Genre;
            document.getElementById("inputJudul").value = data.Judul;
            document.getElementById("inputTanggal").value = data.Tanggal_terbit;
            document.getElementById("inputGenre").value = data.Genre;
        };
        // Drag and Drop Song
        const id = <?= $id ?>;

        document.getElementById("deleteButton").addEventListener("click", function() {
            const xhttp = new XMLHttpRequest();
            var formData = new FormData();
            formData.append("id", id);
            xhttp.open("POST", "/song/deleteSong");
            xhttp.send(formData);
            window.location.href = "/home";
        });

        let dropArea = document.getElementById("dropArea");
        var options = ['dragenter', 'dragover', 'dragleave', 'drop'];


        options.slice(0, 2).forEach(e => {
            dropArea.addEventListener(e, e => {
                e.preventDefault();
                e.stopPropagation();
                dropArea.style.borderColor = "#22f66c";
            });
        });

        options.slice(2).forEach(e => {
            dropArea.addEventListener(e, e => {
                e.preventDefault();
                e.stopPropagation();
                dropArea.style.borderColor = "#117b36";
            });
        });

        dropArea.addEventListener('drop', dropFile)

        function dropFile(e) {
            var dt = e.dataTransfer;
            var files = dt.files;
            handleFiles(files);
        }

        function handleFiles(files) {
            var file = files[0];
            uploadFile(file);
        }

        function uploadFile(file) {
            var formData = new FormData();
            formData.append('file', file);
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    setMeta(res["tags"]);
                    setOthers(res);
                }
            };
            xhttp.open("POST", "/song/uploadSong");
            xhttp.send(formData);
        }

        function setMeta(data) {
            document.getElementById("inputJudul").value = data.title[0];
            document.getElementById("inputTanggal").value = data.year[0] + "-01-01";
            document.getElementById("inputGenre").value = data.genre[0];
        }

        function setOthers(data) {
            document.getElementById("songDetail").innerHTML = data["name"] + ", " + toMinutes(data["Duration"]);
            document.getElementById("dur").value = data["Duration"];
            document.getElementById("ap").value = data["Audio_path"];
            if (data["Image_path"] !== undefined) {
                document.getElementById("coverDetail").innerHTML = data["img_name"];
                document.getElementById("imgCover").src = "../." + data["Image_path"];
                document.getElementById("ip").value = data["Image_path"];
            }
        }

        // Drag and Drop Image
        let imgArea = document.getElementById("imgCover");

        options.slice(0, 2).forEach(e => {
            imgArea.addEventListener(e, e => {
                e.preventDefault();
                e.stopPropagation();
                imgArea.style.borderColor = "#22f66c";
            });
        });

        options.slice(2).forEach(e => {
            imgArea.addEventListener(e, e => {
                e.preventDefault();
                e.stopPropagation();
                imgArea.style.borderColor = "#117b36";
            });
        });

        imgArea.addEventListener('drop', dropImageFile)

        function dropImageFile(e) {
            var dt = e.dataTransfer;
            var files = dt.files;
            handleImageFiles(files);
        }

        function handleImageFiles(files) {
            var file = files[0];
            uploadImageFile(file);
        }

        function uploadImageFile(file) {
            var formData = new FormData();
            formData.append('file', file);
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    setImageMeta(res);
                    // setOthers(res);
                }
            };
            xhttp.open("POST", "/song/uploadCover");
            xhttp.send(formData);
        }

        function setImageMeta(data) {
            document.getElementById("coverDetail").innerHTML = data["name"];
            document.getElementById("imgCover").src = "../." + data["Image_path"];
            document.getElementById("ip").value = data["Image_path"];
        }

        function toMinutes(time) {
            var mins = (~~(time / 60));
            var secs = (time - mins * 60).toFixed().toString().padStart(2, "0");
            return `${mins}:${secs}`;
        }
    </script>
<?php endif; ?>