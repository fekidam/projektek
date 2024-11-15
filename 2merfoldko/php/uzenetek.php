<?php
session_start();
print_r($_SESSION);
$nev=$_POST["nev"];
$telefonszam=$_POST["telefonszam"];
$email=$_POST["email"];
$uzenet=$_POST["uzenet"];
$uzenet_adminnak=fopen("../txt/uzenetek.txt","a");
if ($uzenet_adminnak === FALSE)
    die("HIBA: A fájl megnyitása nem sikerült!");
fwrite($uzenet_adminnak,"✏".$nev." (telefonszám:".$telefonszam." "."email:".$email.")\nüzenete:\n".$uzenet."\n");
$szoveg = "✏".$nev." (telefonszám:".$telefonszam." "."email:".$email.")<br>üzenete:<br>".$uzenet."<br><br>";
echo $szoveg;
fclose($uzenet_adminnak);
header("Location: kapcsolat.php");
?>