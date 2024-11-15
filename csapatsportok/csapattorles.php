<?php
include_once ("db_fuggvenyek.php");
$v_csapatid=$_POST['csapatid'];
if(isset($v_csapatid)){
    $sikeres=csapat_torol($v_csapatid);
    if($sikeres==false){
        die("Nem sikerült törölni a rekordot");
    }
    else{
        header("Location:csapat.php");
    }
}
else{
    error_log("Nincs beállítva érték");
}
?>