<?php
include_once ("db_fuggvenyek.php");
$v_tamogatoid=$_POST['tamogatoid'];
if(isset($v_tamogatoid)){
    $sikeres=tamogato_torol($v_tamogatoid);
    if($sikeres==false){
        die("Nem sikerült törölni a rekordot");
    }
    else{
        header("Location:tamogato.php");
    }
}
else{
    error_log("Nincs beállítva érték");
}
?>