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
	<script language="javascript">
		function changetab(lefttab,righttab,selectedtab,selectedid)
		{
			//deselect the tab
			var oldltab = document.forms[0].tableft.value
			var oldrtab = document.forms[0].tabright.value
			var oldstab = document.forms[0].selectedtab.value
			
			document.images[oldltab].src = "images/tab_leftnotsel.gif";
			document.images[oldrtab].src = "images/tab_rightnotsel.gif";
			document.getElementById(oldstab).bgColor = "#b5bad7";
			//select the new tab
			
			document.images[lefttab].src = "images/tab_leftsel.gif";
			document.images[righttab].src = "images/tab_rightsel.gif";
			document.getElementById(selectedtab).bgColor = "#ffffff";
			//set the values
			document.forms[0].tableft.value = lefttab;
			document.forms[0].tabright.value = righttab;
			document.forms[0].selectedtab.value = selectedtab;
			document.forms[0].selectedid.value = selectedid;
			return;
		}
		
		function navigatetab(sTabID)
		{
			sText = "Have you saved your changes? Click OK if you have saved or if you are just viewing otherwise click CANCEL.";
			
			if (confirm(sText))
			{
				switch (sTabID)
				{
					case 'maininfo':
						top.main.edit.location.href = "editmainform.php?sessionid=<?php echo $session->SessionID ?>&id=<?php echo $_GET['id'] ?>";
						return true;
						break;
					case 'staff':
						top.main.edit.location.href = "staff.php?sessionid=<?php echo $session->SessionID ?>&id=<?php echo $_GET['id'] ?>";
						return true;
						break;
					case 'clients':
						top.main.edit.location.href = "editclientform.php?sessionid=<?php echo $session->SessionID ?>&id=<?php echo $_GET['id'] ?>";
						return true;
					case 'offices':
						top.main.edit.location.href = "editofficeform.php?sessionid=<?php echo $session->SessionID ?>&id=<?php echo $_GET['id'] ?>";
						return true;
						break;
					case 'category':
						top.main.edit.location.href = "editcategory.php?sessionid=<?php echo $session->SessionID ?>&id=<?php echo $_GET['id'] ?>";
						return true;
						break;
					default:
						return false;
						break;
				}
			}else{
				return;
			}
		}
	</script>
	<style>
		.ssi-tab {
			font-family: arial, verdana;
			color: #000000;
			font-weight: normal;
			font-size: 13px;
		}
		.ssi-tab a {color: #000000;text-decoration : none;}
		.ssi-tab a:link {color: #000000;text-decoration : none;}
		.ssi-tab a:visited {color: #000000;text-decoration : none;}
		.ssi-tab a:hover {color: #ff0000;}
	</style>
</head>

<body bgcolor="Gray" text="Black" link="Blue" vlink="Purple" alink="Red" rightmargin="0" bottommargin="0" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
	<form method="post">
		<input name="tableft" type="hidden" value="imgl1"/>
		<input name="tabright" type="hidden" value="imgr1"/>
		<input name="selectedtab" type="hidden" value="tab1"/>
		<input name="selectedid" type="hidden" value=""/>
		<table cellspacing="0" cellpadding="0" border="0" height="100%">
			<tr>
			    <td valign="bottom">
		<table cellspacing="0" cellpadding="0" border="0">
			<tr class="ssi-tab">
			    <td height="21"><img src="images/no_pix.gif" width="10" height="21" alt="" border="0"></td>
				<td height="21" align="right" nowrap="1"><img name="imgl1" src="images/tab_leftsel.gif" width="5" height="21" alt="" border="0"></td>
				<td id="tab1" height="21" bgcolor="#ffffff" align="center"><a href="javascript:if(navigatetab('maininfo')){changetab('imgl1','imgr1','tab1','maininfo');}"><b>Main Info</b></a></td>
				<td height="21" align="left"><img name="imgr1" src="images/tab_rightsel.gif" width="5" height="21" alt="" border="0"></td>
				
<!-- 				<td height="21" align="right" nowrap="1"><img name="imgl2" src="images/tab_leftnotsel.gif" width="5" height="21" alt="" border="0"></td>			
				<td id="tab2" height="21" bgcolor="#b5bad7" align="center"><a href="javascript:if(navigatetab('staff')){changetab('imgl2','imgr2','tab2','staff');}"><b>Staff</b></a></td>
				<td height="21" align="left"><img name="imgr2" src="images/tab_rightnotsel.gif" width="5" height="21" alt="" border="0"></td> -->
				<!--
				<td height="21" align="right" nowrap="1"><img name="imgl3" src="images/tab_leftnotsel.gif" width="5" height="21" alt="" border="0"></td>			
				<td id="tab3" height="21" bgcolor="#b5bad7" align="center"><a href="javascript:if(navigatetab('clients')){changetab('imgl3','imgr3','tab3','clients');}"><b>Clients</b></a></td>
				<td height="21" align="left"><img name="imgr3" src="images/tab_rightnotsel.gif" width="5" height="21" alt="" border="0"></td>
				
				<td height="21" align="right" nowrap="1"><img name="imgl4" src="images/tab_leftnotsel.gif" width="5" height="21" alt="" border="0"></td>			
				<td id="tab4" height="21" bgcolor="#b5bad7" align="center"><a href="javascript:if(navigatetab('offices')){changetab('imgl4','imgr4','tab4','offices');}"><b>Offices</b></a></td>
				<td height="21" align="left"><img name="imgr4" src="images/tab_rightnotsel.gif" width="5" height="21" alt="" border="0"></td>
				
				<td height="21" align="right" nowrap="1"><img name="imgl5" src="images/tab_leftnotsel.gif" width="5" height="21" alt="" border="0"></td>			
				<td id="tab5" height="21" bgcolor="#b5bad7" align="center"><a href="javascript:if(navigatetab('category')){changetab('imgl5','imgr5','tab5','category');}"><b>Category</b></a></td>
				<td height="21" align="left"><img name="imgr5" src="images/tab_rightnotsel.gif" width="5" height="21" alt="" border="0"></td>
				-->
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