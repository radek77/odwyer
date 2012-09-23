
<?
	echo $_POST["uid"];
	if(!mysql_connect("localhost","root","oldhouse"))
	{
		echo "<h2>Can't Connect to Database.</h2>";
		die();
	}
	mysql_select_db("odwyer");
	
	$result=mysql_query("SELECT * FROM users;");
	
	$i=0;
	while( $row=mysql_fetch_array($result) )
	{
		echo "<tr valign=center>";
		echo "<td class=tabval><b>".$row['id']."</b></td>";
		echo "<td class=tabval>".$row['firstname']."&nbsp;</td>";
		echo "<td class=tabval>".$row['lastname']."&nbsp;</td>";
		echo "</tr>";
		$i++;

	}
?>