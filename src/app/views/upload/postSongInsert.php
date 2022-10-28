<?php
    $resObj = $data["status"];
    if (!$resObj) {
        http_response_code(500);
        header("Location: /upload/Song");
    } else {
        http_response_code(300);
    }
    header("Location: /home");
    die();
?>