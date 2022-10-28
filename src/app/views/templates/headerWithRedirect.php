<?php

    if (isset($_SESSION["is_admin"])) {
        if ($_SESSION["is_admin"] === false) {
            header('Location: '. $data["URLRedirect"]);
            die();
        }
    } else {
        header('Location: '. $data["URLRedirect"]);
        die();
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