<?php
session_start();
include "kozos.php";              // beágyazzuk a loadUsers() és saveUsers() függvényeket tartalmazó PHP fájlt
$fiokok = loadUsers("../txt/users.txt"); // betöltjük a regisztrált felhasználók adatait, és eltároljuk őket a $fiokok változóban

// az űrlapfeldolgozás során keletkező hibákat ebbe a tömbbe fogjuk gyűjteni
$hibak = [];

// űrlapfeldolgozás

if (isset($_POST["regisztracio"])) {   // ha az űrlapot elküldték...
    // a kötelezően kitöltendő mezők ellenőrzése
    if (!isset($_POST["felhasznalonev"]) || trim($_POST["felhasznalonev"]) === "")
        $hibak[] = "A felhasználónév megadása kötelező!";

    if (!isset($_POST["jelszo"]) || trim($_POST["jelszo"]) === "" || !isset($_POST["jelszo2"]) || trim($_POST["jelszo2"]) === "")
        $hibak[] = "A jelszó és az ellenőrző jelszó megadása kötelező!";

    if (!isset($_POST["eletkor"]) || trim($_POST["eletkor"]) === "")
        $hibak[] = "Az életkor megadása kötelező!";

    if (!isset($_POST["nem"]) || trim($_POST["nem"]) === "")
        $hibak[] = "A nem megadása kötelező!";

    if (!isset($_POST["email"]) || trim($_POST["email"]) === "")
        $hibak[] = "Az email megadása kötelező!";  //foglalt-e

    // űrlapadatok lementése változókba
    $felhasznalonev = $_POST["felhasznalonev"];
    $jelszo = $_POST["jelszo"];
    $jelszo2 = $_POST["jelszo2"];
    $eletkor = $_POST["eletkor"];
    $nem = NULL;
    $email = $_POST["email"];

    if (isset($_POST["nem"]))           // csak akkor kérjük le a nemet, ha megadták
        $nem = $_POST["nem"];
    // (ez egy tömb lesz)

    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}$/';
    if (!preg_match($pattern, $email))
        $hibak[] = "Nem valódi e-mail címet adtál meg!";

    // foglalt felhasználónév ellenőrzése
    foreach ($fiokok as $fiok) {
        if ($fiok["felhasznalonev"] === $felhasznalonev)  // ha egy regisztrált felhasználó neve megegyezik az űrlapon megadott névvel...
            $hibak[] = "A felhasználónév már foglalt!";
    }

    foreach ($fiokok as $fiok) {
        if ($fiok["email"] === $email)  // ha egy regisztrált felhasználó neve megegyezik az űrlapon megadott névvel...
            $hibak[] = "Az email cím már foglalt!";
    }

    // túl rövid jelszó
    if (strlen($jelszo) < 5)
        $hibak[] = "A jelszónak legalább 5 karakter hosszúnak kell lennie!";

    // a két jelszó nem egyezik
    if ($jelszo !== $jelszo2)
        $hibak[] = "A jelszó és az ellenőrző jelszó nem egyezik!";

    // 18 év alatti életkor
    if ($eletkor < 18)
        $hibak[] = "Csak 18 éves kortól lehet regisztrálni!";

    // regisztráció sikerességének ellenőrzése
    if (count($hibak) === 0) {   // sikeres regisztráció (nem volt egyetlen hiba sem)
        $jelszo = password_hash($jelszo, PASSWORD_DEFAULT);       // jelszó hashelése
        // hozzáfűzzük az újonnan regisztrált felhasználó adatait a rendszer által ismert felhasználókat tároló tömbhöz
        $fiokok[] = ["felhasznalonev" => $felhasznalonev, "jelszo" => $jelszo, "eletkor" => $eletkor, "nem" => $nem, "email" => $email];
        // elmentjük a kibővített $fiokok tömböt a users.txt fájlba
        saveUsers("../txt/users.txt", $fiokok);
        $siker = TRUE;
        header("Location: login.php");      // átirányítás a login.php oldalra
    } else {                    // sikertelen regisztráció
        $siker = FALSE;
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
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
            <li><a href="regisztracio.php" class="active">REGISZTRÁCIÓ</a></li>
            <li><a href="login.php">BEJELENTKEZÉS</a></li>
        <?php endif; ?>
    </ul>
</div>
<div class="center">
    <h1>Regisztráció</h1>
    <form method="post" action="regisztracio.php">
        <div class="txt_field">
            <input type="text" name="felhasznalonev" value="<?php if (isset($_POST['felhasznalonev'])) echo $_POST['felhasznalonev']; ?>" maxlength="30" placeholder="ngypisti10"  >
            <label>Felhasználónév</label>
        </div>
        <div class="txt_field">
            <input type="password" name="jelszo">
            <label>Jelszó (min. 8 karakter)</label>
        </div>
        <div class="txt_field">
            <input type="password" name="jelszo2">
            <label>Jelszó újra</label>
        </div>
        <div class="txt_field">
            <input type="date" name="eletkor">
            <label>Életkor (csak 18 éven felülieknek)</label>
        </div>
        <div class="txt_field">
            <select name="nem">
                <option selected value="férfi">Férfi</option>
                <option value="nő">Nő</option>
            </select>
        </div>
        <div class="txt_field">
            <input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  placeholder="valaki@gmail.com">
            <label>Email cím</label>
        </div>
        <!-- az ezalatti sorban kell a checkboxnak class?-->
        <input type="checkbox" class = "check-box"> <span id="szabalyzat">Elfogadom a szabályzatot</span>
        <input type="submit" value="Regisztráció" name="regisztracio">
    </form>
    <?php
    if (isset($siker) && $siker === TRUE) {  // ha nem volt hiba, akkor a regisztráció sikeres
        echo "<p>Sikeres regisztráció!</p>";
    } else {                                // az esetleges hibákat kiírjuk egy-egy bekezdésben
        foreach ($hibak as $hiba) {
            echo "<p>" . $hiba . "</p>";
        }
    }
    ?>
</div>
<div class="zindex">
    <img class="first" src="../kepek/zindex1.png" alt="Kép egy fesztiválról.">
    <img class="second" src="../kepek/zindex2.png" alt="Kép egy fesztiválról.">
    <img class="third" src="../kepek/zindex3.png" alt="Kép egy fesztiválról.">
</div>
</body>
</html>
