<?php
	require_once('session.php');
	
	$session = new Session();
		
	if(!$session->ValidateSession($_POST['sessionid']))
	{		
		echo "<html>";
		echo "<head>";
		echo "<title>J.R. O'Dwyer Co.</title>";
		echo "</head>";
		echo "<body bgcolor=\"#ffffff\" text=\"Black\" link=\"Blue\" vlink=\"Purple\" alink=\"Red\" leftmargin=\"0\" topmargin=\"0\" marginheight=\"0\" marginwidth=\"0\">";
		echo "<br><br><div align=\"center\"><span class=\"bodytext\"><b>Your Session Expired<br><br><a href=\"index.php\" target=\"_top\">Click Here to Try Again</a></b></span></div>";
		echo "</body>";
		echo "</html>";
	}else{
		
		if(!mysql_connect("localhost","root","oldhouse"))
		{
			echo "<h2>Can't Connect to Database.</h2>";
			die();
		}
		
		mysql_select_db("odwyer");
		
		
		$query = "UPDATE prfirm SET `username`='" . $session->UserName . "', `userid`='" . $session->UserID . "', `lastupdated`='" . date('Y-m-d') . "', `inactive` = 1 WHERE `id` = '".$_POST['firmid']."'";		
		mysql_query($query);
?>
<html>
<head>
	<title>J.R. O'Dwyer Co.</title>
</head>

<body onload="javascript:document.forms[0].submit();" bgcolor="White" text="Black" link="Blue" vlink="Purple" alink="Red" rightmargin="0" bottommargin="0" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">	
	<form method="post" action="intlist.php">
		<input name="sessionid" type="hidden" value="<?php echo $session->SessionID; ?>"/>
		<input name="matchtype" type="hidden" value="<?php echo $_POST['matchtype']; ?>"/>
		<input name="fieldname" type="hidden" value="<?php echo $_POST['fieldname']; ?>"/>
		<input name="fieldvalue" type="hidden" value="<?php echo $_POST['fieldvalue']; ?>"/>
		<input name="sortorder" type="hidden" value="<?php echo $_POST['sortorder']; ?>"/>
		<input name="country" type="hidden" value="<?php echo $_POST['country']; ?>"/>
	</form>
</body>
</html>
<?php
	}
?>