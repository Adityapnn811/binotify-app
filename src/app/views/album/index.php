<?php
require_once "../app/views/templates/laguCard.php";
require_once "../app/views/templates/laguCardInAlbumEdit.php";
require_once "../app/views/templates/paginationButton.php";
require_once '../app/views/templates/navbar.php';
require_once '../app/views/templates/sidebar.php';
?>
<?php
$id = $data["id"];
$edit = ($data["edit"] == "edit");
$body = <<<"EOT"
            <body onload="loadData($id)">
                <div class="main-body">
    EOT;
$bodyEdit = <<<"EOT"
            <body onload="loadDataEdit($id)">
                <div class="main-body">
    EOT;
echo sidebar();
if (!$edit) {
    echo $body;
    echo navbar("..");
} else {
    echo $bodyEdit;
    echo navbar("../..");
}
?>

<?php if (!$edit) : ?>
    <div class="mediaContainer">
        <div class="infoContainer">
            <div class="playerContainer">
                <img id="imgCover" alt="cover album" class="coverImg">
                <audio id="playerLagu" class="songPlayer" preload="auto" controls></audio>
            </div>
            <div class="detailContainer">
                <h1 id="judul" class="title"></h1>
                <div class="minuteContainer">
                    <h6 id="penyanyi" class="minuteDetail"></h6>
                    <h6 id="jumlahLagu" class="minuteDetail"></h6>
                    <h6 id="durasi" class="minuteDetail"></h6>
                </div>
            </div>
        </div>
    </div>
    <div class="cardContainer">
        <?php if (empty($data["songs"])) : ?>
            <h1>Tidak ada hasil pencarian</h1>
        <?php else : ?>
            <?php foreach ($data["songs"][0] as $idx => $info) : ?>
                <?= laguCard($info["song_id"], $info["Judul"], $info["Penyanyi"], substr($info["Tanggal_terbit"], 0, 4), $info["Genre"], $info["Image_path"], 1) ?>
            <?php endforeach; ?>
            <div class="pagination">
                <?php for ($page = 1; $page <= $data["songs"][1]; $page++) : ?>
                    <?php empty($_POST) ? $currentPage = 1 : $currentPage = (int) $_POST["page"] ?>
                    <?= paginationSearchButton($_POST, $currentPage, "/search", $page) ?>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]) : ?>
        <div id="editAlbum" class="editButton" onclick="toEdit(<?= $id ?>)">Edit</div>
    <?php endif; ?>
</div>
    </body>
    <script src="./js/script.js"></script>
    <script type="text/javascript">
        function loadData(id) {
            // Get Album Details
            const xhttp1 = new XMLHttpRequest();
            xhttp1.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // ambil data html dari response di sini
                    const res1 = JSON.parse(this.responseText);
                    // tambahin row di sini
                    setData(res1);
                } else if (this.readyState == 4 && this.status == 404) {
                    const elem = document.getElementsByClassName("mediaContainer")[0];
                    const parent = document.getElementsByClassName("main-body")[0];
                    parent.removeChild(elem);

                    var notFound = document.createElement("div");
                    notFound.innerHTML = "404: Album Not Found";
                    notFound.style.position = "absolute";
                    notFound.style.left = "50%"
                    notFound.style.top = "50%"
                    parent.appendChild(notFound);
                }
            };
            xhttp1.open("GET", "/album/getAlbumById/" + id);
            xhttp1.send();

            // Get List of Album Songs
            const xhttp2 = new XMLHttpRequest();
            xhttp2.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // ambil data html dari response di sini
                    const res2 = JSON.parse(this.responseText);
                    // tambahin row di sini
                    setSongs(res2[0], res2[2]);
                } else if (this.status == 404) {
                    document.getElementById("daftarLagu").innerHTML = "<tr><th>No Songs Found</th></tr>";
                }
            };
            xhttp2.open("GET", "/album/getSongsByAlbumId/" + id + "/1");
            xhttp2.send();
        }

        function setData(data) {
            document.getElementById("imgCover").src = "." + data[0].Image_path;
            document.getElementById("judul").innerHTML = data[0].Judul;
            document.getElementById("penyanyi").innerHTML = data[0].Penyanyi;
            document.getElementById("durasi").innerHTML = toMinutes(data[0].Total_duration);
        }

        function setSongs(data, count) {
            document.getElementById("jumlahLagu").innerHTML = count + " Songs";
            console.log(data[0].Audio_path);
            document.getElementById("playerLagu").src = "." + data[0].Audio_path;
        }

        function toMinutes(time) {
            var mins = (~~(time / 60));
            var secs = (time - mins * 60).toFixed().toString().padStart(2, "0");
            return `${mins}:${secs}`;
        }

        function goToSongPage(id) {
            window.location.href = "/song/" + id;
        }

        <?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]) : ?>
            function toEdit(id) {
                window.location.href = "/album/" + id + "/edit";
            }
        <?php endif; ?>
    </script>
    <!-- BUAT HALAMAN NGEDIT ALBUM -->
<?php else: ?> 
    <div class="formEditAlbum">
        <div class="formWrapperUp">
            <form class="coverForm" action="/album/uploadCover" method="post" enctype="multipart/form-data">
                <img id="imgCover" alt="cover album" class="editImg">
                <div class="coverSelector">
                    <input type="file" name="file" id="fileCover" accept="image/*" onchange="handleImageFiles(this.files)">
                    <label id="selector" for="fileCover">Select Cover</label>
                    <h6 class="dragDetail" id="coverDetail">or Drag and Drop to Image Box</h6>
                </div>
            </form>
            <form method="post" action="/album/postAlbumUpdate">
                <div class="formContainer">
                    <label for="Judul" id="labelJudul">Judul</label>
                    <input type="text" class="inputField" name="Judul" id="inputJudul">
                    <label for="Tanggal" id="labelTanggal">Tanggal Terbit</label>
                    <input type="text" class="inputField" name="Tanggal" id="inputTanggal">
                    <label for="Genre" id="labelGenre">Genre</label>
                    <input type="text" class="inputField" name="Genre" id="inputGenre">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="Image_path" id="ip">
                    <input type="submit" class="saveEdit" value="Save" id="submitButton">
                    <div class="editButton" id="deleteButton">Delete</div>
                </div>
            </form>
        </div>
        <div class="laguCardWrapper">
            <?php if (empty($data["songs"])) : ?>
                <h1>Tidak ada hasil pencarian</h1>
            <?php else : ?>
                <?php foreach ($data["songs"] as $idx => $info) : ?>
                    <?= laguCardInEdit($info["album_id"], $id, $info["song_id"], $info["Judul"], $info["Penyanyi"], substr($info["Tanggal_terbit"], 0, 4), $info["Genre"], $info["Image_path"], 1) ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <script src="./js/script.js"></script>
    </body>
    <script type="text/javascript">
        const id = <?= $id ?>;

        function loadDataEdit(id) {
            const xhttp1 = new XMLHttpRequest();
            xhttp1.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // ambil data html dari response di sini
                    const res1 = JSON.parse(this.responseText);
                    // tambahin row di sini
                    setData(res1[0]);
                } else if (this.readyState == 4 && this.status == 404) {
                    const elem = document.getElementsByClassName("formEdit")[0];
                    const parent = document.getElementsByClassName("main-body")[0];
                    parent.removeChild(elem);

                    var notFound = document.createElement("div");
                    notFound.innerHTML = "404: Album Not Found";
                    notFound.style.position = "absolute";
                    notFound.style.left = "50%"
                    notFound.style.top = "50%"
                    parent.appendChild(notFound);
                }
            };
            xhttp1.open("GET", "/album/getAlbumById/" + id);
            xhttp1.send();

            // get songs inside the album and NULL
            // Get List of Album Songs
            const xhttp2 = new XMLHttpRequest();
            xhttp2.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // ambil data html dari response di sini
                    const res2 = JSON.parse(this.responseText);
                    console.log(res2);
                } else if (this.status == 404) {
                    document.getElementById("daftarLagu").innerHTML = "<tr><th>No Songs Found</th></tr>";
                }
            };
            xhttp2.open("GET", "/album/getSongsInAlbumAndNot/" + id);
            xhttp2.send();
        };

        function setData(data) {
            document.getElementById("id").value = data.album_id;
            document.getElementById("imgCover").src = "../." + data.Image_path;
            document.getElementById("inputJudul").placeholder = "Old: " + data.Judul;
            document.getElementById("inputTanggal").placeholder = "Old: " + data.Tanggal_terbit;
            document.getElementById("inputGenre").placeholder = "Old: " + data.Genre;
            document.getElementById("inputJudul").value = data.Judul;
            document.getElementById("inputTanggal").value = data.Tanggal_terbit;
            document.getElementById("inputGenre").value = data.Genre;
            document.getElementById("ip").value = data.Image_path;
        };

        

        document.getElementById("deleteButton").addEventListener("click", function() {
            const xhttp = new XMLHttpRequest();
            var formData = new FormData();
            formData.append("id", id);
            xhttp.open("POST", "/album/deleteAlbum");
            xhttp.send(formData);
            window.location.href = "/home";
        });

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
            xhttp.open("POST", "/album/uploadCover");
            xhttp.send(formData);
        }

        function setImageMeta(data) {
            document.getElementById("coverDetail").innerHTML = data["name"];
            document.getElementById("imgCover").src = "../." + data["Image_path"];
            document.getElementById("ip").value = data["Image_path"];
        }
    </script>
<?php endif; ?>