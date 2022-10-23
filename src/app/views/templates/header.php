<?php session_start(); /* Starts the session */
    $uname = "user";
    $is_admin = "as_admin";
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
        <nav class="navbar">
            <a>Navbar</a>
            <?php if ($is_admin) : ?>
                <a> Tambah Lagu</a>
                <a> Tambah Album</a>
                <a> Daftar Album</a>
                <a> Logout</a>
            <?php else : ?>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search Lagu</button>
                </form>
                <a href="./logout.php">Daftar Album</a>
                <a href="./dashboard.php">Logout</a>
            <?php endif; ?>
        </nav>


    </body>

</html>