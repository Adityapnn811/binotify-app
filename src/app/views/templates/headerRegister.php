<?php
    $error = "";
    if (isset($_SESSION["username"])) {
        header('location: /home');
        die();
    }
    if (!empty($data)) {
        // Register button clicked
        // cek apakah berhasil
        if ($data["status"] == 200){
            $_SESSION["username"] = $data["username"];
            $_SESSION["is_admin"] = false;
            header('location: /home');
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
        <link rel="stylesheet" href="/css/login.css" >
        <link rel="stylesheet" href="/css/register.css" >
    </head>
    <body id="bodyNoNavbar">