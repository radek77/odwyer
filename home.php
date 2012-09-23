
<?
	if(!mysql_connect("localhost","root","oldhouse"))
	{
		echo "<h2>Can't Connect to Database.</h2>";
		die();
	}
	mysql_select_db("odwyer");
	
	$result=mysql_query("SELECT * FROM corp;");
	
	$i=0;
	while( $row=mysql_fetch_array($result) )
	{
		if($i>0)
		{
			echo "<tr valign=bottom>";
			echo "<td bgcolor=#ffffff background='img/strichel.gif' colspan=6></td>";
			echo "</tr>";
		}
		echo "<tr valign=center>";
		echo "<td class=tabval><b>".$row['ID']."</b></td>";
		echo "<td class=tabval>".$row['CORP_NAME']."&nbsp;</td>";
		echo "<td class=tabval>".$row['UNDERTITLE']."&nbsp;</td>";
		echo "</tr>";
		$i++;

	}
?>