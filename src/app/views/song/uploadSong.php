<?php
    $resObj = $data["file"];
    if (!$resObj) {
        http_response_code(500);
    }
    $resArr["name"] = $data["name"];
    $resArr["img_name"] = $data["img_name"];
    $resArr["tags"] = $resObj["tags"]["id3v2"];
    $resArr["Duration"] = round($resObj["playtime_seconds"]);
    $resArr["Audio_path"] = $data["Audio_path"];
    if (isset($data["Image_path"])) {
        $resArr["Image_path"] = $data["Image_path"];
    }
    $resJson = json_encode($resArr);
    echo $resJson;
    // echo var_dump($resObj);
?>