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
				case 'alpha':
					document.forms[0].fieldvalue.value = letter;
					document.forms[0].action = "quarkalpha.php";
					document.forms[0].submit();
					break;
				case 'num':
					document.forms[0].fieldvalue.value = letter;
					document.forms[0].action = "quarknum.php";
					document.forms[0].submit();
					break;
				case 'intl':
					document.forms[0].fieldvalue.value = letter;
					document.forms[0].action = "quarkintl.php";
					document.forms[0].submit();
					break;
				case 'org':
					document.forms[0].fieldvalue.value = letter;
					document.forms[0].action = "quarkorg.php";
					document.forms[0].submit();		
					break;			
				case 'geo':
					document.forms[0].fieldvalue.value = letter;
					document.forms[0].action = "quarkgeo.php";
					document.forms[0].submit();
					break;
				case 'cat':
					document.forms[0].fieldvalue.value = letter;
					document.forms[0].action = "quarkcat.php";
					document.forms[0].submit();
					break;
				case 'client':
					document.forms[0].fieldvalue.value = letter;
					document.forms[0].action = "quarkclient.php";
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
			<u><b>US by Alpha</b></u><br>
			<a href="javascript:gotoletter('0','num')">0-9</a><br>
			<table width="100%" cellspacing="2" cellpadding="2" border="0">
			<tr>
			    <td class="bodytext">
					<a href="javascript:gotoletter('A','alpha')">A</a><br>
					<a href="javascript:gotoletter('B','alpha')">B</a><br>
					<a href="javascript:gotoletter('C','alpha')">C</a><br>
					<a href="javascript:gotoletter('D','alpha')">D</a><br>
					<a href="javascript:gotoletter('E','alpha')">E</a><br>
					<a href="javascript:gotoletter('F','alpha')">F</a><br>
					<a href="javascript:gotoletter('G','alpha')">G</a><br>
					<a href="javascript:gotoletter('H','alpha')">H</a><br>
					<a href="javascript:gotoletter('I','alpha')">I</a><br>
					<a href="javascript:gotoletter('J','alpha')">J</a><br>
					<a href="javascript:gotoletter('K','alpha')">K</a><br>
					<a href="javascript:gotoletter('L','alpha')">L</a><br>
					<a href="javascript:gotoletter('M','alpha')">M</a><br>
				</td>
			    <td class="bodytext">
					<a href="javascript:gotoletter('N','alpha')">N</a><br>
					<a href="javascript:gotoletter('O','alpha')">O</a><br>
					<a href="javascript:gotoletter('P','alpha')">P</a><br>
					<a href="javascript:gotoletter('Q','alpha')">Q</a><br>
					<a href="javascript:gotoletter('R','alpha')">R</a><br>
					<a href="javascript:gotoletter('S','alpha')">S</a><br>
					<a href="javascript:gotoletter('T','alpha')">T</a><br>
					<a href="javascript:gotoletter('U','alpha')">U</a><br>
					<a href="javascript:gotoletter('V','alpha')">V</a><br>
					<a href="javascript:gotoletter('W','alpha')">W</a><br>
					<a href="javascript:gotoletter('X','alpha')">X</a><br>
					<a href="javascript:gotoletter('Y','alpha')">Y</a><br>
					<a href="javascript:gotoletter('Z','alpha')">Z</a><br>
				</td>
			</tr>
			</table>
			<br>
			<a href="javascript:gotoletter('0','intl')">International</a><br>
			<br>
			<a href="javascript:gotoletter('0','cat')">Categories</a><br>
			<br>		
			<a href="javascript:gotoletter('0','geo')">Geographical</a><br>
			<br>
			<a href="javascript:gotoletter('0','org')">Organization</a><br>
			<br>
			<u><b>Cross Client Index</b></u><br>
			<a href="javascript:gotoletter('09','client')">0-9</a><br>
			<a href="javascript:gotoletter('AB','client')">A-B</a><br>
			<a href="javascript:gotoletter('CD','client')">C-D</a><br>
			<a href="javascript:gotoletter('EH','client')">E-H</a><br>
			<a href="javascript:gotoletter('IL','client')">I-L</a><br>
			<a href="javascript:gotoletter('MP','client')">M-P</a><br>
			<a href="javascript:gotoletter('QT','client')">Q-T</a><br>
			<a href="javascript:gotoletter('UZ','client')">U-Z</a><br>
		</form>
	</td>
</tr>
</table>
</body>
</html>
<?php
	}
?>