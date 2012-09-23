<html>
<head>
	<title>Untitled</title>
</head>

<body>

<?php 

echo "<P>STARTING";

	if(!mysql_connect("localhost","root","oldhouse"))
	{
		echo "<h2>Can't Connect to Database.</h2>";
		die();
	}
	mysql_select_db("odwyer");
	$clientinfo = "";
	$clientinfo_list = "";
	$name = "";
	
	### Get the clients from the PRfirms table
	$query = "TRUNCATE TABLE client_to_prfirm_temp";
	$result=mysql_query($query);
	
	echo "<P>Deleted old data from temp table";

	### Get the clients from the PRfirms table
	$query = "SELECT id, name, clientinfo FROM prfirm WHERE (inactive = '0') AND (clientinfo != '') ORDER BY name ";
	$result=mysql_query($query);
	
	$i=0;
	$row_cnt=0;

	echo "<P>Selected clients from PR Firms table";
	while( $row=mysql_fetch_array($result) ) {
		$i++;
		$prfirm_name = $row['name'];
		$clientinfo = $row['clientinfo'];
		$prfirm_id = $row['id'];
		
		$clientinfo = str_replace("\r\n","|",$clientinfo);
		$clientinfo = str_replace("~I~","",$clientinfo);
		$clientinfo = str_replace("<$>","",$clientinfo);
		$clientinfo_array = split("\|",$clientinfo);
		
		for ($x=0;$x<count($clientinfo_array);$x++) {
			if (trim($clientinfo_array[$x]) != "") {
				$row_cnt++;
				$clientinfo_display = eregi_replace('<br>', '', $clientinfo_array[$x]);
				$clientinfo_list .= "$row_cnt|".$clientinfo_display."|".$prfirm_name."\r\n";
				
				$inssql = "INSERT INTO client_to_prfirm_temp (client_name, prfirm_name, prfirm_id ) VALUES ('$clientinfo_display', '$prfirm_name', '$prfirm_id')";
				### echo "$inssql<BR>";
				$inssql_result = mysql_query($inssql);
			}		
		}		
	}
				
	echo "<P>Inserted records in temp table";
	
	echo "<P>DONE!!!";

?>

<BR><BR>
</body>
</html>