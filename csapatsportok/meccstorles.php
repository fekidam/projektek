<?php
include_once ("db_fuggvenyek.php");
$v_meccsid=$_POST['meccsid'];
if(isset($v_meccsid)){
    $sikeres=meccs_torol($v_meccsid);
    if($sikeres==false){
        die("Nem sikerült törölni a rekordot");
    }
    else{
        header("Location:meccs.php");
    }
}
else{
    error_log("Nincs beállítva érték");
}
?>