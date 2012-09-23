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
				if(!mysql_connect("localhost","root","oldhouse"))
				{
					echo "<h2>Can't Connect to Database.</h2>";
					die();
				}
				mysql_select_db("odwyer");
				
				
				$query = 'SELECT * FROM corpstaff WHERE `id` = "' .$_GET['id'].'"';
				$i=0;
				$result = mysql_query($query);
				while( $row=mysql_fetch_array($result) )
				{
					if($i < 1){
?>
<html>
<head>
	<title>J.R. O'Dwyer Co.</title>
	<style>
		.ssi-text {
			font-family: arial, verdana;
			color: #000000;
			font-weight: normal;
			font-size: 13px;
		}
		.ssi-text a {color: #000000;text-decoration : none;}
		.ssi-text a:link {color: #000000;text-decoration : none;}
		.ssi-text a:visited {color: #000000;text-decoration : none;}
		.ssi-text a:hover {color: #ff0000;}
	</style>
</head>

<body bgcolor="White" text="Black" link="Blue" vlink="Purple" alink="Red" rightmargin="0" bottommargin="0" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<form method="post" action="updatestaffform.php">
<input type="hidden" name="sessionid" value="<?php echo $session->SessionID; ?>">
<input name="cid" type="hidden" value="<?php echo $row['cid'] ?>"/>
<input name="id" type="hidden" value="<?php echo $row['id'] ?>"/>
<table cellspacing="2" cellpadding="0" border="0" height="100%" width="700">
	<tr>
	    <td bgcolor="#eaeaea" valign="top">
<table cellspacing="0" cellpadding="3" border="0" width="100%">
<tr class="ssi-text" bgcolor="#ffffcc">
    <td align="right"><b>Name:</b></td>
    <td><input value="<?php echo $row['name']; ?>" type="text" name="name" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Title:</td>
    <td><input value="<?php echo $row['title']; ?>" type="text" name="title" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Address 1:</td>
    <td><input value="<?php echo $row['address1']; ?>" type="text" name="address1" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Address 2:</td>
    <td><input value=""<?php echo $row['address2']; ?>" type="text" name="address2" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">City:</td>
    <td><input value="<?php echo $row['city']; ?>" type="text" name="city" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">State:</td>
    <td><input value="<?php echo $row['state']; ?>" type="text" name="state" size="2"> Zip:<input value=""<?php echo $row['zip']; ?>" type="text" name="zip" size="10"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Country:</td>
    <td><input value="<?php echo $row['country']; ?>" type="text" name="country" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Phone:</td>
    <td><input value="<?php echo $row['phone']; ?>" type="text" name="phone" size="15"> Fax: <input value="<?php echo $row['fax']; ?>" type="text" name="fax" size="15"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Email:</td>
    <td><input value="<?php echo $row['email']; ?>" type="text" name="email" size="60"></td>
</tr>
<tr class="ssi-text">
    <td colspan="2" align="center"><input type="submit" value="Save"></td>
</tr>
</table>
</td>
</tr>
</table>
</form>


</body>
</html>

<?php
					}
					$i++;
				}
	}
?>