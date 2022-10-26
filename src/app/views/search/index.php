<?php
    require_once "../app/views/templates/laguCard.php";
    require_once "../app/views/templates/paginationButton.php";
    require_once '../app/views/templates/navbar.php';
?>

<?= navbar() ?>
<div class="searchContainer">
    <div class = "wrap">
        <header>
            <div class="search">
                <form method="post" action="/search">
                    <div class="querySearch">
                        <input type="hidden" name="page" value="1"/>
                        <input type="text" name="q" id="q" placeholder="Masukkan judul, tahun, penyanyi" class="searchTerm" autocomplete="off"/>
                        <button type="submit" class="searchButton"><img src="./img/search.png" width="33px" alt="magnifying glass icon"></button>
                    </div>
                    <div class="condSearch">
                        <label class="labelSearch" for="sort">Sort A-Z</label>
                        <select name="sort" id="sort" class="sort">
                            <option value="Asc">Ascending</option>
                            <option value="Desc">Descending</option>
                        </select>
                        <label class="labelSearch" for="sortYear">Sort Year</label>
                        <select name="sortYear" id="sortYear" class="sort">
                            <option value="Asc">Ascending</option>
                            <option value="Desc">Descending</option>
                        </select>
                        <label for="genre" class="labelSearch">Genres</label>
                        <input type="text" name="genre" id="genre" placeholder="pop, rock" autocomplete="off"/>
                    </div>
                    
                </form>
            </div>
        </header>
    </div>

    <div class="cardContainer">
        <?php if (empty($data["lagu"])): ?>
            <h1>Tidak ada hasil pencarian</h1>
        <?php else : ?>
            <?php foreach($data["lagu"] as $idx=>$info): ?>
                <?= laguCard($info["song_id"], $info["Judul"], $info["Penyanyi"], substr($info["Tanggal_terbit"], 0, 4), $info["Genre"], $info["Image_path"]) ?>
            <?php endforeach; ?>
            <div class="pagination">
                <?php for($page = 1; $page<= $data["maxPage"]; $page++): ?>
                    <?php empty($_POST) ? $currentPage = 1 : $currentPage = (int) $_POST["page"] ?>
                    <?= paginationSearchButton($_POST, $currentPage, "/search", $page) ?>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>

</div>