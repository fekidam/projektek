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
<h1>Gyakorlat felvetele</h1>
<div id="be">
<form method="POST" action="gyakorlatbeszur.php" accept-charset="utf-8">
    <label class="formlabel">Edzoid:</label><input class="forminput" type="number" name="edzoid"><br>
    <label class="formlabel">Hossz:</label><input class="forminput" type="number" name="hossz"><br>
    <label class="formlabel">Idopont:</label><input class="forminput" type="date" name="idopont"><br>
    <label class="formlabel">Melyikcsapat:</label><input class="forminput" type="text" name="melyikcsapat"><br>
    <input class="forminput" type="submit"  value="Elkuld">
</form>
</div>
<hr>
<table id="eredmeny">
    <tr>
        <th>Edzoid</th>
        <th>Hossz</th>
        <th>Idopont</th>
        <th>Melyikcsapat</th>
        <th>Szerkesztés</th>
    </tr>
    <?php
    include_once("db_fuggvenyek.php");
    $gyakorlat=gyakorlat_leker();
    while($egysor = mysqli_fetch_assoc($gyakorlat)){
    echo '<form action="gyakorlatszerkesztes.php" method="POST">';
    echo '<tr>';
    echo '<td>'.$egysor["edzoid"].'</td>';
    echo '<td>'.$egysor["hossz"].'</td>';
    echo '<td>'.$egysor["idopont"].'</td>';
    echo '<td>'.$egysor["melyikcsapat"].'</td>';
    echo '<td><input type="submit" value="Szerkeszt"></td>';
    echo '</tr>';
    echo '<input type="hidden" name="edzoid" value="'.$egysor["edzoid"].'">';
    echo '</form>';
    }
    mysqli_free_result($gyakorlat);
    ?>
</table>
</body>
</HTML>