<?php 

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
	$query = "SELECT name, clientinfo FROM prfirm WHERE inactive = '0' AND clientinfo != '' ORDER BY name ";
	$result=mysql_query($query);
	
	$i=0;
	$row_cnt=0;
	while( $row=mysql_fetch_array($result) ) {
		$i++;
		$prfirm_name = $row['name'];
		$clientinfo = $row['clientinfo'];
		
		$clientinfo = str_replace("\r\n","|",$clientinfo);
		$clientinfo_array = split("\|",$clientinfo);
		
		for ($x=0;$x<count($clientinfo_array);$x++) {
			if (trim($clientinfo_array[$x]) != "") {
				$row_cnt++;
				$clientinfo_list .= "$row_cnt|".$clientinfo_array[$x]."|".$prfirm_name."\r\n";		
			}		
		}		
	}
				
?>

<html>
<head>
	<title>Untitled</title>
</head>

<body>
<pre>
<? echo $clientinfo_list ?>
</pre>

</body>
</html>