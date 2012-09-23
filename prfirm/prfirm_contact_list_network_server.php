<html>
<head>
	<title>Untitled</title>
</head>

<body>
<pre>

<? 

	$db = mysql_connect("localhost","root","oldhouse");
	mysql_select_db("odwyer",$db);

	### Get the clients from the PRfirms table

	$sql = "SELECT * FROM prfirm WHERE inactive = '0' ORDER BY name";
	$result=mysql_query($sql);
	
	$prfirm_ctr=0;
	$row_cnt=0;
	
	$display_rows = 
	"first_name|last_name|title|name|address1|address2|address3|address4|city|state|zip|province|country|phone|fax|email|url\r\n";

	while( $row=mysql_fetch_array($result) ) {
		$prfirm_ctr++;
		$contact_name_array = split(" ", $row['contact']);
		
		$contact_cnt = count($contact_name_array);
		
		if ($contact_cnt == 2) {
			$first_name = $contact_name_array[0];
			$last_name = $contact_name_array[1];
		}
		
		if ($contact_cnt == 1) {
			$first_name = $contact_name_array[0];
			$last_name = "";
		}
		
		if ($contact_cnt > 2) {
			$first_name = "";
			for ($i=0;$i<($contact_cnt - 1);$i++) {
				$first_name .= " ".$contact_name_array[$i];
			}
			$first_name = trim($first_name);
			$last_name = $contact_name_array[$contact_cnt - 1];
		}
		
		$display_rows .=  "$first_name|$last_name|$row[title]|$row[name]|$row[address1]|$row[address2]|$row[address3]|$row[address4]|$row[city]|$row[state]|$row[zip]|$row[province]|$row[country]|$row[phone]|$row[fax]|$row[email]|$row[url]\r\n";
	}
	
echo "$display_rows";
				
?>

</pre>

</body>
</html>

