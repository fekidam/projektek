<?php
include_once ("db_fuggvenyek.php");
$v_edzoid=$_POST['edzoid'];
if(isset($v_edzoid)){
    $sikeres=gyakorlat_torol($v_edzoid);
    if($sikeres==false){
        die("Nem sikerült törölni a rekordot");
    }
    else{
        header("Location:gyakorlat.php");
    }
}
else{
    error_log("Nincs beállítva érték");
}
?>