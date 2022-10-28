<?php
    $id = $data["id"];
    $resObj = $data["status"];
    if (!$resObj) {
        http_response_code(500);
    } else {
        http_response_code(300);
    }
    header("Location: /album/" . $id);
    die();
?>