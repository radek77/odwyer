<html>
<head>
</head>
<body>
<PRE>
<?php 

	$db = mysql_connect("localhost","root","oldhouse");
	mysql_select_db("odwyerpr",$db);

	#if(!mysql_connect("localhost","root","oldhouse"))
	#{
	#	echo "<h2>Can't Connect to Database.</h2>";
	#	die();
	#}
	#mysql_select_db("odwyer");
	
	$letter = $_GET['l'];
	
	$clientinfo = "";
	$clientinfo_list = "";
	$prfirm_name = "";
		
	### Get the clients from the PRfirms table
	$query = "SELECT DISTINCT client_name FROM client_to_prfirm_temp WHERE client_name LIKE '$letter%' ORDER BY client_name ";
	$result=mysql_query($query,$db);
	
	$client_ctr=0;
	$row_cnt=0;
	
	echo "@BREAKER:".strtoupper($letter)."\r\n";
	
	while( $row=mysql_fetch_array($result) ) {
		$client_ctr++;
		$client_name = $row['client_name'];
		
		echo "@BODYTEXT3:$client_name: ";
		
		$query2 = "SELECT prfirm_name FROM client_to_prfirm_temp WHERE client_name = '".addslashes($client_name)."' ORDER BY prfirm_name ";
		$result2=mysql_query($query2,$db);
		
		$prfirm_array = array();
		while( $row2=mysql_fetch_array($result2) ) {
			$prfirm_name = $row2['prfirm_name'];
			array_push($prfirm_array,$prfirm_name);
		}
		$prfirm_list = join("; ",$prfirm_array);
		echo "$prfirm_list\r\n";
	}
				
?>
</PRE>
</body>
</html>