<?php
    $resObj = $data["name"];
    if (!$resObj) {
        http_response_code(404);
    }
    $resJson = json_encode($resObj);
    echo $resJson;
?>