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

<body bgcolor="#f8f8ef" text="Black" link="Blue" vlink="Purple" alink="Red" rightmargin="0" bottommargin="0" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">

<table cellspacing="4" cellpadding="4" border="0">
<tr>
    <td class="bodytext">
		<form method="post" action="list.php" target="viewedit">
			<input name="sessionid" type="hidden" value="<?php echo $session->SessionID; ?>"/>
			<b>Keyword:</b> 
			<select name="matchtype">
				<option value="2">Starts With</option>
				<option value="1">Contains</option>
				<option value="3">End With</option>				
			</select>
			<input name="fieldvalue" type="text"> 
			<b>By:</b> 
			<select name="fieldname">
				<option value="company">Company Name</option>
				<option value="city">City</option>
				<option value="state">State</option>			
				<option value="phone">Phone</option>
			</select>
			<input type="submit" value="Search">
		</form>
	</td>
</tr>
</table>

</body>
</html>
<?php
	}
?>
