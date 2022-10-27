<?php
    require_once "../app/views/templates/laguCard.php";
    require_once "../app/views/templates/paginationButton.php";
    require_once '../app/views/templates/navbar.php';
    require_once '../app/views/templates/sidebar.php';
?>

<?= navbar() ?>
<?php
    $id = $data["id"];
    $body = <<<"EOT"
            <body onload="loadData($id)">
            <div class="main-body">
    EOT;
    $body_end = <<<"EOT"
                <div class="cardContainer">
                    <h2>Album</h2>
                    <table id="detilAlbum"></table>
                    <h2>Songs</h2>
                    <table id="daftarLagu"></table>
                </div>
            </div>
            </body>
            EOT;
    echo sidebar();
    echo $body;
    echo navbar("..");
    echo $body_end;
?>

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
            } else if (this.status == 404) {
                const elem = document.getElementsByClassName("cardContainer")[0];
                elem.remove();
                document.body.appendChild(document.createElement("h1").appendChild(document.createTextNode("404: Not Found")));
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
                setSongs(res2[0]);
            } else if (this.status == 404) {
                document.getElementById("daftarLagu").innerHTML = "<tr><th>No Songs Found</th></tr>";
            }
        };
        xhttp2.open("GET", "/album/getSongsByAlbumId/1/" + id);
        xhttp2.send();
    }

    function setData(data) {
        let table = "<tr><th>Judul</th><th>"          + data[0].Judul          + "</th></tr>"
                  + "<tr><th>Penyanyi</th><th>"       + data[0].Penyanyi       + "</th></tr>"
                  + "<tr><th>Total Durasi</th><th>"   + data[0].Total_duration + "</th></tr>"
        document.getElementById("detilAlbum").innerHTML = table;
    }
    
    function setSongs(data) {
        let table="<tr><th>User ID</th><th>Username</th><th>Email</th></tr>";
        for (datum in data) {
            table += "<tr><td>" +
            datum.user_id +
            "</td><td>" +
            datum.username +
            "</td><td>" +
            datum.email +
            "</td></tr>";
        }
        document.getElementById("daftarLagu").innerHTML = table;
    }
</script>