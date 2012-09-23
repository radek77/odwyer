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

			# create category dropdown
			$category_dropdown = "<select name='category'><option value=''>-- Select Category --</option>";
			$cat_query = 'SELECT * FROM category_corp ORDER BY name';

			$cat_result = mysql_query($cat_query);
			while ($cat_row=mysql_fetch_array($cat_result) ) {
					$category_dropdown .= "<option value='".$cat_row['id']."'>".$cat_row['name']."</option>";
			}
			$category_dropdown .= "</select>";
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
<form method="post" action="insertform.php">
<input type="hidden" name="validated" value="0">
<input type="hidden" name="sessionid" value="<?php echo $session->SessionID; ?>">
<table cellspacing="2" cellpadding="0" border="0" height="100%" width="700">
	<tr>
	    <td bgcolor="#eaeaea" valign="top">
<table cellspacing="0" cellpadding="3" border="0" width="100%">
<tr class="ssi-text" bgcolor="#ffffcc">
    <td align="right"><b>Company:</b></td>
    <td><input value="" type="text" name="company" size="60"> <input type="submit" value="Save"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Category:</td>
    <td><?php echo $category_dropdown; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Under Title:</td>
    <td><input value="" type="text" name="undertitle" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Validated:</td>
    <td><input type="checkbox" name="validated"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Address 1:</td>
    <td><input value="" type="text" name="address1" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Address 2:</td>
    <td><input value="" type="text" name="address2" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">City:</td>
    <td><input value="" type="text" name="city" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">State:</td>
    <td><input value="" type="text" name="state" size="2"> Zip:<input value="" type="text" name="zip" size="10"> +4:<input value="" type="text" name="zip4" size="4"> </td>
</tr>
<tr class="ssi-text">
    <td align="right">Country:</td>
    <td><input value="" type="text" name="country" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Main Phone:</td>
    <td><input value="" type="text" name="phone" size="15"> Main Fax: <input value="" type="text" name="fax" size="15"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Website:</td>
    <td><input value="" type="text" name="url" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Main E-mail:</td>
    <td><input value="" type="text" name="email" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">PR Contact:</td>
    <td><input value="" type="text" name="prcontact" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">PR Contact Title:</td>
    <td><input value="" type="text" name="prtitle" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">PR Contact Phone:</td>
    <td><input value="" type="text" name="prcontactphone" size="15"> PR Contact Fax: <input value="" type="text" name="prcontactfax" size="15"></td>
</tr>
<tr class="ssi-text">
    <td align="right">PR Contact Email:</td>
    <td><input value="" type="text" name="prcontactemail" size="60"></td>
</tr>
<tr class="ssi-text">
    <td align="right">Misc. Info 1:</td>
    <td><textarea name="miscinfo1" rows="5" cols="60"></textarea></td>
</tr>
<tr class="ssi-text">
    <td align="right">Misc. Info 2:</td>
    <td><textarea name="miscinfo2" rows="5" cols="60"></textarea></td>
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
?>