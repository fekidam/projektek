<?php
session_start();
include "kozos.php";

if (!isset($_SESSION["felhasznalonev"])) {
    // ha a felhasználó nincs belépve akkor a login.php-ra navigálunk.
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Kapcsolat</title>
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
                <li><a href="Profile.php" class="active">PROFIL</a></li>
                <li><a href="lejatszasilista.php">TOPLISTA</a></li>
                <li><a href="statisztika.php">STATISZTIKÁK</a></li>
                <li><a href="kapcsolat.php">KAPCSOLAT</a></li>
            <?php else: ?>
                <li><a href="regisztracio.php">REGISZTRÁCIÓ</a></li>
                <li><a href="login.php">BEJELENTKEZÉS</a></li>
            <?php endif; ?>
        </ul>
    </div>

<main>
    <?php
    // a profilkép elérési útvonalának eltárolása egy változóban

    $profilkep = "../kepek/default.png";      // alapértelmezett kép, amit akkor jelenítünk meg, ha valakinek nincs feltöltött profilképe
    $utvonal = "../kepek/" . $_SESSION["felhasznalonev"]; // a kép neve a felhasználó nevével egyezik meg

    $kiterjesztesek = ["png", "jpg", "jpeg"];     // a lehetséges kiterjesztések, amivel egy profilkép rendelkezhet

    foreach ($kiterjesztesek as $kiterjesztes) {  // minden kiterjesztésre megnézzük, hogy létezik-e adott kiterjesztéssel profilképe a felhasználónak
        if (file_exists($utvonal . "." . $kiterjesztes)) {
            $profilkep = $utvonal . "." . $kiterjesztes;  // ha megtaláltuk a felhasználó profilképét, eltároljuk annak az elérési útvonalát egy változóban
        }
    }
    ?>
    <table style="border: solid 1px">
        <tr>
            <th colspan="2">
                <img src="<?php echo $profilkep; ?>" alt="Profilkép" height="200"/>
                <?php if ($_SESSION["felhasznalonev"] !== "default") { /* a "default" nevű példa felhasználó esetén ne engedélyezzük a profilkép módosítását */ ?>
                    <form action="Profile.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="profile-pic" accept="image/*"/>
                        <input type="submit" name="upload-btn" value="Profilkép módosítása"/>
                    </form>
                <?php } ?>
            </th>
        </tr>
        <tr>
            <th>Felhasználónév</th>
            <td>
                <?=$_SESSION["felhasznalonev"]?>
            </td>
        </tr>
        <tr>
            <th>Életkor</th>
            <td>
                <?=$_SESSION["eletkor"]?>
            </td>
        </tr>
        <tr>
            <th>Nem</th>
            <td>
                <?=$_SESSION["nem"]?>
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                <?=$_SESSION["email"]?>
            </td>
        </tr>
        <tr>
            <td>
                <a href="kijelentkezes.php">Kijelentkezés</a>
            </td>
            <td>
                <a href="adatmodosit.php">Adatmódosítás</a>
            </td>
        </tr>
    </table>
    <?php
    // a profilkép módosítását elvégző PHP kód

    if (isset($_POST["upload-btn"]) && is_uploaded_file($_FILES["profile-pic"]["tmp_name"])) {  // ha töltöttek fel fájlt...
        $fajlfeltoltes_hiba = "";                                       // változó a fájlfeltöltés során adódó esetleges hibaüzenet tárolására
        uploadProfilePicture($_SESSION["felhasznalonev"]);      // a kozos.php-ban definiált profilkép feltöltést végző függvény meghívása

        $kit = strtolower(pathinfo($_FILES["profile-pic"]["name"], PATHINFO_EXTENSION));    // a feltöltött profilkép kiterjesztése
        $utvonal = "../kepek/" . $_SESSION["felhasznalonev"] . "." . $kit;            // a feltöltött profilkép teljes elérési útvonala

        // ha nem volt hiba a fájlfeltöltés során, akkor töröljük a régi profilképet, egyébként pedig kiírjuk a fájlfeltöltés során adódó hibát

        if ($fajlfeltoltes_hiba === "") {
            if ($utvonal !== $profilkep && $profilkep !== "../kepek/default.png") {   // az ugyanolyan névvel feltöltött képet és a default.png-t nem töröljük
                unlink($profilkep);                         // régi profilkép törlése
            }

            header("Location: Profile.php");              // weboldal újratöltése
        } else {
            echo "<p>" . $fajlfeltoltes_hiba . "</p>";
        }
    }
    ?>
    <div style="font-family: Arial, sans-serif; font-size: 16px; background-image: linear-gradient(rgba(0,0,0,0.7), darkslateblue); color: white">
        <?php
        if(isset($_SESSION["felhasznalonev"]) && $_SESSION["felhasznalonev"] == "Admin") {
            echo "<br>";
            echo '<h2 style="font-size: 24px; color: white">Üzenetek:</h2>';
            echo "<div>";
            $content = file_get_contents("../txt/uzenetek.txt");
            $lines = explode("\n", $content);
            foreach ($lines as $line) {
                echo "<p>".$line."</p>";
            }
            echo "</div>";
        }
        ?>
    </div>
</main>
<footer>
    <p style="text-align: center; font-family: Arial,sans-serif; font-size: 12px; color: white; margin-top: 10px;">&copy; 2023 Zene</p>
</footer>
</body>
</html>

