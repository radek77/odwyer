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
				
				
				$query = 'SELECT id, name, category FROM prfirm WHERE `id` = "' .$_GET['id'].'"';
				$i=0;
				$result = mysql_query($query);
				while( $row=mysql_fetch_array($result) )
				{
					if($i < 1){
						$category_list = $row['category'];
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
<input type="hidden" name="currentid" value="category">
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
    <td colspan=2>&nbsp;</td>
</tr>
<tr class="ssi-text">
        <td valign=top align=right><b>Category Code:</b></td><td  align=left valign=top>
	<select name="category_code[]" size=17 multiple>
			    			
			<?php 
		
			$query = 'SELECT * FROM category ORDER BY name';
											
			$result=mysql_query($query);
			
			$i=0;
			$class = 'ssi-grid-lightrow';
			while( $row=mysql_fetch_array($result) )
			{
			
				$category_selected = "";
 				$pattern = $row['id'];
				if (preg_match("/$pattern/i", $category_list)) { 
					$category_selected = "selected";
				}
				
				echo '<option value="' . $row['id'] . '" '.$category_selected.'>' . $row['name'] . '</option>';
					
					
			}
			
			?>
			    </select>
	</td>
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