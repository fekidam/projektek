<?php

include_once("db_fuggvenyek.php");
$v_edzoid = $_POST['edzoid'];
$v_nev = $_POST['nev'];
$v_eletkor = $_POST['eletkor'];
$v_egyesulet = $_POST['egyesulet'];
$v_szarmazas = $_POST['szarmazas'];

if (isset($v_edzoid) && isset($v_nev) && isset($v_eletkor) && isset($v_egyesulet) && isset($v_szarmazas)) {
   
    $sikeres = edzo_beszur($v_edzoid, $v_nev, $v_eletkor, $v_egyesulet, $v_szarmazas);
    if ($sikeres == false) {
        die("Nem sikerült felvinni a rekordot.");
    } else {
        header("Location:edzo.php");
    }

} else {
    error_log("Nincs beállítva valamely érték");
}
?>