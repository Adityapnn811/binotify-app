<?php
    require_once "../app/views/templates/laguCard.php";
    require_once "../app/views/templates/paginationButton.php";    
    require_once '../app/views/templates/navbar.php';
    require_once '../app/views/templates/sidebar.php';
?>

<?= sidebar() ?>

<div class="main-body">
<?= navbar() ?>

<div class="cardContainer">
    <?php if (isset($_SESSION["username"])): ?>
        <h1>Welcome back, <?= $_SESSION["username"] ?>!</h1>
    <?php else : ?>
        <h1> Welcome to Binotify </h1>
    <?php endif; ?>
    <?php foreach($data["lagu"] as $idx=>$info): ?>
        <?= laguCard($info["song_id"], $info["Judul"], $info["Penyanyi"], substr($info["Tanggal_terbit"], 0, 4), $info["Genre"], $info["Image_path"]) ?>
    <?php endforeach; ?>
</div>
</div>

