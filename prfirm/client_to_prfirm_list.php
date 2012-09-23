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
	$query = "SELECT DISTINCT client_name FROM client_to_prfirm_temp ORDER BY client_name ";
	$result=mysql_query($query);
	
	$client_ctr=0;
	$row_cnt=0;
	while( $row=mysql_fetch_array($result) ) {
		$client_ctr++;
		$client_name = $row['client_name'];
		
		$clientinfo_list .= "$client_name\r\n";
			
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