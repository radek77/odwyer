<?php 

	if(!mysql_connect("localhost","root","oldhouse"))
	{
		echo "<h2>Can't Connect to Database.</h2>";
		die();
	}
	mysql_select_db("odwyer");
	
	$query = "SELECT DISTINCT  `prfirm`.`name`,  `prfirm`.`city`, `prfirm`.`id`, `prfirm`.`office_locations`, `prfirm`.`ranked`, `prfirm`.`pictures`, `statecode`.`name` as state, `statecode`.`code` as statecode, `prfirm`.`country` FROM  `prfirm`  LEFT JOIN `statecode` ON (`prfirm`.`state` = `statecode`.`code`) WHERE  (`city` <> '') and (`prfirm`.`country` = '') AND (prfirm.inactive = 0) ";
	
	####echo $query;

	$result=mysql_query($query);
	
	$text = "";
	$i=0;
	$statecountry = "";
	$city = "";
	$statename = "";
	$international_cnt = 0;
	$firm_list_array = array();
	
	$x=0;
	
	while( $row=mysql_fetch_array($result)) {
	
		# Grab the state or country field
		if ($statecountry == "") {
			$statecountry = strtoupper($row['state']);
		}	
		
		$firm_list_array[$x]["firm_id"] = $row['id'];
		$firm_list_array[$x]["firm_name"] = trim($row['name']);	
		$firm_list_array[$x]["firm_name_lower"] = trim(strtolower($row['name']));	
		$firm_list_array[$x]["firm_state"] = $row['state'];	
		$firm_list_array[$x]["firm_city"] = $row['city'];
		$firm_list_array[$x]["firm_ranked"] = $row['ranked'];
		$firm_list_array[$x]["firm_pictures"] = $row['pictures'];
		$x++;
			
		if (trim($row['office_locations']) != "") { 
			$office_locations = nl2br(trim($row['office_locations']));
			$office_locations_array = split ('<br />', $office_locations);
			$y = 0;
			for ($y=0; $y < count($office_locations_array); $y++) {
				$office_location_line = trim($office_locations_array[$y]);
				$office_location_line_array = split(',', $office_location_line);

				$office_location_state_code = strtoupper(trim($office_location_line_array[1]));
				$state_query = "SELECT name as statename FROM statecode WHERE code = '$office_location_state_code' ";
				$state_result=mysql_query($state_query);
				$state_row=mysql_fetch_array($state_result);

				$firm_list_array[$x]["firm_id"] = $row['id'];
				$firm_list_array[$x]["firm_name"] = trim($row['name']);	
				$firm_list_array[$x]["firm_name_lower"] = trim(strtolower($row['name']));	
				$firm_list_array[$x]["firm_state"] = $state_row['statename'];
				$firm_list_array[$x]["firm_city"] = trim($office_location_line_array[0]);
				$firm_list_array[$x]["firm_ranked"] = $row['ranked'];
				$firm_list_array[$x]["firm_pictures"] = $row['pictures'];
				$x++;
			}
		}
			
	}	
	
	if (count($firm_list_array) > 0) {

		# Sort the Array
		foreach ($firm_list_array as $key => $firm_list_array_row) {
			####echo $firm_list_array_row['firm_name']."-".$firm_list_array_row['firm_city']."-".$firm_list_array_row['firm_state']."<BR>";
    		$firm_state[$key]  = $firm_list_array_row['firm_state'];
    		$firm_city[$key]  = $firm_list_array_row['firm_city'];
		   	$firm_name_lower[$key] = $firm_list_array_row['firm_name_lower'];
		   	$firm_name[$key] = $firm_list_array_row['firm_name'];
		}
		
		array_multisort($firm_state, SORT_ASC, $firm_city, SORT_ASC, $firm_name_lower, SORT_ASC, $firm_list_array);

		unset($firm_state);
		unset($firm_city);
		unset($firm_name_lower);
		
		$k=0;
		for ($k=0;$k<count($firm_list_array);$k++) {
			if($statename == ($firm_list_array[$k]["firm_state"])) {
				$statename = ($firm_list_array[$k]["firm_state"]);
			} else {			
				$statename = ($firm_list_array[$k]["firm_state"]);
				$text = $text."@BODYTEXT2:\r\n";
				$text = $text . "@GEOSTATE:".strtoupper($statename) . "\r\n";
			}
			if($city == ($firm_list_array[$k]["firm_city"])) {
				$state = ($firm_list_array[$k]["firm_state"]);
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