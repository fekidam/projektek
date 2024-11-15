<!DOCTYPE HTML>
<HTML>
<HEAD>
    <meta charset="utf-8" title="Csapatsportok">
    <style>
        body{
            background-color: coral;
            background-position: top;
            background-repeat: no-repeat;
        }
        #bar{
            border: 10px dotted black;
			padding: 15px;
			background: lightblue;
			background-clip: padding-box;
			
        }
        a {
            color: black;
            text-decoration: none;
			font-size: 25px;
			padding:15px;
        }
        h1{
            text-align: center;
            font-size: 40px;
            color:black;
            font-family: Verdana;
        }
        .formlabel{
            color: #000000;
            font-size:30px;
            word-spacing: 10px;
            padding: 30px;
        }
        table{
            font-size: 20px;
            background-color: white;
        }
        #eredmeny{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #eredmeny td, #eredmeny th {
            border: 1px solid #000000;
            padding: 8px;
        }

        #eredmeny tr:nth-child(even){background-color: #f2f2f2;}

        #eredmeny tr:hover {background-color: #ddd;}

        #eredmeny th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: black;
            color: white;
        }
        input[type=text], select {
            width: 75%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=number], select {
            width: 75%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 50%;
            background-color: lightblue;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: blue;
        }

        #be {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
</HEAD>
<body>
<div id="bar">
	<a href="index.php"><b>Kezdőlap</b></a>
    <a href="csapat.php">Csapat</a>
    <a href="edzo.php">Edzo</a>
    <a href="gyakorlat.php">Gyakorlat</a>
    <a href="jatekos.php">Jatekos</a>
    <a href="meccs.php">Meccs</a>
	<a href="tamogato.php">Tamogato</a>
    <hr>
</div>

<h1>Jatekos felvetele</h1>
<div id="be">
<form method="POST" action="Jatekosbeszur.php" accept-charset="utf-8">
    <label class="formlabel">Jatekosid:</label><input class="forminput" type="number" name="jatekosid"><br>
    <label class="formlabel">Nev:</label><input class="forminput" type="text" name="nev"><br>
    <label class="formlabel">Mezszam:</label><input class="forminput" type="number" name="mezszam"><br>
    <label class="formlabel">Szarmazas:</label><input class="forminput" type="text" name="szarmazas"><br>
	<label class="formlabel">Csapatid:</label><input class="forminput" type="number" name="csapatid"><br>
	<label class="formlabel">Pozicio:</label><input class="forminput" type="text" name="pozicio"><br>
	<label class="formlabel">Kapitany:</label><input class="forminput" type="is_bool" name="kapitany"><br>
	<label class="formlabel">Gol:</label><input class="forminput" type="number" name="gol"><br>
	<label class="formlabel">Golpassz:</label><input class="forminput" type="number" name="golpassz"><br>
	<label class="formlabel">Lapok:</label><input class="forminput" type="number" name="lapok"><br>
	<label class="formlabel">Kor:</label><input class="forminput" type="number" name="kor"><br>
    <input class="forminput" type="submit"  value="Elkuld">
</form>
</div>
<hr>

<table id="eredmeny">
    <tr>
        <th>Jatekosid</th>
        <th>Nev</th>
        <th>Mezszam</th>
        <th>Szarmazas</th>
        <th>Csapatid</th>
		<th>Pozicio</th>
		<th>Kapitany</th>
		<th>Gol</th>
		<th>Golpassz</th>
		<th>Lapok</th>
		<th>Kor</th>
    </tr>
    <?php
    include_once("db_fuggvenyek.php");
    $jatekos=jatekos_leker();
    while($egysor =mysqli_fetch_assoc($jatekos)){
        echo '<form action="jatekosszerkesztes.php" method="POST">';
        echo '<tr>';
        echo '<td>'.$egysor["jatekosid"].'</td>';
        echo '<td>'.$egysor["nev"].'</td>';
        echo '<td>'.$egysor["mezszam"].'</td>';
        echo '<td>'.$egysor["szarmazas"].'</td>';
		echo '<td>'.$egysor["csapatid"].'</td>';
		echo '<td>'.$egysor["pozicio"].'</td>';
		echo '<td>'.$egysor["kapitany"].'</td>';
		echo '<td>'.$egysor["gol"].'</td>';
		echo '<td>'.$egysor["golpassz"].'</td>';
		echo '<td>'.$egysor["lapok"].'</td>';
		echo '<td>'.$egysor["kor"].'</td>';
        echo '<td><input type="submit" value="Szerkeszt"></td>';
        echo '</tr>';
        echo '<input type="hidden" name="jatekosid" value="'.$egysor["jatekosid"].'">';
        echo '</form>';
    }
    mysqli_free_result($jatekos);
    ?>
</table>
</body>
</HTML>