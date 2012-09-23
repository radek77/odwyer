<?php 

	if(!mysql_connect("localhost","root","oldhouse"))
	{
		echo "<h2>Can't Connect to Database.</h2>";
		die();
	}
	mysql_select_db("odwyer");
	
	$query = "SELECT DISTINCT  `prfirm`.`name`,  `prfirm`.`city`, `prfirm`.`id`, `prfirm`.`ranked`, `prfirm`.`pictures`, `prfirm`.`office_locations_international`, `prfirm`.`country` FROM `prfirm` WHERE  (`prfirm`.`city` <> '') and (prfirm.inactive = 0) and ((prfirm.country != '') OR (`prfirm`.`office_locations_international` != '')) ";
	
	####echo $query;

	$result=mysql_query($query);
	
	$text = "";
	$i=0;
	$country = "";
	$city = "";
	$countryname = "";
	$international_cnt = 0;
	$firm_list_array = array();
	
	$x=0;
	
	while( $row=mysql_fetch_array($result)) {
	
		if ($row['country'] != "") {
			$firm_list_array[$x]["firm_id"] = $row['id'];
			$firm_list_array[$x]["firm_name"] = trim($row['name']);	
			$firm_list_array[$x]["firm_name_lower"] = trim(strtolower($row['name']));	
			$firm_list_array[$x]["firm_country"] = $row['country'];	
			$firm_list_array[$x]["firm_city"] = $row['city'];
			$x++;
		}
		
		if ($row['office_locations_international'] != "") { 
			$office_locations_international = nl2br(trim($row['office_locations_international']));
			$office_locations_international_array = split ('<br />', $office_locations_international);
			$y = 0;
			for ($y=0; $y < count($office_locations_international_array); $y++) {
				$office_locations_international_line = trim($office_locations_international_array[$y]);
				$office_locations_international_line_array = split(',', $office_locations_international_line);
				$firm_list_array[$x]["firm_id"] = $row['id'];
				$firm_list_array[$x]["firm_name"] = trim($row['name']);	
				$firm_list_array[$x]["firm_name_lower"] = trim(strtolower($row['name']));	
				$firm_list_array[$x]["firm_country"] = trim($office_locations_international_line_array[1]);
				$firm_list_array[$x]["firm_city"] = trim($office_locations_international_line_array[0]);
				$x++;
			}
		}
			
	}	
	
	if (count($firm_list_array) > 0) {

		# Sort the Array
		foreach ($firm_list_array as $key => $firm_list_array_row) {
			####echo $firm_list_array_row['firm_name']."-".$firm_list_array_row['firm_city']."-".$firm_list_array_row['firm_country']."<BR>";
    		$firm_country[$key]  = $firm_list_array_row['firm_country'];
    		$firm_city[$key]  = $firm_list_array_row['firm_city'];
		   	$firm_name_lower[$key] = $firm_list_array_row['firm_name_lower'];
		   	$firm_name[$key] = $firm_list_array_row['firm_name'];
		}
		
		array_multisort($firm_country, SORT_ASC, $firm_city, SORT_ASC, $firm_name_lower, SORT_ASC, $firm_list_array);

		$k=0;
		for ($k=0;$k<count($firm_list_array);$k++) {
			if($countryname == ($firm_list_array[$k]["firm_country"])) {
				$countryname = ($firm_list_array[$k]["firm_country"]);
			} else {			
				$countryname = ($firm_list_array[$k]["firm_country"]);
				$text = $text."@BODYTEXT2:\r\n";
				$text = $text . "@GEOSTATE:".strtoupper($countryname) . "\r\n";
			}
			if($city == ($firm_list_array[$k]["firm_city"])) {
				$country = ($firm_list_array[$k]["firm_country"]);
			} else {			
				$city = ($firm_list_array[$k]["firm_city"]);
				$text = $text."@BODYTEXT2:\r\n";
				$text = $text . "@GEOSTATE:".$city . "\r\n";
			}

			####echo $firm_list_array[$k]["firm_city"]." - ".$firm_list_array[$k]["firm_name"]."<BR>";
		
			$text = $text ."@BODYTEXT2:".trim($firm_list_array[$k]['firm_name'])."\r\n";
		}
	}
	else {
		echo "<BR><BR><BR><b>No PR Firms were found for this location.</b><BR><BR><BR>";
	}		
	
	echo '<pre>'.$text.'</pre>';
?>