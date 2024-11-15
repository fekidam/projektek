<?php
session_start();
if (!isset($_SESSION["felhasznalonev"])) {
    // ha a felhasználó nincs belépve akkor a login.php-ra navigálunk.
    header("Location: login.php");
}
$user=$_SESSION["felhasznalonev"];
$sgd2=null;
$sgd2=array();
$i=0;
$melyik_felhasznalo_melyik_zene=fopen("../txt/likeok.txt","r");
while (($line = fgets($melyik_felhasznalo_melyik_zene)) !== FALSE ) {
    $sgd=explode(",",$line);
    if($user==$sgd[0]){
        //array_unshift($sgd2,$sgd[1]);

        $sgd2[$i]=strval($sgd[1]);
        $i++;
    }
}
fclose($melyik_felhasznalo_melyik_zene);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toplista</title>
    <link rel="icon" href="../kepek/logo.jpg"/>
    <link rel="stylesheet" href="../css/projektjo.css">
</head>
<body>
<div class="head">
    <div class="navbar">
        <img src="../kepek/logo.jpg" class="logo" alt="Logo">
        <ul>
            <li><a href="projektjo.php">FŐOLDAL</a></li>
            <?php if(isset($_SESSION["felhasznalonev"]) || !empty($_SESSION["felhasznalonev"])):;?>
                <li><a href="Profile.php">PROFIL</a></li>
                <li><a href="lejatszasilista.php" class="active">TOPLISTA</a></li>
                <li><a href="statisztika.php">STATISZTIKÁK</a></li>
                <li><a href="kapcsolat.php">KAPCSOLAT</a></li>
            <?php else: ?>
                <li><a href="regisztracio.php">REGISZTRÁCIÓ</a></li>
                <li><a href="login.php">BEJELENTKEZÉS</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<div class = "container">
    <div class = "heading">TOP 10 SLÁGERLISTA</div>
    <div class="music-container">
        <form action="likeolas.php" method="Post">
            <div class="box">
                <div class="image">
                    <img src="../kepek/elso.png" alt="" height="200" width="200">
                </div>
                <div class="music">
                    <a>SHAKIRA || BZRP Music Sessions #53</a>
                    <audio src="../audio/top1.mp3" controls></audio>
                    <input type="submit" value="❤️" name="tetszik" style=<?php if(in_array("elsokep\n",$sgd2)){echo "background-color:blue;";}else{echo "background-color:green;";} ?>>
                    <input type="hidden" name="tetszikzene" value="elsokep">
                </div>
            </div>
        </form>

        <form action="likeolas.php" method="Post">
        <div class="box">
            <div class="image">
                <img src="../kepek/masodik.png" alt="" height="200" width="200">
            </div>
            <div class="music">
                <a>Miley Cyrus - Flowers</a>
                <audio src="../audio/top2.mp3" controls></audio>
                <input type="submit" value="❤️" name="tetszik" style="<?php if(in_array("masodikkep\n",$sgd2)){echo "background-color:blue;";}else{echo "background-color:green;";} ?>">
                <input type="hidden" name="tetszikzene" value="masodikkep">
            </div>
        </div>
        </form>

        <form action="likeolas.php" method="Post">
        <div class="box">
            <div class="image">
                <img src="../kepek/harmadik.png" alt="" height="200" width="200">
            </div>
            <div class="music">
                <a>Lee Isaacs - Song for You</a>
                <audio src="../audio/top3.mp3" controls></audio>
                <input type="submit" value="❤️" name="tetszik" style="<?php if(in_array("harmadikkep\n",$sgd2)){echo "background-color:blue;";}else{echo "background-color:green;";} ?>">
                <input type="hidden" name="tetszikzene" value="harmadikkep">
            </div>
        </div>
        </form>

        <form action="likeolas.php" method="Post">
        <div class="box">
            <div class="image">
                <img src="../kepek/negyedik.png" alt="" height="200" width="200">
            </div>
            <div class="music">
                <a>KAROL G, Shakira - TQG</a>
                <audio src="../audio/top4.mp3" controls></audio>
                <input type="submit" value="❤️" name="tetszik" style="<?php if(in_array("negyedikkep\n",$sgd2)){echo "background-color:blue;";}else{echo "background-color:green;";} ?>">
                <input type="hidden" name="tetszikzene" value="negyedikkep">
            </div>
        </div>
        </form>

        <form action="likeolas.php" method="Post">
        <div class="box">
            <div class="image">
                <img src="../kepek/otodik.png" alt="" height="200" width="200">
            </div>
            <div class="music">
                <a>Rican Da Menace - DUMB (feat. Moneybagg Yo) </a>
                <audio src="../audio/top5.mp3" controls></audio>
                <input type="submit" value="❤️" name="tetszik" style="<?php if(in_array("otodikkep\n",$sgd2)){echo "background-color:blue;";}else{echo "background-color:green;";} ?>">
                <input type="hidden" name="tetszikzene" value="otodikkep">
            </div>
        </div>
        </form>

        <form action="likeolas.php" method="Post">
        <div class="box">
            <div class="image">
                <img src="../kepek/hatodik.png" alt="" height="200" width="200">
            </div>
            <div class="music">
                <a>PinkPantheress, Ice Spice - Boy’s a liar Pt. 2</a>
                <audio src="../audio/top6.mp3" controls></audio>
                <input type="submit" value="❤️" name="tetszik" style="<?php if(in_array("hatodikkep\n",$sgd2)){echo "background-color:blue;";}else{echo "background-color:green;";} ?>">
                <input type="hidden" name="tetszikzene" value="hatodikkep">
            </div>
        </div>
        </form>

        <form action="likeolas.php" method="Post">
        <div class="box">
            <div class="image">
                <img src="../kepek/hetedik.png" alt="" height="200" width="200">
            </div>
            <div class="music">
                <a>SZA - Kill Bill</a>
                <audio src="../audio/top7.mp3" controls></audio>
                <input type="submit" value="❤️" name="tetszik" style="<?php if(in_array("hetedikkep\n",$sgd2)){echo "background-color:blue;";}else{echo "background-color:green;";} ?>">
                <input type="hidden" name="tetszikzene" value="hetedikkep">
            </div>
        </div>
        </form>

        <form action="likeolas.php" method="Post">
        <div class="box">
            <div class="image">
                <img src="../kepek/nyolcadik.png" alt="" height="200" width="200">
            </div>
            <div class="music">
                <a>Taylor Swift - Lavender Haze</a>
                <audio src="../audio/top8.mp3" controls></audio>
                <input type="submit" value="❤️" name="tetszik" style="<?php if(in_array("nyolcadikkep\n",$sgd2)){echo "background-color:blue;";}else{echo "background-color:green;";} ?>">
                <input type="hidden" name="tetszikzene" value="nyolcadikkep">
            </div>
        </div>
        </form>

        <form action="likeolas.php" method="Post">
        <div class="box">
            <div class="image">
                <img src="../kepek/kilencedik.png" alt="" height="200" width="200">
            </div>
            <div class="music">
                <a>Sam Smith - I'm Not Here To Make Friends</a>
                <audio src="../audio/top9.mp3" controls></audio>
                <input type="submit" value="❤️" name="tetszik" style="<?php if(in_array("kilencedikkep\n",$sgd2)){echo "background-color:blue;";}else{echo "background-color:green;";} ?>">
                <input type="hidden" name="tetszikzene" value="kilencedikkep">
            </div>
        </div>
        </form>

        <form action="likeolas.php" method="Post">
        <div class="box">
            <div class="image">
                <img src="../kepek/tizedik.png" alt="" height="200" width="200">
            </div>
            <div class="music">
                <a>Burna Boy - Last Last</a>
                <audio src="../audio/top10.mp3" controls></audio>
                <input type="submit" value="❤️" name="tetszik" style="<?php if(in_array("tizedikkep\n",$sgd2)){echo "background-color:blue;";}else{echo "background-color:green;";} ?>">
                <input type="hidden" name="tetszikzene" value="tizedikkep">
            </div>
        </div>
        </form>

    </div>
</div>
</body>
</html>

