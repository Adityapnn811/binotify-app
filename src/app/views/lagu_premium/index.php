<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon">
        <title>Jam Up Your Day With Binotify</title>
        <!-- Masukin StyleSheet CSS di sini -->
        <link rel="stylesheet" href="/css/styles.css" >
        <link rel="stylesheet" href="/css/search.css" >
        <link rel="stylesheet" href="/css/lagu_premium.css" >
    </head>

<?php
    require_once "../app/views/templates/lagu_premium.php";
    require_once "../app/views/templates/paginationButton.php";    
    require_once '../app/views/templates/navbar.php';
    require_once '../app/views/templates/sidebar.php';
    $body = array(
        'subscriber_id' => $_SESSION["user_id"],
    );
    $opts = array('http' =>
                array(
                    'method'  => 'GET',
                    'header'  => 'Content-Type: application/json',
                    'content' => json_encode($body)
                )
            );

    $context  = stream_context_create($opts);
    $id_penyanyi = $data["id_penyanyi"];
    $urlnya = "http://binotify-rest:5000/penyanyi/$id_penyanyi/song";
    $response = file_get_contents($urlnya, false, $context);
    $response = json_decode($response, true);

    $responses = $response["data"]
?>

<?= sidebar() ?>

<div class="main-body">
<?= navbar("..") ?>

<div class="cardContainerPrem">
    <div class="lagu-prem-title">
        Lagu Premium
    </div>
    <div class="lagu-premium-container">
        <div class="lagu-pre-card-container">
            <?php 
            $number = 1
            ?>

            <?php foreach($responses as $info): ?>
                <?= laguCardPremium($number, $info["song_id"], $info["Judul"], $info["Audio_path"])?>
                <?php $number = $number + 1?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>

<script>
    function Play(audiopath){
        var myAudio = document.getElementById(audiopath);
        playbutton = "play" + audiopath;
        var myButtonPlay = document.getElementById(playbutton);
        stopbutton = "stop" + audiopath;
        var myButtonStop = document.getElementById(stopbutton);
        if(myAudio.paused) {
            myAudio.currentTime = 0;
            myAudio.play();
            myButtonPlay.style.display = "none";
            myButtonStop.style.display = "block";

        }else {
            myAudio.pause();
            myButtonPlay.style.display = "block";
            myButtonStop.style.display = "none";
        }
    }
</script>

</html>