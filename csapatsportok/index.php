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
<div class="row" >
    <div class="column" style="background-color:#ac4f4f;">
        <h1>Csapatok 60 ev feletti edzovel</h1>
        <table class="eredmeny">
            <tr>
                <th>Csapatnev</th>
                <th>Edzo eletkor</th>
            </tr>
        <?php
        include_once("db_fuggvenyek.php");
        $eletkor=lekerdezes1();
        while($egysor =mysqli_fetch_assoc($eletkor)){
            echo '<tr>';
            echo '<td>'.$egysor["nev"].'</td>';
            echo '<td>'.$egysor["eletkor"].'</td>';
            echo '</tr>';
        }
        mysqli_free_result($eletkor);
        ?>
        </table>
		<hr>
		<h1>9nel nagyobb mezszamok</h1>
        <table class="eredmeny">
            <tr>
                <th>Mezszam</th>
                <th>Csapatnev</th>
            </tr>
        <?php
        include_once("db_fuggvenyek.php");
        $mezszam=lekerdezes2();
        while($egysor =mysqli_fetch_assoc($mezszam)){
            echo '<tr>';
            echo '<td>'.$egysor["mezszam"].'</td>';
            echo '<td>'.$egysor["nev"].'</td>';
            echo '</tr>';
        }
        mysqli_free_result($mezszam);
        ?>
        </table>
		<hr>
		<h1>Csapatok, 30 evnel idosebb jatekosokkal</h1>
        <table class="eredmeny">
            <tr>
                <th>Csapatnev</th>
                <th>Kor</th>
            </tr>
        <?php
        include_once("db_fuggvenyek.php");
        $kor=lekerdezes3();
        while($egysor =mysqli_fetch_assoc($kor)){
            echo '<tr>';
            echo '<td>'.$egysor["nev"].'</td>';
			echo '<td>'.$egysor["kor"].'</td>';
            echo '</tr>';
        }
        mysqli_free_result($kor);
        ?>
        </table>
		
    </div>
</div>
</body>
</HTML>