<?php
include("connection.php");
if (checklogin())
{
	header("location:editEx.php");
}else{
if(isset($returnlogin))
{
	echo "<font color='#FF0000'>".$returnlogin."</font><br /><br /><a href=\"javascript:history.go(-1)\">« Terug</a>";
}else{
	echo "<h1>Voer uw gebruikersnaam en wachtwoord in.<br /></h1>";

?>
<html>
<!-- Created by: Gertlily.com & Slaapkop -->
<head>
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
	<link href="style.css" type="text/css" rel="stylesheet">
	<script language="javascript" src="java.js"></script>
	<title>Opdrachten (<?php echo $result['name']; ?>)</title>
</head>
<body>
<form method="POST" action="">
  <br />
  <br />
  <table border="0" cellpadding="3" cellspacing="5" width="361">
    <tr>
    <td width="128">Gebruikersnaam:</td>
    <td width="206"><input type="text" name="username" size="20"></td>
  </tr>
  <tr>
    <td width="128">Wachtwoord: </td>
    <td width="206"><input type="password" name="password" size="20"></td>
  </tr>
   <tr>
     <td>&nbsp;</td>
     <td><input type="submit" value="Inloggen" name="login" /></td>
   </tr>
</table>
  <p>&nbsp;</p>
  Copyright &copy; FC-Sprint²
</form>
<? }} ?>
</body>
</html>