<?php
include_once("db_fuggvenyek.php");
$v_tamogatoid=$_POST['tamogatoid'];
$v_csapatid=$_POST['csapatid'];

if(isset($v_tamogatoid) && isset($v_csapatid)){
    $sikeres6=tamogato_beszur($v_tamogatoid,$v_csapatid);
    if($sikeres6== false){
        die("Nem sikerült felvinni a rekordot.");
    }
    else{
            header("Location:tamogato.php");
    }

}
else{
    error_log("Nincs beállítva valamely érték");
}
?>