<?php
	require_once('session.php');
	
	$session = new Session();
		
	if(!$session->ValidateSession($_GET['sessionid']))
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
?>
<html>
<head>
	<title>J.R. O'Dwyer Co.</title>	
	<style type="text/css">
		.bodytext{color: #000000;
			font-family: Arial, Helvetica, sans-serif, Verdana, Geneva;
			font-size: 11px;
			}
		.bodytext a{color: #0000ff;
			}
		.bodytext a:link{color: #0000ff;
			}
		.bodytext a:visited{color: #0000ff;
			}
		.bodytext a:hover{color: #ff0000;
			}
	</style>
</head>

<body bgcolor="White" text="Black" link="Blue" vlink="Purple" alink="Red" rightmargin="0" bottommargin="0" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">

<table width="100%" height="20" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td bgcolor="#d7e0b1">
		<table cellspacing="2" cellpadding="2" border="0">
			<tr class="bodytext">
			    <td><img src="images/no_pix.gif" width="5" height="1" alt="" border="0"></td>
			    <td><img src="images/ico-sm-jrodwyer.gif" width="35" height="15" alt="" border="0" align="absmiddle"> <b>J.R. O'Dwyer Co.</b></td>
			    <td><img src="images/no_pix.gif" width="5" height="1" alt="" border="0"></td>
			    <td><a href="content.php?sessionid=<?php echo $session->SessionID; ?>" target="main"><img src="images/ico-sm-find.gif" width="13" height="13" alt="" border="0" align="absmiddle"></a> <b><a href="content.php?sessionid=<?php echo $session->SessionID; ?>" target="main">Search</a></b></td>
			    <td><a href="listfirm.php?sessionid=<?php echo $session->SessionID; ?>" target="main"><img src="images/ico-list.gif" height="13" alt="" border="0" align="absmiddle"></a> <b><a href="listfirm.php?sessionid=<?php echo $session->SessionID; ?>" target="main">List</a></b></td>
			    <td><a href="addmainfirm.php?sessionid=<?php echo $session->SessionID; ?>" target="main"><img src="images/ico-list.gif" height="13" alt="" border="0" align="absmiddle"></a> <b><a href="addmainfirm.php?sessionid=<?php echo $session->SessionID; ?>" target="main">Add</a></b></td>
			    <?php if($session->GroupID == '0'){ ?><td><a href="quarkoutput.php?sessionid=<?php echo $session->SessionID; ?>" target="main"><img src="images/ico-list.gif" height="13" alt="" border="0" align="absmiddle"></a> <b><a href="quarkoutput.php?sessionid=<?php echo $session->SessionID; ?>" target="main">Quark Output</a></b></td>
			    <?php } ?>
			    <td></td>
			    <td></td>
			    <td></td>
			</tr>
		</table>	
	</td>
</tr>
</table>


</body>
</html>
<?php
	}
?>