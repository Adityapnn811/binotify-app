<?php
require_once '../app/views/templates/navbar.php';
require_once '../app/views/templates/sidebar.php';

$issong = ($data["upType"] === "Song");
?>


<body onload="loadData()">
    <?= sidebar() ?>
    <div class="main-body">
        <?= navbar("..") ?>
        <?php if ($issong) : ?>
            <div class="formEdit">
                <div class="formWrapperLeft">
                    <form class="coverForm" action="/upload/uploadCover" method="post" enctype="multipart/form-data">
                        <img id="imgCover" src="../img/laguDefault.jpg" alt="cover lagu" class="editImg">
                        <div class="coverSelector">
                            <input type="file" name="file" id="fileCover" accept="image/*" onchange="handleImageFiles(this.files)">
                            <label id="selector" for="fileCover">Select Cover</label>
                            <h6 class="dragDetail" id="coverDetail">or Drag and Drop to Image Box</h6>
                        </div>
                    </form>
                    <form method="post" action="/upload/postSongInsert">
                        <div class="formContainer" id="uploadContainer">
                            <label for="Judul" id="labelJudul">Judul</label>
                            <input type="text" class="inputField" name="Judul" id="inputJudul">
                            <label for="Penyanyi" id="labelPenyanyi">Penyanyi</label>
                            <input type="text" class="inputField" name="Penyanyi" id="inputPenyanyi">
                            <label for="Tanggal" id="labelTanggal">Tanggal Terbit</label>
                            <input type="text" class="inputField" name="Tanggal" id="inputTanggal">
                            <label for="Genre" id="labelGenre">Genre</label>
                            <input type="text" class="inputField" name="Genre" id="inputGenre">
                            <input type="hidden" name="Duration" id="dur">
                            <input type="hidden" name="Audio_path" id="ap">
                            <input type="hidden" name="Image_path" id="ip">
                            <input type="submit" class="saveEdit" value="Save" id="submitButton">
                        </div>
                    </form>
                </div>
                <div class="dropSong" id="dropArea">
                    <form action="/upload/uploadSong" method="post" enctype="multipart/form-data">
                        <input type="file" name="file" id="fileSong" accept="audio/*" onchange="handleFiles(this.files)">
                        <label id="selector" for="fileSong">Select Song</label>
                    </form>
                    <h6 class="dragDetail" id="songDetail">or Drag and Drop Here</h6>
                </div>
            </div>
</body>
<script type="text/javascript">
    function loadData() {
        document.getElementById("inputJudul").placeholder = "e.x. Smoke on the Water";
        document.getElementById("inputPenyanyi").placeholder = "e.x. Deep Purple";
        document.getElementById("inputTanggal").placeholder = "e.x. 1972-12-25";
        document.getElementById("inputGenre").placeholder = "e.x. Classic Rock";
    };

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
        xhttp.open("POST", "/upload/uploadSong");
        xhttp.send(formData);
    }

    function setMeta(data) {
        document.getElementById("inputJudul").value = data.title[0];
        document.getElementById("inputPenyanyi").value = data.artist[0];
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
        xhttp.open("POST", "/upload/uploadCover");
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
<?php else : ?>

<?php endif; ?>