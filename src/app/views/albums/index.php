<?php
    require_once "../app/views/templates/albumCard.php";
    require_once "../app/views/templates/paginationButton.php";
    require_once '../app/views/templates/navbar.php';
    require_once '../app/views/templates/sidebar.php';
?>

<?= sidebar() ?>

<div class="main-body">
<?= navbar() ?>
<div class="cardContainer">
    <h2>Daftar Album</h2>
    <?php foreach($data["albums"] as $idx=>$info): ?>
        <?= albumCard($info["album_id"], $info["Judul"], $info["Penyanyi"], substr($info["Tanggal_terbit"], 0, 4), $info["Genre"], $info["Image_path"]) ?>
    <?php endforeach; ?>

    <div class="pagination">
        <?php for($page = 1; $page<= $data["maxPage"]; $page++): ?>
            <?php empty($_POST) ? $currentPage = 1 : $currentPage = (int) $_POST["page"] ?>
            <?= paginationAlbumButton($_POST, $currentPage, "/albums", $page) ?>
        <?php endfor; ?>
    </div>
</div>
</div>