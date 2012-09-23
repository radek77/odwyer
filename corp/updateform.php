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
		
		$query = 'UPDATE corp SET ';
		$query2 = 'SELECT ';
		$delay = "0"; // 3 second delay

		switch ($_POST['currentid']) {
			case 'main':
				$query = $query . '`company` = "' . $_POST['company'] . '",';
				$query = $query . '`category` = "' . $_POST['category'] . '",';
				$query = $query . '`undertitle` = "' . $_POST['undertitle'] . '",';
				$query = $query . '`address1` = "' . $_POST['address1'] . '",';
				$query = $query . '`address2` = "' . $_POST['address2'] . '",';
				$query = $query . '`city` = "' . $_POST['city'] . '",';
				$query = $query . '`state` = "' . $_POST['state'] . '",';
				$query = $query . '`zip` = "' . $_POST['zip'] . '",';
				$query = $query . '`zip4` = "' . $_POST['zip4'] . '",';
				$query = $query . '`country` = "' . $_POST['country'] . '",';
				$query = $query . '`prcontact` = "' . $_POST['prcontact'] . '",';
				$query = $query . '`prtitle` = "' . $_POST['prtitle'] . '",';
				$query = $query . '`prcontactphone` = "' . $_POST['prcontactphone'] . '",';
				$query = $query . '`prcontactfax` = "' . $_POST['prcontactfax'] . '",';
				$query = $query . '`prcontactemail` = "' . $_POST['prcontactemail'] . '",';
				$query = $query . '`phone` = "' . $_POST['phone'] . '",';
				$query = $query . '`fax` = "' . $_POST['fax'] . '",';
				$query = $query . '`email` = "' . $_POST['email'] . '",';
				$query = $query . '`url` = "' . $_POST['url'] . '",';
				$query = $query . '`miscinfo1` = "' . $_POST['miscinfo1'] . '",';
				$query = $query . '`miscinfo2` = "' . $_POST['miscinfo2'] . '",';
				
					if($_POST['validated']=='on')
					{					
						$query = $query . '`validated` = "1",';
					}else{
						$query = $query . '`validated` = "0",';
					}
					
				$query = $query . '`username` = "' . $session->UserName . '",';
				$query = $query . '`userid` = "' . $session->UserID . '",';
				$query = $query . '`lastupdated` = "' . date('Y-m-d') . '"';
				
				$query2 = $query2 . "*";

				$url = "editmainform.php?sessionid=". $session->SessionID . "&id=" . $_POST['id'];
				break;		
			default:
				break;
		}
		
		$query2 = $query2 . ' FROM corp WHERE `id` = "'. $_POST['id'].'"';
		$query = $query . ' WHERE `id` = "'. $_POST['id'].'"';
		
		
		$i=0;
		$result = mysql_query($query2);
		$record ='';
		while( $row=mysql_fetch_array($result) )
		{
			if($i < 1)
			{
				$record = serialize($row);
			}
		}
		
		$query3 = 'INSERT INTO changelogcorp (`id`,`data`,`userid`,`changetime`) VALUES (';
		$query3 = $query3 . '"' . $session->CreateGUID() . '",';
		$query3 = $query3 . '"' . str_replace('"', '\"', $record) . '",';
		$query3 = $query3 . '"' . $session->UserID . '",';
		$query3 = $query3 . '"' . date('Y-m-d G:i:s') . '")';
		
		
		mysql_query($query3);
		
		mysql_query($query);
		
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
	}
	
?>
