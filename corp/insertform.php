<?php

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

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
		$query = 'INSERT INTO corp (';

		$query = $query . "`id`,`company`,`category`,`undertitle`,`address1`,`address2`,`city`,`state`,`zip`,`zip4`,`country`,`prcontact`,`prtitle`,`prcontactphone`,`prcontactfax`,`prcontactemail`,`phone`,`fax`,`email`,`url`,`miscinfo1`,`miscinfo2`,`validated`,`username`,`userid`,`lastupdated`";
		$query = $query . ") VALUES (";

		$id = $session->CreateGUID();

		$id = "{".$id."}";

		$query = $query . '"' . $id . '",';
		$query = $query . '"' . $_POST['company'] . '",';
		$query = $query . '"' . $_POST['category'] . '",';
		$query = $query . '"' . $_POST['undertitle'] . '",';
		$query = $query . '"' . $_POST['address1'] . '",';
		$query = $query . '"' . $_POST['address2'] . '",';
		$query = $query . '"' . $_POST['city'] . '",';
		$query = $query . '"' . $_POST['state'] . '",';
		$query = $query . '"' . $_POST['zip'] . '",';
		$query = $query . '"' . $_POST['zip4'] . '",';
		$query = $query . '"' . $_POST['country'] . '",';
		$query = $query . '"' . $_POST['prcontact'] . '",';
		$query = $query . '"' . $_POST['prtitle'] . '",';
		$query = $query . '"' . $_POST['prcontactphone'] . '",';
		$query = $query . '"' . $_POST['prcontactfax'] . '",';
		$query = $query . '"' . $_POST['prcontactemail'] . '",';
		$query = $query . '"' . $_POST['phone'] . '",';
		$query = $query . '"' . $_POST['fax'] . '",';
		$query = $query . '"' . $_POST['email'] . '",';
		$query = $query . '"' . $_POST['url'] . '",';
		$query = $query . '"' . $_POST['miscinfo1'] . '",';
		$query = $query . '"' . $_POST['miscinfo2'] . '",';

		if($_POST['validated']=='on')
			{
			$query = $query . '"1",';
		}else{
			$query = $query . '"0",';
		}

		$query = $query . '"' . $session->UserName . '",';
		$query = $query . '"' . $session->UserID . '",';
		$query = $query . '"' . date('Y-m-d') . '"';
		$query = $query . ')';

		$url = "editfirm.php?sessionid=". $session->SessionID . "&id=" . $id;

		mysql_query($query);

//		echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'">';

		###echo "$query";
	}

?>
