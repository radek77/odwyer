<?php
	require_once('session.php');
	
	$session = new Session();
		
	if(!$session->LogIn($_POST['uid'],$_POST['pwd']))
	{		
		echo "<html>";
		echo "<head>";
		echo "<title>J.R. O'Dwyer Co.</title>";
		echo "</head>";
		echo "<body bgcolor=\"#ffffff\" text=\"Black\" link=\"Blue\" vlink=\"Purple\" alink=\"Red\" leftmargin=\"0\" topmargin=\"0\" marginheight=\"0\" marginwidth=\"0\">";
		echo "<br><br><div align=\"center\"><span class=\"bodytext\"><b>Your Log-In Failed<br><br><a href=\"index.php\" target=\"_top\">Click Here to Try Again</a></b></span></div>";
		echo "</body>";
		echo "</html>";
	}else{
?>
<html>
<head>
<meta http-equiv="cache-control" content="no-cache">
<title>J.R. O'Dwyer Co.</title>
</head>
<frameset rows="23,*" border="0">
    <frame name="toolbar" src="toolbar.php?sessionid=<?php echo $session->SessionID; ?>" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" border="0" noresize="no">
    <frame name="main" src="main.php?sessionid=<?php echo $session->SessionID; ?>" marginwidth="0" marginheight="0" scrolling="yes" frameborder="0" border="0" noresize="auto">
</frameset>
</html>
<?php
	}
?>