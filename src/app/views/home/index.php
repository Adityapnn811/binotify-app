<?php
    require_once "../app/views/templates/laguCard.php";
    require_once "../app/views/templates/paginationButton.php";    
    require_once '../app/views/templates/navbar.php';
?>

<?= navbar() ?>

<div class="cardContainer">
    <h1> Welcome to Binotify </h1>
            <?php foreach($data["lagu"] as $idx=>$info): ?>
                <?= laguCard($info["song_id"], $info["Judul"], $info["Penyanyi"], substr($info["Tanggal_terbit"], 0, 4), $info["Genre"], $info["Image_path"]) ?>
            <?php endforeach; ?>
    </div>

