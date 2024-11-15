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
</body>

<?php
include_once ("db_fuggvenyek.php");
$v_csapatid=$_POST['csapatid'];
$csapatadat=csapatadat_leker($v_csapatid)
?>
<div id="be">
    <h1>Csapat szerkesztese</h1>
<form method="POST" action="csapatmodosit.php" accept-charset="utf-8">
    <label class="formlabel">Csapatid:</label>
	<?php
    if(isset($_POST['csapatid'])&&!empty($_POST['csapatid'])){
		$id=$_POST['csapatid'];
		echo'<input class="forminput" type="number" name="csapatid" value="'.$id.'">';
	}
    ?>
   <br>
    <label class="formlabel">Nev:</label>
    <?php
    echo ' <input class="forminput" type="text" name="nev" value="'.$csapatadat['nev'].'">';
    ?>
   <br>
    <label class="formlabel">Gyozelem:</label>
    <?php
    echo ' <input class="forminput" type="number" min="0" name="gyozelem" value="'.$csapatadat['gyozelem'].'">';
    ?>
    <br>
    <label class="formlabel">Vereseg:</label>
    <?php
    echo ' <input class="forminput" type="number" min="0" name="vereseg" value="'.$csapatadat['vereseg'].'">';
    ?>
    <br>
    <label class="formlabel">Dontetlen</label>
    <?php
    echo ' <input class="forminput" type="number" min="0" name="dontetlen" value="'.$csapatadat['dontetlen'].'">';
    ?>
    <br>
	<label class="formlabel">Divizio</label>
    <?php
    echo ' <input class="forminput" type="text" name="divizio" value="'.$csapatadat['divizio'].'">';
    ?>
    <br>
	<label class="formlabel">Meccsid</label>
    <?php
    echo ' <input class="forminput" type="text" name="meccsid" value="'.$csapatadat['meccsid'].'">';
    ?>
    <br>
	<label class="formlabel">Edzoid</label>
    <?php
    echo ' <input class="forminput" type="text" name="edzoid" value="'.$csapatadat['edzoid'].'">';
    ?>
    <br>
    <input class="forminput" type="submit"  value="Szerkesztes">
</form>
<form method="POST" action="csapattorles.php">
    <?php
    echo '<input type="hidden" name="csapatid" value="'.$v_csapatid.'">';
    ?>
    <input  class="forminput" type="submit" value="Torles">
</form>
</div>

</table>
</HTML>