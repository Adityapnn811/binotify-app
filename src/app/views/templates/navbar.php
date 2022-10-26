<?php 
    function navbar(){
        $start = <<<"EOT"
            <nav>
            <div id="navLinks">
                <a href="/">Home</a>
                <a href="/albums">Daftar Album</a>
            EOT;
        $middle = <<<"EOT"
            </div>
            <div id="navItems">
            <form method="post" action="/search">
                <div class="querySearchNavbar">
                    <input type="hidden" name="page" value="1"/>
                    <input type="hidden" name="sort" value="asc"/>
                    <input type="hidden" name="sortYear" value=""/>
                    <input type="hidden" name="genre" value=""/>
                    <input type="text" name="q" id="q" placeholder="Masukkan judul, tahun, penyanyi" class="searchTerm" autocomplete="off"/>
                    <button type="submit" class="searchButton"><img src="./img/search.png" width="33px" alt="magnifying glass icon"></button>
                </div>
            </form>
        EOT;
        if (!isset($_SESSION["username"])) {
            $end = <<<"EOT"
                <button class="greenButton">
                    <a href="/login">LOGIN</a>
                </button>
                </div>
                </nav>
            EOT;
        } else {
            $username = $_SESSION["username"];
            if ($_SESSION["is_admin"]) {
                $start .= <<<"EOT"
                    <a href="/users">Daftar User</a>
                    <div class="dropdown">
                        <button class="dropbtn">Tambah >
                        </button>
                        <div class="dropdown-content">
                            <a href="#">Tambah Lagu</a>
                            <a href="#">Tambah Album</a>
                        </div>
                    </div>
                EOT;
            }
            $end = <<<"EOT"
            <div class="dropdown username">
                <button class="dropbtn" id="usernamebtn">Hi, $username!
                </button>
                <div class="dropdown-content">
                    <a href="/login/logout" id="logout">Log out</a>
                </div>
            </div>
            </div>
            </nav>
            EOT;
        }
        
        

        echo $start.$middle.$end;
    }
?>