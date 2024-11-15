<?php
session_start();
$felhasznalonev = $_SESSION["felhasznalonev"];
$jelszo= $_SESSION["jelszo"];
$email = $_SESSION["email"];
$updated = false;
$hibak=[];
if(isset($_POST["adatmodositas"])){
    $ujfelhasznalonev=$_POST["felhasznalonev"];
    $ujjelszo1=$_POST["jelszo1"];
    $ujjelszo2=$_POST["jelszo2"];
    $ujemail=$_POST["email"];
    if(count($hibak) === 0){
        $file = fopen("../txt/users.txt", "r");
        $sgd = [];

        while(!feof($file)) {
            $sgd[] = unserialize(fgets($file));
        }
        fclose($file);

        foreach($sgd as &$item) {
            if($item["felhasznalonev"] === $felhasznalonev){
                $item["felhasznalonev"] = $ujfelhasznalonev;
                $item["jelszo"] = password_hash($ujjelszo1,PASSWORD_DEFAULT);
                $item["email"] = $ujemail;
                $updated = true;
            }
        }

        $file = fopen("../txt/users.txt", "w");
        foreach($sgd as &$item) {
            fwrite($file, serialize($item));
        }
        fclose($file);

        if($updated) {
            echo "Sikeres adatmódosítás!";
        } else {
            echo "Sikertelen adatmodositas!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
    <link rel="icon" href="../kepek/logo.jpg"/>
    <link rel="stylesheet" href="../css/projektjo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="navbar">
    <img src="../kepek/logo.jpg" class="logo" alt="Logo">
    <ul>
        <li><a href="Profile.php" class = "active">VISSZA</a></li>
    </ul>
</div>
<div class="center">
    <h1>Adatmódosítás</h1>
    <form method="post" action="adatmodosit.php">
        <div class="txt_field">
            <input type="text" name="felhasznalonev">
            <span></span>
            <label>Új felhasználónév</label>
        </div>
        <div class="txt_field">
            <input type="password" name="jelszo1">
            <span></span>
            <label>Új jelszó</label>
        </div>
        <div class="txt_field">
            <input type="password" name="jelszo2">
            <span></span>
            <label>Új jelszó</label>
        </div>
        <div class="txt_field">
            <input type="text" name="email">
            <span></span>
            <label>Új email cím</label>
        </div>
        <input type="submit" value="Módosít" name="adatmodositas">
    </form>
</div>
</body>
</html>
