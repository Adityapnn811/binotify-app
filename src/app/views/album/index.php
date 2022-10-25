<?php
    $id = $data["id"];
    $body = <<<"EOT"
            <body onload="loadData($id)">
                <div class="cardContainer">
                    <h2>Album</h2>
                    <table id="detilAlbum"></table>
                </div>
            </body>
            EOT;
    echo $body;
?>

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
                const elem = document.getElementsByClassName("cardContainer")[0];
                elem.remove();
                document.body.appendChild(document.createElement("h1").appendChild(document.createTextNode("404: Not Found")));
            }
        };
        xhttp.open("GET", "/album/getAlbumById/" + id);
        xhttp.send();
    }

    function setData(data) {
        let table = "<tr><th>Judul</th><th>"          + data[0].Judul          + "</th></tr>"
                  + "<tr><th>Penyanyi</th><th>"       + data[0].Penyanyi       + "</th></tr>"
                  + "<tr><th>Total Durasi</th><th>"   + data[0].Total_duration + "</th></tr>"
        document.getElementById("detilAlbum").innerHTML = table;
    }
</script>