<?php 
    require_once "../app/views/templates/paginationButton.php";
    require_once '../app/views/templates/navbar.php';
?>

<?= navbar() ?>
<body onload="loadData()">
    <div class="cardContainer">
        <h2>Daftar User</h2>
        <table id="listUser"></table>
        <!-- Max page nya gimana ya -->
        <div class="pagination" id="pagination">
            
        </div>
    </div>
</body>

<script type="text/javascript">
    let pageNow = 1;
    function loadData() {
        // Masukkin xml di sini
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // ambil data html dari response di sini
                const res = JSON.parse(this.responseText);
                // tambahin row di sini
                addRow(res[0]);
                renderButton(pageNow, res[1]);
            }
        };
        xhttp.open("GET", "/users/getUsers/1");
        xhttp.send();
    }

    function addRow(data) {
        let table="<tr><th>User ID</th><th>Username</th><th>Email</th></tr>";
        for (let i=0; i<data.length; i++) {
            table += "<tr><td>" +
            data[i].user_id +
            "</td><td>" +
            data[i].username +
            "</td><td>" +
            data[i].email +
            "</td></tr>";
        }
        document.getElementById("listUser").innerHTML = table;
    }

    // nanti select button dengan id page tertentu, terus diwarnain
    function goToPage(page) {
        // Masukkin xml di sini
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // ambil data html dari response di sini
                const res = JSON.parse(this.responseText);
                // tambahin row di sini
                addRow(res[0]);
                renderButton(page, res[1]);
            }
        };
        xhttp.open("GET", "/users/getUsers/" + page);
        xhttp.send();
    }

    // Render button lewat sini
    function renderButton(page, maxPage) {
        let component = "";
        for (let i = 1; i <= maxPage; i++) {
            if (page === i) {
                component += '<button type="button" class="paginationButtonCurrent" onclick="goToPage(' + i + ')">'+ i + '</button>';
            } else {
                component += '<button type="button" class="paginationButton" onclick="goToPage(' + i + ')">'+ i + '</button>';
            }
        }
        document.getElementById("pagination").innerHTML = component;
    }
</script>