<?php
session_start();
$like=$_POST["tetszikzene"];
echo $like;
echo "<pre>";
print_r($_SESSION); //komment
$content="";
$benne_van=false;
$felhasznalo=$_SESSION["felhasznalonev"];

$melyik_felhasznalo_melyik_zene=fopen("../txt/likeok.txt","r");
if ($melyik_felhasznalo_melyik_zene === FALSE)
    die("HIBA: A fájl megnyitása nem sikerült!");
//olvasas
$i = 1;
while (($line = fgets($melyik_felhasznalo_melyik_zene)) !== FALSE ) {
    if(($_SESSION["felhasznalonev"].",".$like."\n")==$line){
        $benne_van=true;
    }else{
        $content.=$line;
    }
    $i++;
}

fclose($melyik_felhasznalo_melyik_zene);
$melyik_felhasznalo_melyik_zene=fopen("../txt/likeok.txt","w");
fwrite($melyik_felhasznalo_melyik_zene,$content);
fclose($melyik_felhasznalo_melyik_zene);
if(!$benne_van){
    $melyik_felhasznalo_melyik_zene=fopen("../txt/likeok.txt","a");
    fwrite($melyik_felhasznalo_melyik_zene,$_SESSION["felhasznalonev"].",".$like."\n");
    fclose($melyik_felhasznalo_melyik_zene);
}

header("Location:lejatszasilista.php");
?>