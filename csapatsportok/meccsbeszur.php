<?php
include_once("db_fuggvenyek.php");
$v_meccsid=$_POST['meccsid'];
$v_helyszin=$_POST['helyszin'];
$v_idopont=$_POST['idopont'];

if(isset($v_meccsid) && isset($v_helyszin) && isset($v_idopont)){
    $sikeres=meccs_beszur($v_meccsid,$v_helyszin,$v_idopont);
    if($sikeres== false){
        die("Nem sikerült felvinni a rekordot.");
    }
    else{
            header("Location:meccs.php");
    }

}
else{
    error_log("Nincs beállítva valamely érték");
}
?>