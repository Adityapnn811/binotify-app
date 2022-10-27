<?php
    require_once '../app/views/templates/navbar.php';
    $id = $data["id"];
    $body = <<<"EOT"
            <body onload="loadData($id)">
                <div class="cardContainer">
                    <h2>Lagu</h2>
                    <table id="detilLagu"></table>
                </div>
            </body>
            EOT;
    echo navbar();
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
                elem.parentNode.removeChild(elem);
                document.body.appendChild(document.createElement("h1").appendChild(document.createTextNode("404: Not Found")));
            }
        };
        xhttp.open("GET", "/song/getSongById/" + id);
        xhttp.send();
    }

    function setData(data) {
        let table = "<tr><th>Judul</th><th>"          + data[0].Judul          + "</th></tr>"
                  + "<tr><th>Penyanyi</th><th>"       + data[0].Penyanyi       + "</th></tr>"
                  + "<tr><th>Tanggal Terbit</th><th>" + data[0].Tanggal_terbit + "</th></tr>"
                  + "<tr><th>Genre</th><th>"          + data[0].Genre          + "</th></tr>"
                  + "<tr><th>Duration</th><th>"       + data[0].Duration       + "</th></tr>";
        document.getElementById("detilLagu").innerHTML = table;
    }
</script>