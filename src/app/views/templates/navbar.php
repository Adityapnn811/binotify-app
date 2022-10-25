<?php 
    function navbar(){
        $html = <<<"EOT"
            <form method="post" action="/search">
                <div class="querySearchNavbar">
                    <input type="hidden" name="page" value="1"/>
                    <input type="text" name="q" id="q" placeholder="Masukkan judul, tahun, penyanyi" class="searchTerm" autocomplete="off"/>
                    <button type="submit" class="searchButton"><img src="./img/search.png" width="33px" alt="magnifying glass icon"></button>
                </div>
            </form>
            EOT;
        if (!isset($_SESSION["username"])) {
            $html .= <<<"EOT"
                <a href="/login"> login </a>
            EOT;
        } else {
            if ($_SESSION["is_admin"]) {
                $html .= <<<"EOT"
                    <a href="/">Home</a>
                    <a href="/albums">Daftar Album</a>
                    <a href="/users">Daftar Users</a>
                    <a href="/login/logout">Log Out</a>
                    EOT;
            } else {
                $html .= <<<"EOT"
                    <a href="/">Home</a>
                    <a href="/albums">Daftar Album</a>
                    <a href="/login/logout">Log Out</a>
                EOT;
            }
        }
        
        

        echo $html;
    }
?>