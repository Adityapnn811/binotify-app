<?php
    $resObj = $data;
    if (!isset($resObj["Image_path"])) {
        http_response_code(500);
    }
    $resJson = json_encode($resObj);
    echo $resJson;
    // echo var_dump($resObj);
?>