<?php
session_start();
include "kozos.php";              // beágyazzuk a loadUsers() és saveUsers() függvényeket tartalmazó PHP fájlt
if (!isset($_SESSION["felhasznalonev"])) {
    // ha a felhasználó nincs belépve akkor a login.php-ra navigálunk.
    header("Location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Az űrlap elküldésekor fájlba írjuk az üzenetet
    $nev = $_POST["nev"];
    $telefonszam = $_POST["telefonszam"];
    $email = $_POST["email"];
    $uzenet = $_POST["uzenet"];

    $file = fopen("../txt/uzenetek.txt", "a");
    fwrite($file, $nev . "|" . $telefonszam . "|" . $email . "|" . $uzenet . "\n");
    fclose($file);
}

$uzenetek = array();

// beolvassuk az üzeneteket a fájlból
$file = fopen("../txt/uzenetek.txt", "r");  //TODO
if ($file) {
    while (($line = fgets($file)) !== false) {
        $uzenet = explode("|", $line);
        $uzenetek[] = $uzenet;
    }
    fclose($file);
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Kapcsolat</title>
    <link rel="icon" href="../kepek/logo.jpg"/>
    <link rel="stylesheet" href="../css/projektjo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="head">
    <div class="navbar">
        <img src="../kepek/logo.jpg" class="logo" alt="Logo">
        <ul>
            <li><a href="projektjo.php">FŐOLDAL</a></li>
            <?php if(isset($_SESSION["felhasznalonev"]) || !empty($_SESSION["felhasznalonev"])):;?>
                <li><a href="Profile.php">PROFIL</a></li>
                <li><a href="lejatszasilista.php">TOPLISTA</a></li>
                <li><a href="statisztika.php">STATISZTIKÁK</a></li>
                <li><a href="kapcsolat.php" class="active">KAPCSOLAT</a></li>
            <?php else: ?>
                <li><a href="regisztracio.php">REGISZTRÁCIÓ</a></li>
                <li><a href="login.php">BEJELENTKEZÉS</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<div class="hero">
    <form action="uzenetek.php" method="POST">
        <div class="row">
            <div class="input-group">
                <input type="text" id="nev" name="nev">
                <label for="nev">NÉV</label>
            </div>
            <div class="input-group">
                <input type="text" id="szam" name="telefonszam">
                <label for="szam">TELEFONSZÁM</label>
            </div>
        </div>
        <div class="input-group">
            <input type="email" id="cim" name="email">
            <label for="cim">E-MAIL CÍM</label>
        </div>
        <div class="input-group">
            <textarea id="uzenet" rows="8" name="uzenet"></textarea>
            <label for="uzenet">ÜZENET</label>
        </div>
        <button type="submit">ELKÜLDÉS</button>
    </form>
</div>
</body>
</html>

