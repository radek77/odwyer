<html>
<head>
	<title>Untitled</title>
</head>

<body>
<pre>

<? 

## Uses the Staff info field as a way to generate the names 

	$db = mysql_connect("localhost","root","oldhouse");
	mysql_select_db("odwyer",$db);

	### Get the clients from the PRfirms table

	$sql = "SELECT * FROM prfirm WHERE inactive = '0' ORDER BY name";
	$result=mysql_query($sql);
	
	$prfirm_ctr=0;
	$row_cnt=0;
	
	$display_rows = 
	"name|title|name|address1|address2|address3|address4|city|state|zip|province|country|phone|fax|email|url\r\n";

	while( $row=mysql_fetch_array($result) ) {
		$prfirm_ctr++;
		
		$staff_name_array = split(";", $row['staffinfo']);
		
		for ($x=0;$x < count($staff_name_array); $x++) {
			$person_name = trim($staff_name_array[$x]);
		
			$display_rows .=  "$person_name|$row[title]|$row[name]|$row[address1]|$row[address2]|$row[address3]|$row[address4]|$row[city]|$row[state]|$row[zip]|$row[province]|$row[country]|$row[phone]|$row[fax]|$row[email]|$row[url]\r\n";
		
		}
	}
	
echo "$display_rows";
				
?>

</pre>

</body>
</html>

