<?php 
    function sidebar(){
        $html = <<<"EOT"
            <div class="sidebar">
                <a href="/" id="binotify-title">|| Binotify</a>
                <a href="/search">Search</a>
                <a href="/albums">Daftar Album</a>
                <a href ="/lagu_premium">Lagu Premium</a>
            EOT;

        if (isset($_SESSION["username"])) {
            if ($_SESSION["is_admin"]) {
                $html .= <<<"EOT"
                    <a href="/users">Daftar User</a>
                    <a href="/upload/Song">Tambah Lagu</a>
                    <a href="/upload/Album">Tambah Album</a>
                    
                EOT;
            }
        }
        $html .= "</div>";
        echo $html;
    }
?>