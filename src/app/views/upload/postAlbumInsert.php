<?php
    $resObj = $data["status"];
    if (!$resObj) {
        http_response_code(500);
        header("Location: /upload/Album");
    } else {
        http_response_code(300);
    }
    header("Location: /home");
    die();
?>