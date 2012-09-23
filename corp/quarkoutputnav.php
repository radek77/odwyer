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
		function gotoletter(letter, type) 
		{
			switch (type) {
				case 'corp':
					document.forms[0].fieldvalue.value = letter;
					document.forms[0].action = "quarkcorp.php";
					document.forms[0].submit();
					break;
				case 'assc':
					document.forms[0].fieldvalue.value = letter;
					document.forms[0].action = "quarkassc.php";
					document.forms[0].submit();
					break;
				default:
					return;
					break;
			}
		}
	</script>
</head>

<body bgcolor="#f8f8ef" text="Black" link="Blue" vlink="Purple" alink="Red" rightmargin="0" bottommargin="0" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">

<table cellspacing="10" cellpadding="0" border="0">
<tr>
    <td class="bodytext">
		<form method="post" target="view">
			<input name="sessionid" type="hidden" value="<?php echo $session->SessionID; ?>"/>
			<input name="fieldvalue" type="hidden" value=""/>
			<input name="start" type="hidden" value=""/>
			<u><b>Corporation</b></u><br>
			<a href="javascript:gotoletter('0','corpnum')">0-9</a><br>
			<table width="100%" cellspacing="2" cellpadding="2" border="0">
			<tr>
			    <td class="bodytext">
					<a href="javascript:gotoletter('A','corp')">A</a><br>
					<a href="javascript:gotoletter('B','corp')">B</a><br>
					<a href="javascript:gotoletter('C','corp')">C</a><br>
					<a href="javascript:gotoletter('D','corp')">D</a><br>
					<a href="javascript:gotoletter('E','corp')">E</a><br>
					<a href="javascript:gotoletter('F','corp')">F</a><br>
					<a href="javascript:gotoletter('G','corp')">G</a><br>
					<a href="javascript:gotoletter('H','corp')">H</a><br>
					<a href="javascript:gotoletter('I','corp')">I</a><br>
					<a href="javascript:gotoletter('J','corp')">J</a><br>
					<a href="javascript:gotoletter('K','corp')">K</a><br>
					<a href="javascript:gotoletter('L','corp')">L</a><br>
					<a href="javascript:gotoletter('M','corp')">M</a><br>
				</td>
			    <td class="bodytext">
					<a href="javascript:gotoletter('N','corp')">N</a><br>
					<a href="javascript:gotoletter('O','corp')">O</a><br>
					<a href="javascript:gotoletter('P','corp')">P</a><br>
					<a href="javascript:gotoletter('Q','corp')">Q</a><br>
					<a href="javascript:gotoletter('R','corp')">R</a><br>
					<a href="javascript:gotoletter('S','corp')">S</a><br>
					<a href="javascript:gotoletter('T','corp')">T</a><br>
					<a href="javascript:gotoletter('U','corp')">U</a><br>
					<a href="javascript:gotoletter('V','corp')">V</a><br>
					<a href="javascript:gotoletter('W','corp')">W</a><br>
					<a href="javascript:gotoletter('X','corp')">X</a><br>
					<a href="javascript:gotoletter('Y','corp')">Y</a><br>
					<a href="javascript:gotoletter('Z','corp')">Z</a><br>
				</td>
			</tr>
			</table>
			<u><b>Association</b></u><br>
			<a href="javascript:gotoletter('0','asscnum')">0-9</a><br>
			<table width="100%" cellspacing="2" cellpadding="2" border="0">
			<tr>
			    <td class="bodytext">
					<a href="javascript:gotoletter('A','assc')">A</a><br>
					<a href="javascript:gotoletter('B','assc')">B</a><br>
					<a href="javascript:gotoletter('C','assc')">C</a><br>
					<a href="javascript:gotoletter('D','assc')">D</a><br>
					<a href="javascript:gotoletter('E','assc')">E</a><br>
					<a href="javascript:gotoletter('F','assc')">F</a><br>
					<a href="javascript:gotoletter('G','assc')">G</a><br>
					<a href="javascript:gotoletter('H','assc')">H</a><br>
					<a href="javascript:gotoletter('I','assc')">I</a><br>
					<a href="javascript:gotoletter('J','assc')">J</a><br>
					<a href="javascript:gotoletter('K','assc')">K</a><br>
					<a href="javascript:gotoletter('L','assc')">L</a><br>
					<a href="javascript:gotoletter('M','assc')">M</a><br>
				</td>
			    <td class="bodytext">
					<a href="javascript:gotoletter('N','assc')">N</a><br>
					<a href="javascript:gotoletter('O','assc')">O</a><br>
					<a href="javascript:gotoletter('P','assc')">P</a><br>
					<a href="javascript:gotoletter('Q','assc')">Q</a><br>
					<a href="javascript:gotoletter('R','assc')">R</a><br>
					<a href="javascript:gotoletter('S','assc')">S</a><br>
					<a href="javascript:gotoletter('T','assc')">T</a><br>
					<a href="javascript:gotoletter('U','assc')">U</a><br>
					<a href="javascript:gotoletter('V','assc')">V</a><br>
					<a href="javascript:gotoletter('W','assc')">W</a><br>
					<a href="javascript:gotoletter('X','assc')">X</a><br>
					<a href="javascript:gotoletter('Y','assc')">Y</a><br>
					<a href="javascript:gotoletter('Z','assc')">Z</a><br>
				</td>
			</tr>
			</table>
			<br>
			<a href="quarkstaff.php" target="view">Staff Index</a><br>
		</form>
	</td>
</tr>
</table>
</body>
</html>
<?php
	}
?>