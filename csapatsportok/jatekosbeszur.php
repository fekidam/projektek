<?php
include_once("db_fuggvenyek.php");
$v_jatekosid=$_POST['jatekosid'];
$v_nev=$_POST['nev'];
$v_mezszam=$_POST['mezszam'];
$v_szarmazas=$_POST['szarmazas'];
$v_csapatid=$_POST['csapatid'];
$v_pozicio=$_POST['pozicio'];
$v_kapitany=$_POST['kapitany'];
$v_gol=$_POST['gol'];
$v_golpassz=$_POST['golpassz'];
$v_lapok=$_POST['lapok'];
$v_kor=$_POST['kor'];

if(isset($v_jatekosid) && isset($v_nev) && isset($v_mezszam) && isset($v_szarmazas) && isset($v_csapatid) && isset($v_pozicio) && isset($v_kapitany) && isset($v_gol) && isset($v_golpassz) && isset($v_lapok) && isset($v_kor)){
    $sikeres=jatekos_beszur($v_jatekosid,$v_nev,$v_mezszam,$v_szarmazas,$v_csapatid, $v_pozicio, $v_kapitany, $v_gol, $v_golpassz, $v_lapok, $v_kor);
    if($sikeres== false){
        die("Nem sikerült felvinni a rekordot.");
    }
    else{
            header("Location:jatekos.php");
    }

}
else{
    error_log("Nincs beállítva valamely érték");
}
?>