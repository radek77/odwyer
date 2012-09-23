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
		
		$query = 'UPDATE corpstaff SET ';

		$query = $query . '`name` = "' . $_POST['name'] . '",';
		$query = $query . '`title` = "' . $_POST['title'] . '",';
		$query = $query . '`address1` = "' . $_POST['address1'] . '",';
		$query = $query . '`address2` = "' . $_POST['address2'] . '",';
		$query = $query . '`city` = "' . $_POST['city'] . '",';
		$query = $query . '`state` = "' . $_POST['state'] . '",';
		$query = $query . '`zip` = "' . $_POST['zip'] . '",';
		$query = $query . '`country` = "' . $_POST['country'] . '",';
		$query = $query . '`phone` = "' . $_POST['phone'] . '",';
		$query = $query . '`fax` = "' . $_POST['fax'] . '",';
		$query = $query . '`email` = "' . $_POST['email'] . '",';
		$query = $query . '`userid` = "' . $session->UserID . '",';
		$query = $query . '`lastupdated` = "' . date('Y-m-d') . '"';
				
		
		$query = $query . ' WHERE `id` = "'. $_POST['id'].'"';
		
				
		mysql_query($query);
		
	}
	
?>

<html>
	<head>
		<meta http-equiv="cache-control" content="no-cache">
		<script>
			function refreshframe() {
				top.main.edit.list.location.href = 'stafflist.php?sessionid=<?php echo $_POST['sessionid'] ?>&id=<?php echo $_POST['cid'] ?>';
				top.main.edit.viewedit.location.href = 'addstaffform.php?sessionid=<?php echo $_POST['sessionid'] ?>&id=<?php echo $_POST['cid'] ?>';
			}
		</script>
	</head>		
	<body onload="javascript:refreshframe()">
	</body>
</html>