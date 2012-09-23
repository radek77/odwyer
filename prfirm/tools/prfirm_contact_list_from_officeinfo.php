<html>
<head>
	<title>Untitled</title>
</head>

<body>
<pre>

<? 
	if(!mysql_connect("localhost","root","oldhouse"))
	{
		echo "<h2>Can't Connect to Database.</h2>";
		die();
	}
	mysql_select_db("odwyer");

	### Get the clients from the PRfirms table

	$sql = "SELECT * FROM prfirm WHERE inactive = '0' AND officeinfo != '' ORDER BY name";
	$result=mysql_query($sql);
	
	$prfirm_ctr=0;
	$row_cnt=0;
	
	$display_rows = 
	"contact_name|company_name|address|contact_info\r\n";
	
	while( $row=mysql_fetch_array($result) ) {
		$prfirm_ctr++;

		$company_name = trim($row['name']);
		$office_info = trim($row['officeinfo']);
		$contact_info = "";
		$address_display = "";		
		$contact_name = "";	
		
		$address_sections_array = split("@ADD1 = ", $office_info);

		for ($a=0; $a < count($address_sections_array); $a++) {
			
			$address_sections_work = trim($address_sections_array[$a]);
			
			if ($address_sections_work != "") {
				$address_temp_array = split("@CON1 =", $address_sections_work);
				$contact_section_work = $address_temp_array[1];
				$address_temp_array = split("@CCD1 =", $address_temp_array[0]);
	
				$address_display = trim($address_temp_array[0]);
				$address_display = str_replace("\n","", $address_display);
				$address_display = str_replace("\r","", $address_display);
				
				$contact_temp_array = split("@CCD1 =", trim($contact_section_work));
				$contact_name_work = trim($contact_temp_array[1]);
				$contact_info = str_replace("\n","", trim($contact_temp_array[0]));
				$contact_info = str_replace("\r","", $contact_info);


				$contact_name = $contact_name_work;
				$contact_name = str_replace("\n","", $contact_name);
				$contact_name = str_replace("\r","", $contact_name);
				
				
				$display_rows .=  "$contact_name|$company_name|$address_display|$contact_info\r\n";
			}
			
		}
	}
	
echo "$display_rows";
				
?>

</pre>

</body>
</html>

