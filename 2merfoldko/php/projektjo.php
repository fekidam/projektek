<?php
session_start();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Zene</title>
    <link rel="icon" href="../kepek/logo.jpg"/>
    <link rel="stylesheet" href="../css/projektjo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="navbar">
    <img src="../kepek/logo.jpg" class="logo" alt="Logo">
    <ul>
        <li><a href="projektjo.php" class="active">FŐOLDAL</a></li>
        <?php if(isset($_SESSION["felhasznalonev"]) || !empty($_SESSION["felhasznalonev"])):;?>
            <li><a href="Profile.php">PROFIL</a></li>
            <li><a href="lejatszasilista.php">TOPLISTA</a></li>
            <li><a href="statisztika.php">STATISZTIKÁK</a></li>
            <li><a href="kapcsolat.php">KAPCSOLAT</a></li>
        <?php else: ?>
            <li><a href="regisztracio.php">REGISZTRÁCIÓ</a></li>
            <li><a href="login.php">BEJELENTKEZÉS</a></li>
        <?php endif; ?>
    </ul>
</div>
<div class="content">
    <div class="left-col">
        <h1>ÜDVÖZÖLLEK<br>AZ<br>OLDALON!</h1>
        <div id="hanganyag">
            <audio controls>
                <source src="../audio/zene.mp3" type="audio/mp3">
            </audio>
        </div>
    </div>
    <div class="right-col">
        <iframe id="zeneioldal" src="https://ourgenerationmusic.com/" width="400" height="400"></iframe>
    </div>
</div>
</body>
</html>
