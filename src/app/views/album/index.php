<?php
require_once "../app/views/templates/laguCard.php";
require_once "../app/views/templates/paginationButton.php";
require_once '../app/views/templates/navbar.php';
require_once '../app/views/templates/sidebar.php';
?>
<?php
$id = $data["id"];
$body = <<<"EOT"
            <body onload="loadData($id)">
                <div class="main-body">
    EOT;
$body_end = <<<"EOT"
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
            EOT;
echo sidebar();
echo $body;
echo navbar("..");
echo $body_end;
?>

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
</div>
</body>
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
</script>