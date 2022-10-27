<?php
    $resObj = $data["song"];
    if (!$resObj) {
        http_response_code(404);
    }
    $resJson = json_encode($resObj);
    echo $resJson;
?>