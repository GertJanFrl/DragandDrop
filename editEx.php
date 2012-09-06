<?php
include'connection.php';
if (!checklogin())
{
	header("location:login.php");
}else{

if($_GET['do'] == "logout")
{
	mysql_query("DELETE FROM sessions WHERE hash = '".$_COOKIE['hash']."' ");
	header("location:login.php");
}


if(isset($_FILES['postImg']['name']) && $_FILES['postImg']['name'] != ""){
	$target = "res/";
	$sqltarget = "res/";
	$target = $target.basename($_FILES['postImg']['name']); 
	$ok=1;

	//This is our size condition 
	if ($uploaded_size > 350000) { 
		$message = "Your file is too large.<br>"; 
		$ok=0; 
	} 

	//This is our limit file type condition 
	if ($uploaded_type =="text/php") { 
		$message = "No PHP files<br>"; 
		$ok=0;
	} 

	//Here we check that $ok was not set to 0 by an error 
	if ($ok==0) {
		$message = "Sorry your file was not uploaded"; 
	}else{ //If everything is ok we try to upload it 
		if(move_uploaded_file($_FILES['postImg']['tmp_name'], $target)) 
		{ 
			$message = "The file ".basename($_FILES['postImg']['name'])." has been uploaded"; 
			$_POST['postImg'] = $sqltarget.$_FILES['postImg']['name'];
			/*RESIZE HIER!!*/
		}else{ 
			$message = "Sorry, there was a problem uploading your file."; 
		}
	}	
}
if(isset($_POST['opdracht']) && isset($_POST['postName']) && $_POST['postName'] !== '' && $_POST['postImg'] !== ''){
	mysql_query("INSERT INTO drag_opdrachten_".$_POST['postOef']." (name, image) VALUES ('".$_POST['postName']."', '".$_POST['postImg']."')") or die(mysql_error());
			$message = "Opdracht gemaakt"; 
}elseif(isset($_POST['oefening']) && isset($_POST['postName'])){
	mysql_query("INSERT INTO drag_oefeningen (name) VALUES ('".$_POST['postName']."')") or die(mysql_error());
	mysql_query("CREATE TABLE IF NOT EXISTS `drag_opdrachten_".mysql_insert_id()."` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;") or die(mysql_error());
			$message = "Oefening gemaakt"; 
}//elseif(isset($_GET['delete'])){
	// $currentQuery = mysql_query("DELETE FROM oefeningen WHERE id='".$_GET['delete']."'");
	// $currentQuery = mysql_query("DELETE FROM divs WHERE oefeningID='".$_GET['delete']."'");
// }
$query[0] = mysql_query("SELECT * FROM drag_oefeningen") or die(mysql_error()); 
$query[1] = mysql_query("SELECT * FROM drag_oefeningen") or die(mysql_error());
?>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
		<link href="style.css" type="text/css" rel="stylesheet">
	</head>
	<body>
	<?php if(isset($message)){ echo $message; } ?>
	<?php if(isset($_GET['oefening']) && is_numeric($_GET['oefening'])){ 
$query[2] = mysql_query("SELECT * FROM drag_oefeningen WHERE id='".$_GET['oefening']."'") or die(mysql_error());
$oefeningresult = mysql_fetch_array($query[2]); ?>
	<table border="2" class="float_left">
		<form  enctype="multipart/form-data"  method="post" action="editEx.php?oefening=<?php echo $_GET['oefening']; ?>">
		<th>Nieuwe opdracht..</th>
			<input type="hidden" name="opdracht"/>
			<tr><td>Naam: </td><td><input name="postName" /></td></tr>
			<tr><td>Afbeelding: </td><td><input type="file" name="postImg" /></td></tr>
			<tr><td>Oefening: </td><td><input type="input" name="postOef" value="<?php echo $oefeningresult['id']; ?>" style="width:25px;" READNOLY><?php echo $oefeningresult['name']; ?>
			</select></td></tr>
			<tr><td><button type="submit">Nieuwe opdracht</button></td><td>Maximaal 12 in een oefening!</td></tr>
		</form>
	</table>
			<?php $query[3] = mysql_query("SELECT * FROM drag_oefeningen WHERE id='".$_GET['oefening']."'") or die(mysql_error());
			$resultrows = mysql_num_rows($query[3]); $i; $i = 3; 
			while($result = mysql_fetch_array($query[3])){ ?>
	<div class="float_left" style="margin-left:70px;">
		<table border="1">
		<tr><td><a href="?normal">Klik hier om terug te gaan</a></td></tr>
			<th><?php echo $result['name']; ?>: Alle opdrachten</th>
				<?php $query[$i] = mysql_query("SELECT * FROM drag_opdrachten_".$_GET['oefening']." LIMIT 12") or die(mysql_error()); 
				while($oefeningen = mysql_fetch_array($query[$i])){ ?>
				<tr><td><b><?php echo $oefeningen['id'].'</b>&nbsp;'.$oefeningen['name']; ?></td></tr>
				<?php } $i++; ?>
		</table>
	</div>
			<?php } ?>
	<div class="clear"><br /></div>
	<?php }else{ ?>
	<div class="float_left">
		<table border="2">
		<form  enctype="multipart/form-data"  method="post" action="editEx.php">
			<th>Nieuwe oefening..</th>
			<input type="hidden" name="oefening"/>
			<tr><td>Naam: </td><td><input name="postName" required="required" /></td></tr>
			<tr><td><button type="submit">Nieuwe oefening</button></td></tr>
		</form>
		</table>
	</div>
	<div class="float_left" style="margin-left:160px;">
		<table border="1">
			<th>Alle oefeningen:</th>
			<?php while($oefeningen = mysql_fetch_array($query[1])){ ?>
			<tr><td><b><?php echo $oefeningen['id'].'</b>&nbsp;<a href="?oefening='.$oefeningen['id'].'">'.$oefeningen['name']; ?></a></td></tr>
			<?php } ?>
		</table>
	</div>
	<?php
echo "<a href='?do=logout'>Uitloggen</a>";
	}} ?>
	</body>
</html>