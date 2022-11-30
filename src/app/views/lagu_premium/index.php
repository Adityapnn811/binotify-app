<?php
    require_once "../app/views/templates/lagu_premium.php";
    require_once "../app/views/templates/paginationButton.php";    
    require_once '../app/views/templates/navbar.php';
    require_once '../app/views/templates/sidebar.php';
?>

<?= sidebar() ?>

<div class="main-body">
<?= navbar() ?>

<div class="cardContainerPrem">
    <div class="lagu-prem-title">
        Lagu Premium
    </div>
    <div class="lagu-premium-container">
        <div class="lagu-pre-card-container">
            <?php 
            $number = 1
            ?>
    
            <?php foreach($data["lagu"] as $idx=>$info): ?>
                <?= laguCardPrem($number, $info["song_id"], $info["Judul"], $info["Penyanyi"], substr($info["Tanggal_terbit"], 0, 4), $info["Genre"], $info["Image_path"])?>
                <?php $number = $number + 1?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>

