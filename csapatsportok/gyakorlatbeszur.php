<?php
include_once("db_fuggvenyek.php");
$v_edzoid=$_POST['edzoid'];
$v_hossz=$_POST['hossz'];
$v_idopont=$_POST['idopont'];
$v_melyikcsapat=$_POST['melyikcsapat'];

if(isset($v_edzoid) && isset($v_hossz) && isset($v_hossz)&& isset($v_melyikcsapat)){
    $sikeres=gyakorlat_beszur($v_edzoid,$v_hossz,$v_idopont, $v_melyikcsapat);
    if($sikeres== false){
        die("Nem sikerült felvinni a rekordot.");
    }
    else{
        header("Location:gyakorlat.php");
    }
}
else{
    error_log("Nincs beállítva valamely érték");
}
?>