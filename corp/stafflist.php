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
			<meta http-equiv="cache-control" content="no-cache">
			<title>J.R. O'Dwyer Co.</title>
			<style>
			.ssi-text {
				font-family: arial;
				color: #000000;
				font-weight: normal;
				font-size: 12px;
			}
			.ssi-text a {color: #0066cc;}
			.ssi-text a:link {color: #0066cc;}
			.ssi-text a:visited {color: #0066cc;}
			.ssi-text a:hover {color: #ff0000;}
			
			.ssi-navheader {
				border-width: 1; 
				border-style: solid; 
				border-color: #000000; 
				background-color: #006666;
				font-family: verdana;
				color: #ffffff;
				font-weight: bold;
				font-size: 14px;
			}
			
			.ssi-grid {
				font-family: arial;
				color: #000000;
				font-weight: normal;
				font-size: 12px;
				background-color: #dddddd;
			}
			.ssi-grid a {color: #000000;text-decoration : none;}
			.ssi-grid a:link {color: #000000;text-decoration : none;}
			.ssi-grid a:visited {color: #000000;text-decoration : none;}
			.ssi-grid a:hover {color: #ff0000;}
			
			.ssi-grid-darkrow {
				font-family: arial;
				color: #000000;
				font-weight: normal;
				font-size: 12px;
				background-color: #eeeeee;
			}
			.ssi-grid-darkrow a {color: #0000FF;}
			.ssi-grid-darkrow a:link {color: #0000FF;}
			.ssi-grid-darkrow a:visited {color: #0000FF;}
			.ssi-grid-darkrow a:hover {color: #ff0000;}
			
			.ssi-grid-lightrow {
				font-family: arial;
				color: #000000;
				font-weight: normal;
				font-size: 12px;
				background-color: #ffffff;
			}
			.ssi-grid-lightrow a {color: #0000FF;}
			.ssi-grid-lightrow a:link {color: #0000FF;}
			.ssi-grid-lightrow a:visited {color: #0000FF;}
			.ssi-grid-lightrow a:hover {color: #ff0000;}
			
			.ssi-solheader {
				border-width: 1; 
				border-style: solid; 
				border-color: #000000; 
				background-color: #d2f0d7;
				font-family: verdana;
				color: #006633;
				font-weight: bold;
				font-size: 12px;
			}
			.ssi-solheader a {color: #0000FF;}
			.ssi-solheader a:link {color: #0000FF;}
			.ssi-solheader a:visited {color: #0000FF;}
			.ssi-solheader a:hover {color: #FF0000;}
			
			
			.ssi-soltable {
				border-width: 1; 
				border-style: solid; 
				border-color: #000000; 
				background-color: #ffffff;
			}
			
			.ssi-navtable {
				border-width: 1; 
				border-style: solid; 
				border-color: #000000; 
			}
			
			.ssi-navtabletop {
				border-width: 1; 
				border-style: solid; 
				border-color: #000000; 
				background-color: #FFE3E3;
			}
			
			.ssi-navtablebot {
				border-width: 1; 
				border-style: solid; 
				border-color: #000000; 
				background-color: #99cccc;
			}
			
			.ssi-navtablediv {
				border-width: 1; 
				border-style: solid; 
				border-color: #000000; 
				background-color: #000000;
			}
			
			.ssi-navbottom {
				border-width: 1; 
				border-style: solid; 
				border-color: #000000; 
				background-color: #99ccff;
			}
			</style>
			<script>
				function trColorOn(elementId) {
					if (document.getElementById) {
						document.getElementById(elementId).style.backgroundColor="#ffcccc"
					}
				}
				
				function trColorOff(elementId) {
					if (document.getElementById) {
						document.getElementById(elementId).style.backgroundColor=""
					}
				}
					
				function deleterecord(recname, recid) 
				{
					sText = "Are you sure you want to delete " + recname + "?";
					
					if (confirm(sText))
					{
						document.forms[0].action = "deletestaff.php";
						document.forms[0].pid.value = recid;
						document.forms[0].submit();
					}else{
						return;
					}
			}
			</script>
		</head>		
		<body bgcolor="White" text="Black" link="Blue" vlink="Purple" alink="Red" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">

		<form method="post">
		<input name="sessionid" type="hidden" value="<?php echo $session->SessionID; ?>"/>
		<input name="cid" type="hidden" value="<?php echo $_GET['id'] ?>"/>
		<input name="pid" type="hidden" value=""/>

		
		
		<table width="100%" height="100%" cellspacing="0" cellpadding="1" border="0">
		<tr>
			<td valign="top">
			
			<?php 
				//$matchtype =  $_POST['matchtype'];
				//$fieldname = $_POST['fieldname'];
				//$fieldvalue = str_replace('"', '\"', $_POST['fieldvalue']);
				/*
				if($_POST['sortorder'] == '')
				{
					$sortorder = '0';
				}else{
					$sortorder = $_POST['sortorder'];
				}
				*/
				if(!mysql_connect("localhost","root","oldhouse"))
				{
					echo "<h2>Can't Connect to Database.</h2>";
					die();
				}
				mysql_select_db("odwyer");
				
				$query = 'SELECT * FROM corpstaff WHERE deleted = 0 and  cid = "' . $_GET['id'] . '" ORDER BY name';
				
								
				$result=mysql_query($query);
				
				$i=0;
				$class = 'ssi-grid-lightrow';
			?>
				<table width="100%" cellspacing="1" cellpadding="2" border="0">
					<tr class="ssi-grid">
						<td nowrap="1"></td>
						<td><b>Name</b></td>
						<td><b>Title</b></td>
						<td><b>Phone</b></td>
						<td><b>Address</b></td>
						<td></td>
					</tr>
			<?php
					while( $row=mysql_fetch_array($result) )
					{
						echo '<tr id="c'.$i.'" class="'.$class.'" onMouseOver="javascript:trColorOn(\'c'.$i.'\')" onMouseOut="javascript:trColorOff(\'c'.$i.'\')">';
						echo '<td width="5%" nowrap="1">';
						
						//echo '<a href="viewfirm.php?sessionid='.$session->SessionID.'&id='.$row['id'].'" target="_self">View</a>';
						/*
						if($row['userid']!='')
						{
							echo '<img src="images/icon_pencil.gif" alt="" hspace="5" border="0" align="absmiddle">';
						}
												
						if($row['validated']=='1')
						{
							echo '<img src="images/icon_check.gif" alt="" hspace="5" border="0" align="absmiddle">';
						}
						*/
						
						
						echo '</td>';
						echo '<td><b><a href="editstaffform.php?sessionid='.$session->SessionID.'&id='.$row['id'].'" target="viewedit">'.$row['name'].'</a></b></td>';
						echo '<td>'.$row['title'].'</td>';
						echo '<td>'.$row['phone'].'</td>';
						
						$address =  '<td>'. $row['address1'] ;
						
						if($row['address2']!='')
						{
							$address = $address . '<br>';						
						} 
						
						$address = $address .  $row['address2'] ;
						
						if($row['city']!='')
						{
							$address = $address . '<br>';						
						} 
						
						$address = $address .  $row['city'];
						
						if($row['state']!='')
						{
							$address = $address . ', ';						
						} 
						
						$address = $address .  $row['state'] ;
						
						if($row['zip']!='')
						{
							$address = $address . ' ';						
						} 
						
						$address = $address .  $row['zip'] ;
						
						if($row['country']!='')
						{
							$address = $address . '<br>';						
						} 
						
						$address = $address .  $row['country'] ;
						
						$address = $address .  '</td>';
						
						echo $address;
						
						echo '<td align="right"><a href="javascript:deleterecord(\''.$row['name'].'\',\''.$row['id'].'\')"><img src="images/but_remove.gif" alt="" hspace="5" border="0" align="absmiddle">Delete</a></td>';
						
						echo "</tr>";
						$i++;
						
						if($class == 'ssi-grid-lightrow')
						{
							$class = 'ssi-grid-darkrow';
						}else{						
							$class = 'ssi-grid-lightrow';
						}					
					}
					
					if($i==0)
					{
						echo '<tr class="ssi-text"><td colspan="5"><b style="color:red;">No Records Found.</b></td></tr>';					
					}		
			?>
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