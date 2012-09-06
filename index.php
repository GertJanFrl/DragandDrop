<?php include'connection.php'; if(isset($_GET['oefening'])){ $oefening = $_GET['oefening']; }else{ $oefening = '1'; }
$query = mysql_query("SELECT * FROM drag_oefeningen WHERE id='".$oefening."'") or die(mysql_error()); 
$result = mysql_fetch_array($query); ?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
	<link href="style.css" type="text/css" rel="stylesheet">
	<script language="javascript" src="java.js"></script>
	<title>Opdrachten (<?php echo $result['name']; ?>)</title>
</head>
<body onload="init();">
<center><div id="Wrapper">
	<div id="sidebar" style="margin-right: 20px;">
		<h1><?php echo $result['name']; ?></h1>
		<div id="TopscoreBoard" class="scoreBoard">
			<a class="text">0 fout</a> |
			<a class="text">0 goed</a>
		</div>
			<div id="einde"><!-- Niks --></div>
		<?php //Lees bestand met woorden...
		$query = mysql_query("SELECT * FROM drag_opdrachten_".$oefening." LIMIT 12") or die("Deze oefening bestaat niet!");
		$rows = mysql_num_rows($query);
		if($rows > 0){	$i;	$words;	$i = 0;
			while($result = mysql_fetch_array($query)){ 
				$words[$i] = $result['name'];
				$currentWord = $result['name'];
				$image[$i] = $result['image'];
				echo"<li href='#' class='dragableWord' onClick=SoundPlay('".$result['name']."') data-value='".$result['id']."' draggable='true'>
					".ucfirst($result['name'])."</li>";
				$i++;
			}
		}else{
			echo 'Geen woorden gevonden!';
		} ?>
	</div>
	<div id="afbeeldingwrapper">
		<?php
		if($rows > 0){
		for($j = 0; $j <= count($words) - 1; $j++){ //Maak de afbeelding array
			if(trim($words[$j]) != "")
			{
				$ImageCodes[$j] =	"<div class='entry' style='float: left;'>
										<img border='0' width='218' height='150' draggable='false' src='".trim($image[$j])."' /><br />
										<div data-value='".($j+1)."' dropzone='move text/woord' class='dropZone'>Sleep het woord hier heen..</div>
									</div>";
			}
		}
		shuffle($ImageCodes);
		for ($j = 0; $j <= count($ImageCodes) - 1; $j++) {
			echo $ImageCodes[$j]; 
		}
		}else{
			echo 'Geen images gevonden!';
		} ?>
		<div id="soundCont"></div>
	</div>
</div></center>
</body>
</html>