<?php
function csapatsportok_csatlakozas(){
    $conn=mysqli_connect("localhost","root","") or die("Csatlakozási hiba");
    if(false == mysqli_select_db($conn,"csapatsportok")){
        return null;
    }
    mysqli_query($conn, 'SET NAMES UTF8');
    mysqli_query($conn, 'SET character_set_results=utf8');
    mysqli_set_charset($conn,'utf8');
    return $conn;
}
function csapat_beszur($csapatid,$nev,$gyozelem,$vereseg,$dontetlen, $divizio, $meccsid, $edzoid){
    if(!($conn = csapatsportok_csatlakozas())){
        return false;
    }
    $stmt = mysqli_prepare($conn,"INSERT INTO csapat(csapatid, nev, gyozelem, vereseg, dontetlen, divizio, meccsid, edzoid) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt,"dsdddddd",$csapatid,$nev,$gyozelem,$vereseg,$dontetlen, $divizio, $meccsid, $edzoid);
    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function csapat_modosit($v_csapatid,$v_nev,$v_gyozelem,$v_vereseg,$v_dontetlen, $v_divizio, $v_meccsid, $v_edzoid){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }

    $stmt=mysqli_prepare($conn,"UPDATE `csapat` SET csapatid=?,nev=?,gyozelem=?,vereseg=?,dontetlen=?, divizio=?, meccsid=?, edzoid=? WHERE csapatid=?");
    mysqli_stmt_bind_param($stmt,"dsddddddd",$v_csapatid,$v_nev,$v_gyozelem,$v_vereseg,$v_dontetlen, $v_divizio, $v_meccsid, $v_edzoid, $v_csapatid);

    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function csapat_torol($v_csapatid){
    if(!($conn = csapatsportok_csatlakozas())){
        return false;
    }
    $stmt=mysqli_prepare($conn,"DELETE FROM `csapat` WHERE csapatid = ?");
    mysqli_stmt_bind_param($stmt,"d",$v_csapatid);
    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function csapat_leker(){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $result=mysqli_query($conn,"SELECT csapatid, nev, gyozelem, vereseg, dontetlen, divizio, meccsid, edzoid FROM `csapat`");
    if($result==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $result;
}
function csapatadat_leker($v_csapatid){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
        $stmt=mysqli_prepare($conn,"SELECT csapatid, nev, gyozelem, vereseg, dontetlen, divizio, meccsid, edzoid FROM csapat WHERE csapatid = ?");
        mysqli_stmt_bind_param($stmt,"d",$v_csapatid);
        $result=mysqli_stmt_execute($stmt);
        if($result == false){
           die(mysqli_error($conn));
        }
        mysqli_stmt_bind_result($stmt,$v_csapatid,$v_nev,$v_gyozelem,$v_vereseg,$v_dontetlen,$v_divizio,$v_meccsid,$v_edzoid);
        $reader=array();
        mysqli_stmt_fetch($stmt);
        $reader['csapatid']=$v_csapatid;
        $reader['nev']=$v_nev;
        $reader['gyozelem']=$v_gyozelem;
        $reader['vereseg']=$v_vereseg;
        $reader['dontetlen']=$v_dontetlen;
        $reader['divizio']=$v_divizio;
        $reader['meccsid']=$v_meccsid;
		$reader['edzoid']=$v_edzoid;
        mysqli_close($conn);
        return $reader;
}
function edzo_beszur($edzoid, $nev, $eletkor, $egyesulet, $szarmazas){
    if(!($conn = csapatsportok_csatlakozas())){
        return false;
    }
    $stmt = mysqli_prepare($conn,"INSERT INTO edzo(edzoid, nev, eletkor, egyesulet, szarmazas) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt,"dsdss",$edzoid, $nev, $eletkor, $egyesulet, $szarmazas);
    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function edzo_leker(){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $result=mysqli_query($conn,"SELECT edzoid, nev, eletkor, egyesulet, szarmazas FROM edzo");
    if($result==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $result;
}
function edzoadat_leker($v_edzoid){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $stmt=mysqli_prepare($conn,"SELECT edzoid, nev, eletkor, egyesulet, szarmazas FROM edzo WHERE edzoid = ?");
    mysqli_stmt_bind_param($stmt,"d",$v_edzoid);
    $result=mysqli_stmt_execute($stmt);
    if($result == false){
        die(mysqli_error($conn));
    }
    mysqli_stmt_bind_result($stmt,$v_edzoid, $v_nev, $v_eletkor, $v_egyesulet, $v_szarmazas);
    $reader=array();
    mysqli_stmt_fetch($stmt);
    $reader['edzoid']=$v_edzoid;
    $reader['nev']=$v_nev;
    $reader['eletkor']=$v_eletkor;
    $reader['egyesulet']=$v_egyesulet;
    $reader['szarmazas']=$v_szarmazas;

    mysqli_close($conn);
    return $reader;
}
function edzo_modosit($v_edzoid, $v_nev, $v_eletkor, $v_egyesulet, $v_szarmazas){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }

    $stmt=mysqli_prepare($conn,"UPDATE `edzo` SET edzoid=?,nev=?,eletkor=?,egyesulet=?,szarmazas=? WHERE edzoid=?");
    mysqli_stmt_bind_param($stmt,"dsdssd",$v_edzoid, $v_nev, $v_eletkor, $v_egyesulet, $v_szarmazas, $v_edzoid);

    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function edzo_torol($v_edzoid){
    if(!($conn = csapatsportok_csatlakozas())){
        return false;
    }
    $stmt=mysqli_prepare($conn,"DELETE FROM `edzo` WHERE edzoid = ?");
    mysqli_stmt_bind_param($stmt,"d",$v_edzoid);
    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function gyakorlat_beszur($edzoid,$hossz,$idopont,$melyikcsapat){
    if(!($conn = csapatsportok_csatlakozas())){
        return false;
    }
    $stmt = mysqli_prepare($conn,"INSERT INTO gyakorlat(edzoid, hossz, idopont,melyikcsapat) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt,"ddss",$edzoid,$hossz,$idopont,$melyikcsapat);
    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function gyakorlat_leker(){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $result=mysqli_query($conn,"SELECT edzoid, hossz, idopont, melyikcsapat FROM gyakorlat");
    if($result==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $result;
}
function gyakorlatadat_leker($v_edzoid){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $stmt=mysqli_prepare($conn,"SELECT edzoid, hossz, idopont,melyikcsapat FROM gyakorlat WHERE edzoid=?");
    mysqli_stmt_bind_param($stmt,"d",$v_edzoid);
    $result=mysqli_stmt_execute($stmt);
    if($result == false){
        die(mysqli_error($conn));
    }
    mysqli_stmt_bind_result($stmt,$v_edzoid,$v_hossz,$v_idopont,$v_melyikcsapat);
    $reader=array();
    mysqli_stmt_fetch($stmt);
    $reader['edzoid']=$v_edzoid;
    $reader['hossz']=$v_hossz;
    $reader['idopont']=$v_idopont;
	$reader['melyikcsapat']=$v_melyikcsapat;

    mysqli_close($conn);
    return $reader;
}
function gyakorlat_modosit($v_edzoid,$v_hossz,$v_idopont,$v_melyikcsapat){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $stmt=mysqli_prepare($conn,"UPDATE `gyakorlat` SET edzoid=?, hossz=?, idopont=?,melyikcsapat=? WHERE edzoid=?");
    mysqli_stmt_bind_param($stmt,"ddssd",$v_edzoid,$v_hossz,$v_idopont,$v_melyikcsapat, $v_edzoid);

    $success=mysqli_stmt_execute($stmt);	
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function gyakorlat_torol($v_edzoid){
    if(!($conn = csapatsportok_csatlakozas())){
        return false;
    }
    $stmt=mysqli_prepare($conn,"DELETE FROM `gyakorlat` WHERE edzoid = ?");
    mysqli_stmt_bind_param($stmt,"d",$v_edzoid);
    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function jatekos_leker(){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $result=mysqli_query($conn,"SELECT jatekosid, nev, mezszam, szarmazas, csapatid, pozicio, kapitany, gol, golpassz, lapok, kor FROM jatekos");
    if($result==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $result;
}
function jatekos_beszur($jatekosid,$nev,$mezszam,$szarmazas, $csapatid, $pozicio, $kapitany, $gol, $golpassz, $lapok, $kor){
    if(!($conn = csapatsportok_csatlakozas())){
        return false;
    }
    $stmt = mysqli_prepare($conn,"INSERT INTO jatekos(jatekosid, nev, mezszam, szarmazas, csapatid, pozicio, kapitany, gol, golpassz, lapok, kor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt,"dsdsdsidddd",$jatekosid,$nev,$mezszam,$szarmazas, $csapatid, $pozicio, $kapitany, $gol, $golpassz, $lapok, $kor);
    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function jatekosadat_leker($v_jatekosid){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $stmt=mysqli_prepare($conn,"SELECT jatekosid, nev, mezszam, szarmazas, csapatid, pozicio, kapitany, gol, golpassz, lapok, kor FROM jatekos WHERE jatekosid=?");
    mysqli_stmt_bind_param($stmt,"d",$v_jatekosid);
    $result=mysqli_stmt_execute($stmt);
    if($result == false){
        die(mysqli_error($conn));
    }
    mysqli_stmt_bind_result($stmt,$v_jatekosid,$v_nev,$v_mezszam,$v_szarmazas, $v_csapatid, $v_pozicio, $v_kapitany, $v_gol, $v_golpassz, $v_lapok, $v_kor);
    $reader=array();
    mysqli_stmt_fetch($stmt);
    $reader['jatekosid']=$v_jatekosid;
    $reader['nev']=$v_nev;
    $reader['mezszam']=$v_mezszam;
    $reader['szarmazas']=$v_szarmazas;
	$reader['csapatid']=$v_csapatid;
	$reader['pozicio']=$v_pozicio;
	$reader['kapitany']=$v_kapitany;
	$reader['gol']=$v_gol;
	$reader['golpassz']=$v_golpassz;
	$reader['lapok']=$v_lapok;
	$reader['kor']=$v_kor;
    mysqli_close($conn);
    return $reader;
}
function jatekos_modosit($v_jatekosid,$v_nev,$v_mezszam,$v_szarmazas, $v_csapatid, $v_pozicio, $v_kapitany, $v_gol, $v_golpassz, $v_lapok, $v_kor){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $stmt=mysqli_prepare($conn,"UPDATE `jatekos` SET jatekosid=?,nev=?,mezszam=?, szarmazas=?, csapatid=?, pozicio=?, kapitany=?, gol=?, golpassz=?, lapok=?, kor=? WHERE jatekosid=?");
    mysqli_stmt_bind_param($stmt,"dsdsdsiddddd",$v_jatekosid,$v_nev,$v_mezszam,$v_szarmazas, $v_csapatid, $v_pozicio, $v_kapitany, $v_gol, $v_golpassz, $v_lapok, $v_kor, $v_jatekosid);

    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function jatekos_torol($v_jatekosid){
    if(!($conn = csapatsportok_csatlakozas())){
        return false;
    }
    $stmt=mysqli_prepare($conn,"DELETE FROM `jatekos` WHERE jatekosid = ?");
    mysqli_stmt_bind_param($stmt,"d",$v_jatekosid);
    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

function meccs_leker(){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $result=mysqli_query($conn,"SELECT meccsid, helyszin, idopont FROM meccs");
    if($result==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $result;
}
function meccs_beszur($meccsid, $helyszin, $idopont){
    if(!($conn = csapatsportok_csatlakozas())){
        return false;
    }
    $stmt = mysqli_prepare($conn,"INSERT INTO meccs(meccsid, helyszin, idopont) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt,"dss",$meccsid, $helyszin, $idopont);
    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function meccsadat_leker($v_meccsid){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $stmt=mysqli_prepare($conn,"SELECT meccsid, helyszin, idopont FROM meccs WHERE meccsid=?");
    mysqli_stmt_bind_param($stmt,"d",$v_meccsid);
    $result=mysqli_stmt_execute($stmt);
    if($result == false){
        die(mysqli_error($conn));
    }
    mysqli_stmt_bind_result($stmt,$v_meccsid, $v_helyszin, $v_idopont);
    $reader=array();
    mysqli_stmt_fetch($stmt);
    $reader['meccsid']=$v_meccsid;
    $reader['helyszin']=$v_helyszin;
    $reader['idopont']=$v_idopont;
    mysqli_close($conn);
    return $reader;
}
function meccs_modosit($v_meccsid, $v_helyszin, $v_idopont){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $stmt=mysqli_prepare($conn,"UPDATE `meccs` SET meccsid=?, helyszin=?, idopont=? WHERE meccsid=?");
    mysqli_stmt_bind_param($stmt,"dssd",$v_meccsid, $v_helyszin, $v_idopont, $v_meccsid);

    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function meccs_torol($v_meccsid){
    if(!($conn = csapatsportok_csatlakozas())){
        return false;
    }
    $stmt=mysqli_prepare($conn,"DELETE FROM `meccs` WHERE meccsid = ?");
    mysqli_stmt_bind_param($stmt,"d",$v_meccsid);
    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

function tamogato_leker(){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $result=mysqli_query($conn,"SELECT tamogatoid, csapatid FROM tamogat");
    if($result==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $result;
}
function tamogato_beszur($tamogatoid, $csapatid){
    if(!($conn = csapatsportok_csatlakozas())){
        return false;
    }
    $stmt = mysqli_prepare($conn,"INSERT INTO tamogat(tamogatoid, csapatid) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt,"dd",$tamogatoid, $csapatid);
    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function tamogatoadat_leker($v_tamogatoid){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $stmt=mysqli_prepare($conn,"SELECT tamogatoid, csapatid FROM tamogat WHERE tamogatoid=?");
    mysqli_stmt_bind_param($stmt,"d",$v_tamogatoid);
    $result=mysqli_stmt_execute($stmt);
    if($result == false){
        die(mysqli_error($conn));
    }
    mysqli_stmt_bind_result($stmt,$v_tamogatoid, $v_csapatid);
    $reader=array();
    mysqli_stmt_fetch($stmt);
    $reader['tamogatoid']=$v_tamogatoid;
    $reader['csapatid']=$v_csapatid;
    mysqli_close($conn);
    return $reader;
}
function tamogato_modosit($v_tamogatoid, $v_csapatid){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $stmt=mysqli_prepare($conn,"UPDATE `tamogat` SET tamogatoid=?, csapatid=? WHERE tamogatoid=?");
    mysqli_stmt_bind_param($stmt,"ddd",$v_tamogatoid, $v_csapatid, $v_tamogatoid);

    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
function tamogato_torol($v_tamogatoid){
    if(!($conn = csapatsportok_csatlakozas())){
        return false;
    }
    $stmt=mysqli_prepare($conn,"DELETE FROM `tamogat` WHERE tamogatoid = ?");
    mysqli_stmt_bind_param($stmt,"d",$v_tamogatoid);
    $success=mysqli_stmt_execute($stmt);
    if($success==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

function lekerdezes1(){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $result=mysqli_query($conn,"SELECT csapat.nev, eletkor FROM `csapat`, `edzo` WHERE csapat.edzoid=edzo.edzoid and eletkor>60 ORDER BY eletkor Desc");
    if($result==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $result;
	
	
}

function lekerdezes2(){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $result=mysqli_query($conn,"SELECT mezszam, csapat.nev FROM `jatekos`, `csapat` WHERE jatekos.csapatid=csapat.csapatid and mezszam > 9 ORDER BY mezszam Asc");
    if($result==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $result;
	
	
}

function lekerdezes3(){
    if(!($conn = csapatsportok_csatlakozas())) {
        return false;
    }
    $result=mysqli_query($conn,"SELECT csapat.nev, kor FROM `csapat`, `jatekos` WHERE jatekos.csapatid=csapat.csapatid and kor>30 ORDER BY kor DESC");
    if($result==false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $result;
	
	
}