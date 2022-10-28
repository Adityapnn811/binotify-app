<?php
    $resObj = $data["songs"];
    if ($resObj[0] === []) {
        http_response_code(404);
    }
    $resJson = json_encode($resObj);
    echo $resJson;
?>