<?php
session_start();
if (!isset($_SESSION["felhasznalonev"])) {
    // ha a felhasználó nincs belépve akkor a login.php-ra navigálunk.
    header("Location: login.php");
}
$elsoalap=0;
$masodikalap=0;
$harmadikalap=0;
$negyedikalap=0;
$otodikalap=0;
$hatodikalap=0;
$hetedikalap=0;
$nyolcadikalap=0;
$kilencedikalap=0;
$tizedikalap=0;
$user=$_SESSION["felhasznalonev"];
$lejatszasok=array();
$kedvelesek=fopen("../txt/likeok.txt","r");
while (($line = fgets($kedvelesek)) !== FALSE ) {
    $tmp=explode(",",$line)[1];
    switch ($tmp) {
        case "elsokep\n":
            $elsoalap++;
            break;
        case "masodikkep\n":
            $masodikalap++;
            break;
        case "harmadikkep\n":
            $harmadikalap++;
            break;
        case "negyedikkep\n":
            $negyedikalap++;
            break;
        case "otodikkep\n":
            $otodikalap++;
            break;
        case "hatodikkep\n":
            $hatodikalap++;
            break;
        case "hetedikkep\n":
            $hetedikalap++;
            break;
        case "nyolcadikkep\n":
            $nyolcadikalap++;
            break;
        case "kilencedikkep\n":
            $kilencedikalap++;
            break;
        case "tizedikkep\n":
            $tizedikalap++;
            break;
    }
}
fclose($kedvelesek);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Statisztikák</title>
    <link rel="icon" href="../kepek/logo.jpg"/>
    <link rel="stylesheet" type="text/css" href="../css/projektjo.css">
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
                <li><a href="statisztika.php" class="active">STATISZTIKÁK</a></li>
                <li><a href="kapcsolat.php">KAPCSOLAT</a></li>
            <?php else: ?>
                <li><a href="regisztracio.php">REGISZTRÁCIÓ</a></li>
                <li><a href="login.php">BEJELENTKEZÉS</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<main>
    <h2>Legkedveltebb zenéink</h2>
    <table>
        <tr>
            <th>#</th>
            <th>Zenecím</th>
            <th>Előadó</th>
            <th>Összes kedvelés</th>
        </tr>
        <tr>
            <td>1</td>
            <td> BZRP Music Sessions #53</td>
            <td>Shakira</td>
            <td><?php echo "$elsoalap"?></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Flowers</td>
            <td>Miley Cyrus</td>
            <td><?php echo "$masodikalap"?></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Song for You</td>
            <td>Lee Isaacs</td>
            <td><?php echo "$harmadikalap"?></td>
        </tr>
        <tr>
            <td>4</td>
            <td>TQG</td>
            <td>KAROL G, Shakira</td>
            <td><?php echo "$negyedikalap"?></td>
        </tr>
        <tr>
            <td>5</td>
            <td>DUMB (feat. Moneybagg Yo)</td>
            <td>Rican Da Menace</td>
            <td><?php echo "$otodikalap"?></td>
        </tr>
        <tr>
            <td>6</td>
            <td>Boy’s a liar Pt. 2</td>
            <td>PinkPantheress, Ice Spice</td>
            <td><?php echo "$hatodikalap"?></td>
        </tr>
        <tr>
            <td>7</td>
            <td>Kill Bill</td>
            <td>SZA</td>
            <td><?php echo "$hetedikalap"?></td>
        </tr>
        <tr>
            <td>8</td>
            <td>Lavender Haze</td>
            <td>Taylor Swift</td>
            <td><?php echo "$nyolcadikalap"?></td>
        </tr>
        <tr>
            <td>9</td>
            <td> I'm Not Here To Make Friends</td>
            <td>Sam Smith</td>
            <td><?php echo "$kilencedikalap"?></td>
        </tr>
        <tr>
            <td>10</td>
            <td>Last Last</td>
            <td>Burna Boy</td>
            <td><?php echo "$tizedikalap"?></td>
        </tr>
    </table>
</main>
</body>
</html>

