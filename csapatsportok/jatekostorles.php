<?php
include_once ("db_fuggvenyek.php");
$v_jatekosid=$_POST['jatekosid'];
if(isset($v_jatekosid)){
    $sikeres=jatekos_torol($v_jatekosid);
    if($sikeres==false){
        die("Nem sikerült törölni a rekordot");
    }
    else{
        header("Location:jatekos.php");
    }
}
else{
    error_log("Nincs beállítva érték");
}
?>