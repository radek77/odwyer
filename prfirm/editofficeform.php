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
				
				
				$query = 'SELECT id, name, officeinfo, office_locations, office_locations_international FROM prfirm WHERE `id` = "' .$_GET['id'].'"';
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
<form method="post" action="updateform.php">
<input type="hidden" name="currentid" value="office">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<input type="hidden" name="sessionid" value="<?php echo $session->SessionID; ?>">
<table cellspacing="2" cellpadding="0" border="0" height="100%" width="700">
	<tr>
	    <td bgcolor="#eaeaea" valign="top">
<table cellspacing="0" cellpadding="3" border="0" width="100%">
<tr class="ssi-text" bgcolor="#ffffcc">
    <td><b>Firm Name: <?php echo $row['name']; ?></b></td>
    <td><input type="submit" value="Save"></td>
</tr>
<tr class="ssi-text">
    <td>Offices:</td>
    <td></td>
</tr>
<tr class="ssi-text">
    <td colspan="2"><textarea name="officeinfo" rows="30" cols="60"><?php echo $row['officeinfo']; ?></textarea></td>
</tr>


<tr class="ssi-text">
    <td colspan="2"><BR><font color=red><b>IMPORTANT NOTE: The following fields are NOT displayed.</b></font><BR>They are used to allow the listing to appear in different locations	in the Geographical listings.<BR>Format MUST be each location on a separate line with city and state/country separated by a comma.<BR>
<b>Format:</b><BR>
city, state<BR>
For Example: Austin, TX<BR><BR>
<b>OR in the case of an International Listing</b><BR>
city, country<BR>
For Example: Mexico D.F., Mexico<BR><BR></td>
</tr>
<tr class="ssi-text">
    <td colspan="2"><b>US LOCATIONS:</b><BR><textarea name="office_locations" rows="10" cols="60"><?php echo $row['office_locations']; ?></textarea><br><br></td>
</tr>

<tr class="ssi-text">
    <td colspan="2"><b>INTERNATIONAL LOCATIONS</b><BR><textarea name="office_locations_international" rows="10" cols="60"><?php echo $row['office_locations_international']; ?></textarea><br><br></td>
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