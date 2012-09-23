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
		
		$delay = "0"; // 3 second delay
		$query = 'INSERT INTO corpstaff (';

		$query = $query . "`id`,`cid`,`name`,`title`,`address1`,`address2`,`city`,`state`,`zip`,`country`,`phone`,`fax`,`email`,`userid`,`lastupdated`";
		$query = $query . ") VALUES (";
		
		$id = $session->CreateGUID();
		$query = $query . '"' . $id . '",';
		$query = $query . '"' . $_POST['cid'] . '",';
		$query = $query . '"' . $_POST['name'] . '",';
		$query = $query . '"' . $_POST['title'] . '",';
		$query = $query . '"' . $_POST['address1'] . '",';
		$query = $query . '"' . $_POST['address2'] . '",';
		$query = $query . '"' . $_POST['city'] . '",';
		$query = $query . '"' . $_POST['state'] . '",';
		$query = $query . '"' . $_POST['zip'] . '",';
		$query = $query . '"' . $_POST['country'] . '",';
		$query = $query . '"' . $_POST['phone'] . '",';
		$query = $query . '"' . $_POST['fax'] . '",';
		$query = $query . '"' . $_POST['email'] . '",';
		$query = $query . '"' . $session->UserID . '",';
		$query = $query . '"' . date('Y-m-d') . '"';
		$query = $query . ')';

		//$url = "addfirm.php?sessionid=". $session->SessionID . "&id=" . $id;
		
		mysql_query($query);
		
		//echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
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