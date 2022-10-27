<?php
    $error = "";
    if (!empty($data)) {
        // login button clicked
        // cek apakah berhasil
        if ($data["status"] == 200){
            $_SESSION["username"] = $data["username"];
            $_SESSION["is_admin"] = $data["is_admin"];
            header('location: /home');
            die();
        }else{
            $error = $data["error"];
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
        <link rel="stylesheet" href="/css/login.css" >
    </head>
    <body>
