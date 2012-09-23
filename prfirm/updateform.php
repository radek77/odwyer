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
		
		$query = 'UPDATE prfirm SET ';
		$query2 = 'SELECT ';
		$delay = "0"; // 3 second delay


		switch ($_POST['currentid']) {
			case 'main':
				$query = $query . '`name` = "' . $_POST['prfirmname'] . '",';
				$query = $query . '`undertitle` = "' . $_POST['undertitle'] . '",';
				$query = $query . '`address1` = "' . $_POST['address1'] . '",';
				$query = $query . '`address2` = "' . $_POST['address2'] . '",';
				$query = $query . '`address3` = "' . $_POST['address3'] . '",';
				$query = $query . '`address4` = "' . $_POST['address4'] . '",';
				$query = $query . '`city` = "' . $_POST['city'] . '",';
				$query = $query . '`state` = "' . $_POST['state'] . '",';
				$query = $query . '`zip` = "' . $_POST['zip'] . '",';
				$query = $query . '`zip4` = "' . $_POST['zip4'] . '",';
				$query = $query . '`province` = "' . $_POST['province'] . '",';
				$query = $query . '`country` = "' . $_POST['country'] . '",';
				$query = $query . '`contact` = "' . $_POST['contact'] . '",';
				$query = $query . '`title` = "' . $_POST['title'] . '",';
				$query = $query . '`phone` = "' . $_POST['phone'] . '",';
				$query = $query . '`fax` = "' . $_POST['fax'] . '",';
				$query = $query . '`email` = "' . $_POST['email'] . '",';
				$query = $query . '`url` = "' . $_POST['url'] . '",';
				$query = $query . '`logourl` = "' . $_POST['logourl'] . '",';
				$query = $query . '`employees` = "' . $_POST['employees'] . '",';
				$query = $query . '`founded` = "' . $_POST['founded'] . '",';
				//$miscinfo = str_replace('"', '\"', $_POST['miscinfo']);
				$query = $query . '`miscinfo` = "' . $_POST['miscinfo'] . '",';
								
				if($_POST['ranked']=='on')
				{					
					$query = $query . '`ranked` = "1",';
				}else{
					$query = $query . '`ranked` = "0",';
				}
				
				if($_POST['logo']=='on')
				{					
					$query = $query . '`logo` = "1",';
				}else{
					$query = $query . '`logo` = "0",';
				}
				
				if($_POST['validated']=='on')
				{					
					$query = $query . '`validated` = "1",';
				}else{
					$query = $query . '`validated` = "0",';
				}
				
				$query = $query . '`alpha` = "' . strtoupper(substr($_POST['prfirmname'], 0, 1)) . '",';
				$query = $query . '`staffinfo` = "' . $_POST['mainstaff'] . '",';
				$query = $query . '`username` = "' . $session->UserName . '",';
				$query = $query . '`userid` = "' . $session->UserID . '",';
				$query = $query . '`lastupdated` = "' . date('Y-m-d') . '"';
				
				$query2 = $query2 . "`name`,`undertitle`,`address1`,`address2`,`address3`,`address4`,`city`,`state`,`zip`,`zip4`,`country`,`contact`,`title`,`phone`,`fax`,`email`,`url`,`employees`,`miscinfo`,`founded`,`staffinfo`,`userid`";

				$url = "editmainform.php?sessionid=". $session->SessionID . "&id=" . $_POST['id'];
				break;
				
			case 'office':
				$officeinfo = str_replace('"', '\"', $_POST['officeinfo']);
				$office_locations = str_replace('"', '\"', $_POST['office_locations']);
				$office_locations_international = str_replace('"', '\"', $_POST['office_locations_international']);
				$query = $query . '`officeinfo` = "' . $officeinfo . '",';
				$query = $query . '`office_locations` = "' . $office_locations . '",';
				$query = $query . '`office_locations_international` = "' . $office_locations_international . '",';
				$query = $query . '`username` = "' . $session->UserName . '",';
				$query = $query . '`userid` = "' . $session->UserID . '",';
				$query = $query . '`lastupdated` = "' . date('Y-m-d') . '"';
				
				$query2 = $query2 . "`officeinfo`";
				
				$url = "editofficeform.php?sessionid=". $session->SessionID . "&id=" . $_POST['id'];
				break;
				
			case 'client':
				$clientinfo = str_replace('"', '\"', $_POST['clientinfo']);
				$query = $query . '`clientinfo` = "' . $clientinfo . '",';
				$query = $query . '`username` = "' . $session->UserName . '",';
				$query = $query . '`userid` = "' . $session->UserID . '",';
				$query = $query . '`lastupdated` = "' . date('Y-m-d') . '"';
				
				$query2 = $query2 . "`clientinfo`";
				
				$url = "editclientform.php?sessionid=". $session->SessionID . "&id=" . $_POST['id'];
				break;
		
			case 'category':
				if (isset($_POST['category_code'])) {
					$categoryinfo = $_POST['category_code'];
				}
				else {
					$categoryinfo = "";
				}
				
				if ($categoryinfo != "") { 
					if (is_array($categoryinfo)) { 
						$categoryinfo_string = join ("|",$categoryinfo);
					}
					else {
						$categoryinfo_string = $categoryinfo;
					}
				}
				else {
					$categoryinfo_string = "";
				}
				
				$query = $query . '`category` = "' . $categoryinfo_string . '",';
				$query = $query . '`username` = "' . $session->UserName . '",';
				$query = $query . '`userid` = "' . $session->UserID . '",';
				$query = $query . '`lastupdated` = "' . date('Y-m-d') . '"';
				
				$query2 = $query2 . "`category`";
				
				$url = "editcategory.php?sessionid=". $session->SessionID . "&id=" . $_POST['id'];
				break;
				
			case 'agency':
				$agencystatement = str_replace('"', '\"', $_POST['agencystatement']);
				$query = $query . '`agencystatement` = "' . $agencystatement . '",';
				$query = $query . '`username` = "' . $session->UserName . '",';
				$query = $query . '`userid` = "' . $session->UserID . '",';
				$query = $query . '`lastupdated` = "' . date('Y-m-d') . '"';
				
				$query2 = $query2 . "`agencystatement`";
						
				$url = "editagencyform.php?sessionid=". $session->SessionID . "&id=" . $_POST['id'];
				break;
		
			default:
				break;
		}
		
		$query2 = $query2 . ' FROM prfirm WHERE `id` = "'. $_POST['id'].'"';
		$query = $query . ' WHERE `id` = "'. $_POST['id'].'"';
		
		
		
		$result = mysql_query($query2);
		$record ='';
		$i=0;
		while( $row=mysql_fetch_array($result) )
		{
			if($i < 1)
			{
				$record = serialize($row);
			}
		}
		
		$query3 = 'INSERT INTO changelog (`id`,`data`,`userid`,`changetime`) VALUES (';
		$query3 = $query3 . '"' . $session->CreateGUID() . '",';
		$query3 = $query3 . '"' . str_replace('"', '\"', $record) . '",';
		$query3 = $query3 . '"' . $session->UserID . '",';
		$query3 = $query3 . '"' . date('Y-m-d G:i:s') . '")';
		
		
		mysql_query($query3);
		
		mysql_query($query);
		
		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';
	}
	
?>
