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
			<u><b>Cross Client Index</b></u>
			<BR><BR>
			<a href="/prfirm/tools/prfirm_client_extract.php" target="_blank">Regenerate Clients to PR Firm Table</a><br>
			(click link whenever changes are made to the PR Firms table)
			<BR><BR>
			<table width="100%" cellspacing="2" cellpadding="2" border="0">
			<tr>
		    <td class="bodytext" valign=top>
			<a href="javascript:gotoletter('0','client')">0</a><br>
			<a href="javascript:gotoletter('1','client')">1</a><br>
			<a href="javascript:gotoletter('2','client')">2</a><br>
			<a href="javascript:gotoletter('3','client')">3</a><br>
			<a href="javascript:gotoletter('4','client')">4</a><br>
			<a href="javascript:gotoletter('5','client')">5</a><br>
			<a href="javascript:gotoletter('6','client')">6</a><br>
			<a href="javascript:gotoletter('7','client')">7</a><br>
			<a href="javascript:gotoletter('8','client')">8</a><br>
			<a href="javascript:gotoletter('9','client')">9</a><br>			
			<a href="javascript:gotoletter('A','client')">A</a><br>
			<a href="javascript:gotoletter('B','client')">B</a><br>
			<a href="javascript:gotoletter('C','client')">C</a><br>
			<a href="javascript:gotoletter('D','client')">D</a><br>
			<a href="javascript:gotoletter('E','client')">E</a><br>
			<a href="javascript:gotoletter('F','client')">F</a><br>
			<a href="javascript:gotoletter('G','client')">G</a><br>
			<a href="javascript:gotoletter('H','client')">H</a><br>
			<a href="javascript:gotoletter('I','client')">I</a><br>
			<a href="javascript:gotoletter('J','client')">J</a><br>
			</td><td class="bodytext" valign=top>
			<a href="javascript:gotoletter('K','client')">K</a><br>
			<a href="javascript:gotoletter('L','client')">L</a><br>
			<a href="javascript:gotoletter('M','client')">M</a><br>
			<a href="javascript:gotoletter('N','client')">N</a><br>
			<a href="javascript:gotoletter('O','client')">O</a><br>
			<a href="javascript:gotoletter('P','client')">P</a><br>
			<a href="javascript:gotoletter('Q','client')">Q</a><br>
			<a href="javascript:gotoletter('R','client')">R</a><br>
			<a href="javascript:gotoletter('S','client')">S</a><br>
			<a href="javascript:gotoletter('T','client')">T</a><br>
			<a href="javascript:gotoletter('U','client')">U</a><br>
			<a href="javascript:gotoletter('V','client')">V</a><br>
			<a href="javascript:gotoletter('W','client')">W</a><br>
			<a href="javascript:gotoletter('X','client')">X</a><br>
			<a href="javascript:gotoletter('Y','client')">Y</a><br>
			<a href="javascript:gotoletter('Z','client')">Z</a><br>			
		</form>
			</td></tr></table>
	</td>
</tr>
</table>
</body>
</html>
<?php
	}
?>