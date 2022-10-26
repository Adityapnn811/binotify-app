<?php
    $error = "";
    if (!empty($data)) {
        // Register button clicked
        // cek apakah berhasil
        if ($data["status"] == 200){
            header('location: /home/index');
            die();
        }else{
            $error = $data["error_msg"];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="./img/logo.png">
        <title>Jam Up Your Day With Binotify</title>
        <!-- Masukin StyleSheet CSS di sini -->
        <link rel="stylesheet" href="/css/styles.css" >
        <link rel="stylesheet" href="/css/search.css" >
    </head>
    <body>