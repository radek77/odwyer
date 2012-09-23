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
				
				
				$query = 'SELECT * FROM corp WHERE `id` = "' .$_GET['id'].'"';
				
				$i=0;
				$result = mysql_query($query);
				while( $row=mysql_fetch_array($result) )
				{
					if($i < 1){
					
						$cat_query = "SELECT * FROM category_corp WHERE id='".$row['category']."' LIMIT 1 ";
						$cat_result = mysql_query($cat_query);
						$category_name = "";
						while ($cat_row=mysql_fetch_array($cat_result) ) {
							
							$category_name = trim($cat_row['name']);
						}
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
<table cellspacing="2" cellpadding="0" border="0" height="100%" width="700">
	<tr>
	    <td bgcolor="#eaeaea" valign="top">
<table cellspacing="0" cellpadding="3" border="0" width="100%">



<tr class="ssi-text" bgcolor="#ffffcc">
    <td align="right"><b>Company Name:</b></td>
    <td><?php echo $row['company']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Category:</td>
    <td><?php echo $category_name; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Under Title:</td>
    <td><?php echo $row['undertitle']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Validated:</td>
    <td><?php if($row['validated']=='1'){echo 'YES';} else {echo 'NO';}; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Address 1:</td>
    <td><?php echo $row['address1']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Address 2:</td>
    <td><?php echo $row['address2']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">City:</td>
    <td><?php echo $row['city']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">State:</td>
    <td><?php echo $row['state']; ?>&nbsp;&nbsp;&nbsp; Zip: <?php echo $row['zip']; ?>&nbsp;&nbsp; +4:<?php echo $row['zip4']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Country:</td>
    <td><?php echo $row['country']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Main Phone:</td>
    <td><?php echo $row['phone']; ?>&nbsp;&nbsp; Main Fax: <?php echo $row['fax']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Website:</td>
    <td><?php echo $row['url']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Main E-mail:</td>
    <td><?php echo $row['email']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">PR Contact:</td>
    <td><?php echo $row['prcontact']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">PR Contact Title:</td>
    <td><?php echo $row['prtitle']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">PR Contact Phone:</td>
    <td><?php echo $row['prcontactphone']; ?>&nbsp;&nbsp;&nbsp;&nbsp; PR Contact Fax: <?php echo $row['prcontactfax']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">PR Contact Email:</td>
    <td><?php echo $row['prcontactemail']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Misc. Info 1:</td>
    <td><?php echo $row['miscinfo1']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Misc. Info 2:</td>
    <td><?php echo $row['miscinfo2']; ?></td>
</tr>
<tr class="ssi-text">
    <td align="right">Last Updated By:</td>
    <td><?php if($row['username']!=''){echo $row['username'];}else{echo "System";}; ?> on <?php echo $row['lastupdated']; ?></td>
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