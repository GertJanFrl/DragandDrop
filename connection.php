<?php
// This file is not created by ME!
$config["host"] = "localhost";
$config["uName"] = "user";
$config["dPass"] = "password";
$config["dbName"] = "database";

function sqlsafe($data) 
{
	$data = mysql_real_escape_string($data);
	return $data;
}

$ledentabel = "users";

$sqlConnection = mysql_connect($config["host"],$config["uName"],$config["dPass"]) or die(mysql_error());
mysql_select_db($config["dbName"], $sqlConnection) or die(mysql_error());

// Hash enzo generaten voor user
if(($_SERVER['REQUEST_METHOD'] == "POST") && ($_POST['login'])) {
     $selectleden = mysql_query("SELECT * FROM $ledentabel WHERE username = '".sqlsafe($_POST['username'])."' AND password = '".sqlsafe(md5($_POST['password']))."'");
	 //$loginhistory = mysql_query("SELECT * FROM loginhistory WHERE username = '".sqlsafe($_POST['username'])."' AND ip = '".$_SERVER['REMOTE_ADDR']."'");
	 //$loginhistory_block = mysql_query("SELECT * FROM loginhistory WHERE username = '".sqlsafe($_POST['username'])."' AND attempts >='5' AND date >= DATE_SUB(NOW(), INTERVAL 1 HOUR)");
	 //$historyassoc2 = mysql_fetch_assoc($loginhistory_block);
	 //$historyassoc = mysql_fetch_assoc($loginhistory);
     if(mysql_num_rows($selectleden)) {
								  
									  // Ingelogd
                                      $hash = md5(uniqid(rand(), true));
                                      $get_id = mysql_query("SELECT id FROM users WHERE username = '".sqlsafe($_POST['username'])."' AND password = '".sqlsafe(md5($_POST['password']))."'");
                                      $fetch_id = mysql_fetch_assoc($get_id);
                                      //$expireSQL = mysql_query("SELECT * FROM groups WHERE id = '".$fetch_id['groupId']."' AND expireDate <= CURDATE()");
									  $insert_session = mysql_query("INSERT INTO sessions (userid, hash, ip, logintime) VALUES ('".$fetch_id['id']."','".$hash."','".$_SERVER['REMOTE_ADDR']."',NOW())");
									#Debug Modego
                                    #$bericht = "Ingelogd met hash: ".$hash." En je hebt id-nummer:".$fetch_id['id'];
									
                                      if ($insert_session) {
                                         setcookie ("id", $fetch_id['id'],time()+"28800");
                                         setcookie ("hash", $hash,time()+"28800");
										 

										 header("location:editEx.php");
                                                           } else {
                                                           echo "Fout in de query: ".mysql_error();
                                                           exit();
                                                           }}
									
										

										 
                                      // Foute pass
                                      $returnlogin = "<b>U heeft een verkeerde gebruikersnaam en/of wachtwoord ingevoerd.</b>";
									}



	 

// Login functie check
function checklogin() {
if (mysql_num_rows(mysql_query("SELECT userid, `hash`, ip FROM `sessions` WHERE `userid` = '".sqlsafe($_COOKIE['id'])."' AND `hash` = '".sqlsafe($_COOKIE['hash'])."' AND `ip` = '".sqlsafe($_SERVER['REMOTE_ADDR'])."'"))) {
        $return  = TRUE;
    } else {
        $return = FALSE;
    }

    return $return;
}

// Data uit leden-tabel oproepen ($get_userdata['username'], $get_userdata['warnings']
$get_data_qry = mysql_query("SELECT userid, `hash` FROM `sessions` WHERE `userid` = '".sqlsafe($_COOKIE['id'])."' AND `hash` = '".sqlsafe($_COOKIE['hash'])."'");
$get_data = mysql_fetch_assoc($get_data_qry);
$get_userdata = mysql_fetch_assoc(mysql_query("SELECT * FROM $ledentabel WHERE id = '".$get_data['userid']."'"));
//$get_groupdata = mysql_fetch_array(mysql_query("SELECT * FROM groups WHERE id = '".$get_userdata['groupId']."'"));
?>
