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
		.bodytext a{color: #0000ff;font-weight: bold;
			}
		.bodytext a:link{color: #0000ff;font-weight: bold;
			}
		.bodytext a:visited{color: #0000ff;font-weight: bold;
			}
		.bodytext a:hover{color: #ff0000;font-weight: bold;
			}
	</style>
	
	<script>			
		function gotoletter(letter) 
		{
			document.forms[0].coutry.value = letter;
			document.forms[0].submit();
			return;
		}
	</script>
</head>

<body bgcolor="#f8f8ef" text="Black" link="Blue" vlink="Purple" alink="Red" rightmargin="0" bottommargin="0" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">

<table cellspacing="0" cellpadding="0" border="0">
<tr>
    <td class="bodytext">
		<form method="post" action="intlist.php" target="list">
			<input name="sessionid" type="hidden" value="<?php echo $session->SessionID; ?>"/>
			<input name="matchtype" type="hidden" value="2"/>
			<input name="fieldname" type="hidden" value="alpha"/>
			<input name="fieldvalue" type="hidden" value=""/>
			<table cellspacing="2" cellpadding="2" border="0">
				<tr class="bodytext">
				    <td><a href="alphalist.php?sessionid=<?php echo $session->SessionID; ?>" target="_self">Alphabetically</a> | <a href="alphaintlist.php?sessionid=<?php echo $session->SessionID; ?>" target="_self">International</a></td>
				</tr>
				<tr class="bodytext">
				    <td>
				    <select name="country">
				    			
				<?php 
				if(!mysql_connect("localhost","root","oldhouse"))
				{
					echo "<h2>Can't Connect to Database.</h2>";
					die();
				}
				mysql_select_db("odwyer");
				
				$query = 'SELECT DISTINCT country FROM prfirm WHERE country <> "" ORDER BY country';
												
				$result=mysql_query($query);
				
				$i=0;
				$class = 'ssi-grid-lightrow';
				while( $row=mysql_fetch_array($result) )
				{
					echo '<option value="' . $row['country'] . '">' . $row['country'] . '</option>';
				}
				
				?>
				    </select>
				    <input type="submit" value="Search">
				    </td>
				</tr>
			</table>
		</form>
	</td>
</tr>
</table>

</body>
</html>
<?php
	}
?>