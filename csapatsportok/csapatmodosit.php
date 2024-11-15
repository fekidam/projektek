<?php

include_once("db_fuggvenyek.php");
$v_csapatid = $_POST['csapatid'];
$v_nev = $_POST['nev'];
$v_gyozelem = $_POST['gyozelem'];
$v_vereseg = $_POST['vereseg'];
$v_dontetlen = $_POST['dontetlen'];
$v_divizio = $_POST['divizio'];
$v_meccsid = $_POST['meccsid'];
$v_edzoid = $_POST['edzoid'];


if (isset($v_csapatid) && isset($v_nev) && isset($v_gyozelem) && isset($v_vereseg) && isset($v_dontetlen) && isset($v_divizio) && isset($v_meccsid) && isset($v_edzoid)) {
   
    $sikeres = csapat_modosit($v_csapatid, $v_nev, $v_gyozelem, $v_vereseg, $v_dontetlen, $v_divizio, $v_meccsid, $v_edzoid);
    if ($sikeres == false) {
        die("Nem sikerült felvinni a rekordot.");
    } else {
        header("Location:csapat.php");
    }

} else {
    error_log("Nincs beállítva valamely érték");
}


?>