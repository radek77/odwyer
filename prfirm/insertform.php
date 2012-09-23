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
		$query = 'INSERT INTO prfirm (';

		$query = $query . "`id`,`name`,`undertitle`,`address1`,`address2`,`address3`,`address4`,`city`,`state`,`zip`,`zip4`,`province`,`country`,`contact`,`title`,`phone`,`fax`,`email`,`url`,`ranked`,`alpha`,`employees`,`founded`,`miscinfo`,`logo`,`staffinfo`,`username`,`userid`,`lastupdated`";
		$query = $query . ") VALUES (";
		
		$id = $session->CreateGUID();
		$query = $query . '"' . $id . '",';
		$query = $query . '"' . $_POST['prfirmname'] . '",';
		$query = $query . '"' . $_POST['undertitle'] . '",';
		$query = $query . '"' . $_POST['address1'] . '",';
		$query = $query . '"' . $_POST['address2'] . '",';
		$query = $query . '"' . $_POST['address3'] . '",';
		$query = $query . '"' . $_POST['address4'] . '",';
		$query = $query . '"' . $_POST['city'] . '",';
		$query = $query . '"' . $_POST['state'] . '",';
		$query = $query . '"' . $_POST['zip'] . '",';
		$query = $query . '"' . $_POST['zip4'] . '",';
		$query = $query . '"' . $_POST['province'] . '",';
		$query = $query . '"' . $_POST['country'] . '",';
		$query = $query . '"' . $_POST['contact'] . '",';
		$query = $query . '"' . $_POST['title'] . '",';
		$query = $query . '"' . $_POST['phone'] . '",';
		$query = $query . '"' . $_POST['fax'] . '",';
		$query = $query . '"' . $_POST['email'] . '",';
		$query = $query . '"' . $_POST['url'] . '",';
		
		if($_POST['ranked']=='on')
		{					
			$query = $query . '"1",';
		}else{
			$query = $query . '"0",';
		}
		
		$query = $query . '"' . strtoupper(substr($_POST['prfirmname'], 0, 1)) . '",';
		$query = $query . '"' . $_POST['employees'] . '",';
		$query = $query . '"' . $_POST['founded'] . '",';
		//$miscinfo = str_replace('"', '\"', $_POST['miscinfo']);
		$query = $query . '"' .  $_POST['miscinfo'] . '",';
		
		if($_POST['logo']=='on')
		{					
			$query = $query . '"1",';
		}else{
			$query = $query . '"0",';
		}
						
		$query = $query . '"' . $_POST['mainstaff'] . '",';
		$query = $query . '"' . $session->UserName . '",';
		$query = $query . '"' . $session->UserID . '",';
		$query = $query . '"' . date('Y-m-d') . '"';
		$query = $query . ')';

		$url = "editfirm.php?sessionid=". $session->SessionID . "&id=" . $id;
		
		mysql_query($query);
		
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
	}
	
?>
