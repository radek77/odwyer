<html>
<head>
	<title>Untitled</title>
</head>

<body>
<pre>

<? 

	$db = mysql_connect("localhost","root","oldhouse");
	mysql_select_db("odwyer",$db);

	### Get the records from the corp table

	$sql = "SELECT * FROM corp WHERE inactive = '0' ORDER BY company";
	$result=mysql_query($sql);
	
	$corp_ctr=0;
	$row_cnt=0;
	
	$display_rows = 
	"prcontact|prtitle|company|undertitle|address1|address2|city|state|zip|zip4|country|contactphone|phone|phone800|fax|email\r\n";

#####$display_rows = "company|undertitle|address1|address2|city|state|zip|zip4|country|contactphone|phone|phone800|fax|email|prcontact|prtitle|miscinfo1|miscinfo2|url|presceo|ceotitle|cfo|logo|code|codekey|dirtype|hit|sales|cattype|publicprivate|notes|inactive|lastupdated|validated|userid|username\r\n";


	while( $row=mysql_fetch_array($result) ) {
		$corp_ctr++;
		
		####$display_rows .=  "$row[company]|$row[undertitle]|$row[address1]|$row[address2]|$row[city]|$row[state]|$row[zip]|$row[zip4]|$row[country]|$row[contactphone]|$row[phone]|$row[phone800]|$row[fax]|$row[email]|$row[prcontact]|$row[prtitle]|$row[miscinfo1]|$row[miscinfo2]|$row[url]|$row[presceo]|$row[ceotitle]|$row[cfo]|$row[logo]|$row[code]|$row[codekey]|$row[dirtype]|$row[hit]|$row[sales]|$row[cattype]|$row[publicprivate]|$row[notes]|$row[inactive]|$row[lastupdated]|$row[validated]|$row[userid]|$row[username]\r\n";

		$display_rows .=  "$row[prcontact]|$row[prtitle]|$row[company]|$row[undertitle]|$row[address1]|$row[address2]|$row[city]|$row[state]|$row[zip]|$row[zip4]|$row[country]|$row[contactphone]|$row[phone]|$row[phone800]|$row[fax]|$row[email]\r\n";

	}
	
echo "$display_rows";
				
?>

</pre>

</body>
</html>

