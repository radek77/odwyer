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
				
				
				$query = 'SELECT * FROM prfirm WHERE `id` = "' .$_GET['id'].'"';
				
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
		.ssi-text a {color: #0000ff;text-decoration : none;}
		.ssi-text a:link {color: #0000ff;text-decoration : none;}
		.ssi-text a:visited {color: #0000ff;text-decoration : none;}
		.ssi-text a:hover {color: #ff0000;}
	</style>
</head>

<body bgcolor="White" text="Black" link="Blue" vlink="Purple" alink="Red" rightmargin="0" bottommargin="0" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<form method="post" action="updateform.php">
<input type="hidden" name="currentid" value="main">
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<input type="hidden" name="sessionid" value="<?php echo $session->SessionID; ?>">
<table cellspacing="2" cellpadding="0" border="0" height="100%" width="600">
	<tr>
	    <td valign="top" width="600">
			<table cellspacing="2" cellpadding="3" border="0" width="100%">
			<tr class="ssi-text" bgcolor="#ffffcc">
			    <td align="right" nowrap="1" valign="top"><b>Firm Name:</b></td>
			    <td valign="top"><b><?php echo '<a href="editfirm.php?sessionid='.$session->SessionID.'&id='.$row['id'].'" target="main">'.$row['name'].'</a>'; ?></b></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Under Title:</b></td>
			    <td><?php echo $row['undertitle']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Validated:</b></td>
			    <td valign="top"><?php if($row['validated']=='1'){echo '<img src="images/icon_check.gif" alt="" hspace="5" border="0" align="absmiddle">';}else{echo 'No. ';}; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Address 1:</b></td>
			    <td valign="top"><?php echo $row['address1']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Address 2:</b></td>
			    <td valign="top"><?php echo $row['address2']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Address 3:</b></td>
			    <td valign="top"><?php echo $row['address3']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Address 4:</b></td>
			    <td valign="top"><?php echo $row['address4']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>City:</b></td>
			    <td valign="top"><?php echo $row['city']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>State:</b></td>
			    <td valign="top"><?php echo $row['state']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Zip:</b></td>
			    <td valign="top"><?php echo $row['zip']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>+4:</b></td>
			    <td valign="top"><?php echo $row['zip4']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Province:</b></td>
			    <td valign="top"><?php echo $row['province']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Country:</b></td>
			    <td valign="top"><?php echo $row['country']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Main Contact:</b></td>
			    <td valign="top"><?php echo $row['contact']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Contact Title:</b></td>
			    <td valign="top"><?php echo $row['title']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Phone:</b></td>
			    <td valign="top"><?php echo $row['phone']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Fax:</b></td>
			    <td valign="top"><?php echo $row['fax']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Email:</b></td>
			    <td valign="top"><?php echo $row['email']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Website:</b></td>
			    <td valign="top"><?php echo $row['url']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Employees:</b></td>
			    <td valign="top"><?php echo $row['employees']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Founded:</b></td>
			    <td valign="top"><?php echo $row['founded']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Logo:</b></td>
			    <td valign="top"><?php if($row['logo']=='1'){echo '<img src="images/icon_check.gif" alt="" hspace="5" border="0" align="absmiddle">';}else{echo 'No. ';}; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Logo URL:</b></td>
			    <td valign="top"><?php echo $row['logourl']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Ranked:</b></td>
			    <td valign="top"><?php if($row['ranked']=='1'){echo '<img src="images/icon_check.gif" alt="" hspace="5" border="0" align="absmiddle">';}else{echo 'No. ';}; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Net Fees:</b></td>
			    <td valign="top"><?php echo $row['netfees']; ?></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Misc. Info:</b></td>
			    <td valign="top" width="450"><div style="width:450px; word-wrap: break-word; vertical-align : top;"><pre class="ssi-text"><?php echo $row['miscinfo']; ?></pre></div></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Main Staff:</b></td>
			    <td valign="top" width="450"><div style="width:450px; word-wrap: break-word; vertical-align : top;"><pre class="ssi-text"><?php echo $row['staffinfo']; ?></pre></div></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Agency Statement:</b><br>Word Count: <?php echo count(explode(" ",$row['agencystatement'])); ?></td>
			    <td valign="top" width="450"><div style="width:450px; word-wrap: break-word; vertical-align : top;"><pre class="ssi-text"><?php echo $row['agencystatement']; ?></pre></div></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Other Offices:</b></td>
			    <td valign="top" width="450"><div style="width:450px; word-wrap: break-word; vertical-align : top;"><pre class="ssi-text"><?php echo $row['officeinfo']; ?></pre></div></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Clients:</b></td>
			    <td valign="top" width="450"><div style="width:450px; word-wrap: break-word; vertical-align : top;"><pre class="ssi-text"><?php echo $row['clientinfo']; ?></pre></div></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Categories:</b></td>
			    <td valign="top" width="450"><div style="width:450px; word-wrap: break-word; vertical-align : top;"><pre class="ssi-text"><?php 

$category_array = split("\|", $row['category']);
$category_list = "";
for($cat=0;$cat<count($category_array);$cat++) {
	$cat_query = "SELECT name FROM category WHERE id = '$category_array[$cat]' ";
	$cat_result = mysql_query($cat_query);
	$cat_row=mysql_fetch_array($cat_result);
	$category_list .= $cat_row['name']."\r\n";
}	
	
echo $category_list; ?></pre></div></td>
			</tr>
			<tr class="ssi-text">
			    <td align="right" nowrap="1" valign="top" bgcolor="#eaeaea"><b>Last Updated By:</b></td>
			    <td valign="top"><?php if($row['username']!=''){echo $row['username'];}else{echo "System";}; ?> on <?php echo $row['lastupdated']; ?></td>
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