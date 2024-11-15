<?php
session_start();
include "kozos.php";              // a loadUsers() függvény ebben a fájlban van
$fiokok = loadUsers("../txt/users.txt"); // betöltjük a regisztrált felhasználók adatait, és eltároljuk őket a $fiokok változóban

$uzenet = "";                     // az űrlap feldolgozása után kiírandó üzenet

if (isset($_POST["submit"])) {    // miután az űrlapot elküldték...
    if (!isset($_POST["felhasznalonev"]) || trim($_POST["felhasznalonev"]) === "" || !isset($_POST["jelszo"]) || trim($_POST["jelszo"]) === "") {
        // ha a kötelezően kitöltendő űrlapmezők valamelyike üres, akkor hibaüzenetet jelenítünk meg
        $uzenet = "<strong>Hiba:</strong> Adj meg minden adatot!";
    } else {
        // ha megfelelően kitöltötték az űrlapot, lementjük az űrlapadatokat egy-egy változóba
        $felhasznalonev = $_POST["felhasznalonev"];
        $jelszo = $_POST["jelszo"];

        // bejelentkezés sikerességének ellenőrzése
        $uzenet = "Sikertelen belépés! A belépési adatok nem megfelelők!";  // alapból azt feltételezzük, hogy a bejelentkezés sikertelen

        foreach ($fiokok as $fiok) {              // végigmegyünk a regisztrált felhasználókon
            // a bejelentkezés pontosan akkor sikeres, ha az űrlapon megadott felhasználónév-jelszó páros megegyezik egy regisztrált felhasználó belépési adataival
            // a jelszavakat hash alapján, a password_verify() függvénnyel hasonlítjuk össze
            if ($fiok["felhasznalonev"] === $felhasznalonev && password_verify($jelszo, $fiok["jelszo"])) {
                $uzenet = "Sikeres belépés!";// ekkor átírjuk a megjelenítendő üzenet szövegét
                $felhasznalonev = $fiok["felhasznalonev"]; //-
                $jelszo = $fiok["jelszo"];   //-
                $email = $fiok["email"];
                $nem = $fiok["nem"];
                $eletkor = $fiok["eletkor"];

                $sikerekbelepes = TRUE;
                break;                               // mivel találtunk illeszkedést, ezért a többi felhasználót nem kell megvizsgálnunk, kilépünk a ciklusból
            }
        }
        if($sikerekbelepes){
            $_SESSION["felhasznalonev"] = $felhasznalonev;
            $_SESSION["jelszo"] = $jelszo;
            $_SESSION["nem"] = $nem;
            $_SESSION["email"] = $email;
            $_SESSION["eletkor"] = $eletkor;
            header("Location: Profile.php");
        }
        else{
            echo "Sikertelen belépés!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés</title>
    <link rel="icon" href="../kepek/logo.jpg"/>
    <link rel="stylesheet" href="../css/projektjo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="navbar">
    <img src="../kepek/logo.jpg" class="logo" alt="Logo">
    <ul>
        <li><a href="projektjo.php">FŐOLDAL</a></li>
        <?php if(isset($_SESSION["felhasznalonev"]) || !empty($_SESSION["felhasznalonev"])):;?>
            <li><a href="lejatszasilista.php">TOPLISTA</a></li>
            <li><a href="statisztika.php">STATISZTIKÁK</a></li>
            <li><a href="kapcsolat.php">KAPCSOLAT</a></li>
        <?php else: ?>
            <li><a href="regisztracio.php">REGISZTRÁCIÓ</a></li>
            <li><a href="login.php" class="active">BEJELENTKEZÉS</a></li>
        <?php endif; ?>
    </ul>
</div>
<div class="center">
    <h1>Bejelentkezés</h1>
    <form method="post">
        <div class="txt_field">
            <input type="text" name="felhasznalonev">
            <label>Felhasználónév</label>
        </div>
        <div class="txt_field">
            <input type="password" name="jelszo">
            <label>Jelszó</label>
        </div>
        <div class="pass"><a href="kapcsolat.php">Elfelejtette jelszavát?</a></div>
        <input type="submit" value="Bejelentkezés" name="submit">
        <input type="reset" value="Törlés">
        <div class="signup_link">
            Még nem lenne tag? <a href="regisztracio.php">Regisztráció</a>
        </div>
    </form>
    <?php echo $uzenet . "<br/>"; ?>
</div>
<div class="zindex">
    <img class="first" src="../kepek/zindex1.png" alt="Kép egy fesztiválról.">
    <img class="second" src="../kepek/zindex2.png" alt="Kép egy fesztiválról.">
    <img class="third" src="../kepek/zindex3.png" alt="Kép egy fesztiválról.">
</div>
</body>
</html>
