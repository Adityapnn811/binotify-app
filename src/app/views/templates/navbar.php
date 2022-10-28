<?php 
    function navbar($imgPath = "."){
        $start = <<<"EOT"
            <nav>
            EOT;
        $middle = <<<"EOT"
            <div id="navItems">
            <form method="post" action="/search">
                <div class="querySearchNavbar">
                    <input type="hidden" name="page" value="1"/>
                    <input type="hidden" name="sort" value="asc"/>
                    <input type="hidden" name="sortYear" value=""/>
                    <input type="hidden" name="genre" value=""/>
                    <input type="text" name="q" id="q" placeholder="Masukkan judul, tahun, penyanyi" class="searchTerm" autocomplete="off"/>
                    <button type="submit" class="searchButton"><img src= "$imgPath/img/search.png" width="33px" alt="magnifying glass icon"></button>
                </div>
            </form>
        EOT;
        if (!isset($_SESSION["username"])) {
            $end = <<<"EOT"
                <button class="greenButton">
                    <a href="/login">Log in</a>
                </button>
                </div>
                </nav>
            EOT;
        } else {
            $username = $_SESSION["username"];
            $end = <<<"EOT"
            <div class="dropdown">
                <button class="dropbtn" id="usernamebtn">$username
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