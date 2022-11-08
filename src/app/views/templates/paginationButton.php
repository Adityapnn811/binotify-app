<?php
    function paginationSearchButton($post, $currentPage, $action="/search", $page=1) {
        if (count($_POST) === 0) {
            $q = "";
            $genre = "";
            $sort = "asc";
            $sortYear = "";
        } else {
            $q = $post["q"];
            $genre = $post["genre"];
            $sort = $post["sort"];
            $sortYear = $post["sortYear"];
        }
        $class = "paginationButton";
        if ($currentPage === $page) {
            $class = "paginationButtonCurrent";
        }
        $html = <<<"EOT"
            <form method="post" action=$action>
                    <input type="hidden" name="page" value="$page"/>
                    <input type="hidden" name="q" id="q" value="$q" />
                    <input type="hidden" name="sort" id="sort" value="$sort"/>
                    <input type="hidden" name="sortYear" id="sortYear" value="$sortYear"/>
                    <input type="hidden" name="genre" id="genre" value="$genre"/>
                    <button type="submit" class="$class">$page</button>
            </form>
            EOT;

        echo $html;
    }

    function paginationAlbumButton($post, $currentPage, $action="/search", $page=1) {
        if (count($_POST) === 0) {
            $q = "";
            $genre = "";
            $sort = "None";
            $sortYear = "None";
        } else {
            $q = $post["q"];
            $genre = $post["genre"];
            $sort = $post["sort"];
            $sortYear = $post["sortYear"];
        }
        $class = "paginationButton";
        if ($currentPage === $page) {
            $class = "paginationButtonCurrent";
        }
        $html = <<<"EOT"
            <form method="post" action=$action>
                    <input type="hidden" name="page" value="$page"/>
                    <input type="hidden" name="q" id="q" value="$q" />
                    <input type="hidden" name="sort" id="sort" value="$sort"/>
                    <input type="hidden" name="sortYear" id="sortYear" value="$sortYear"/>
                    <input type="hidden" name="genre" id="genre" value="$genre"/>                
                    <button type="submit" class="$class">$page</button>
            </form>
            EOT;

        echo $html;
    }
?>