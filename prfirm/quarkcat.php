<?php 
error_reporting(0);



if(!mysql_connect("localhost","root","oldhouse"))
{
	echo "<h2>Can't Connect to Database.</h2>";
	die();
}
mysql_select_db("odwyer");
	
$text = "";
	
#$cat_query = "SELECT * FROM category WHERE id = '{E6F83BD6-C7E7-475F-9186-D0B51321DB3A}' ORDER BY name ";
$cat_query = "SELECT * FROM category ORDER BY name ";
$cat_result=mysql_query($cat_query);
	
$cat_cnt=0;

while( $cat_row=mysql_fetch_array($cat_result) ) {
	
	$category_id = $cat_row['id'];
	$category_name = $cat_row['name'];
		
	$text = $text . "@BODYTEXT2:\r\n";
	$text = $text . "@HEADING:" . $category_name . " \r\n";
		
	# New code

	$query = "SELECT DISTINCT  `prfirm`.`name`,  `prfirm`.`id`, `prfirm`.`office_locations`, `statecode`.`name` as state,  `prfirm`.`country`,  `prfirm`.`city`, `prfirm`.`ranked`, `prfirm`.`pictures` FROM  `prfirm`  LEFT JOIN `statecode` ON (`prfirm`.`state` = `statecode`.`code`) WHERE (prfirm.inactive = 0) AND (category LIKE '%$category_id%')";


	###echo $query."<P>";
		
	$result=mysql_query($query);
	
	$i=0;
	$statecountry = "";
	$city = "";
	$international_cnt = 0;

	$country_hold = "";
	$city_hold = "";
	$state = "";
		
	$firm_list_array = array();
	$firm_list_array_row = array();
	$office_locations = "";
	$office_locations_international = "";
	$office_locations_array = array();
	$office_location_line = "";
	$office_location_line_array = array();

	$x = 0;

	while( $row=mysql_fetch_array($result) ) {
		
		# Grab the state or country field
		if ($statecountry == "") {
			$statecountry = strtoupper($row['state']);
		}	
		
		if(trim($row['country']) == '') {

			$firm_list_array[$x]["firm_id"] = $row['id'];
			$firm_list_array[$x]["firm_name"] = $row['name'];
			$firm_list_array[$x]["firm_name_lower"] = trim(strtolower($row['name']));
			$firm_list_array[$x]["firm_city"] = $row['city'];
			$firm_list_array[$x]["firm_state"] = $row['state'];
			$firm_list_array[$x]["firm_ranked"] = $row['ranked'];
			$firm_list_array[$x]["firm_pictures"] = $row['pictures'];
			$x++;
			
			if (trim($row['office_locations']) != "") { 
				$office_locations = nl2br(trim($row['office_locations']));
				$office_locations_array = split ('<br />', $office_locations);
				$y = 0;
				$state_code_temp = "";
				for ($y=0; $y < count($office_locations_array); $y++) {
					$office_location_line = trim($office_locations_array[$y]);
					$office_location_line_array = split(',', $office_location_line);
					
					$office_location_state = strtoupper(trim($office_location_line_array[1]));
					
					$firm_list_array[$x]["firm_id"] = $row['id'];
					$firm_list_array[$x]["firm_name"] = $row['name'];
					$firm_list_array[$x]["firm_name_lower"] = trim(strtolower($row['name']));
					$firm_list_array[$x]["firm_city"] = trim($office_location_line_array[0]);
					$state_code_temp = trim($office_location_line_array[1]);
					
					# Get state name for state code
					$state_query = "SELECT name FROM `statecode` WHERE (code = '$state_code_temp')";
					$state_result=mysql_query($state_query);
					$state_row=mysql_fetch_array($state_result);

					$firm_list_array[$x]["firm_state"] = strtoupper(trim($state_row['name']));
					$firm_list_array[$x]["firm_ranked"] = $row['ranked'];
					$firm_list_array[$x]["firm_pictures"] = $row['pictures'];
					$x++;
				}
			}
	
		} 
			
	}	
	
	if (count($firm_list_array) > 0) {
		
		$prfirms_found = "Y";
		
		# Display Header of state or country

		# Sort the Array
		foreach ($firm_list_array as $key => $firm_list_array_row) {
    		$firm_state[$key]  = $firm_list_array_row['firm_state'];
    		$firm_city[$key]  = $firm_list_array_row['firm_city'];
		   	$firm_name_lower[$key] = $firm_list_array_row['firm_name_lower'];
		   	$firm_name[$key] = $firm_list_array_row['firm_name'];
		}

		array_multisort($firm_state, SORT_ASC, $firm_name_lower, SORT_ASC, $firm_city, SORT_ASC, $firm_list_array);
		
		unset($firm_state);
		unset($firm_city);
		unset($firm_name_lower);
		
		###print_r($firm_list_array);
		###echo "<BR><BR><BR>";
		
		$state = "";
		$k=0;
		for ($k=0;$k<count($firm_list_array);$k++) {
			if($state == ($firm_list_array[$k]["firm_state"])) {
				$state = ($firm_list_array[$k]["firm_state"]);
			} else {			
				$state = ($firm_list_array[$k]["firm_state"]);
				$text = $text . "@BODYTEXT2:\r\n";
				$text = $text . "@GEOSTATE2:".ucwords(strtolower($state)). "\r\n";
			}

			####echo "-->".$firm_list_array[$k]["firm_city"]." - ".$firm_list_array[$k]["firm_name"]."<BR>";
		
			#if (trim($row['award_winner']) == "1") {
			#	$ribbon_display = "<img src='award_ribbon.jpg' border=0 alt='Award Winner' align=left>";
			#}
			#else {
				$ribbon_display = "";
			#} 
			
			if (trim($firm_list_array[$k]["firm_name"]) != "") {
				$text = $text .$ribbon_display ."@BODYTEXT2:".trim($firm_list_array[$k]["firm_name"]).", ".trim($firm_list_array[$k]["firm_city"]);
			}
			
			#if ($firm_list_array[$k]["firm_ranked"] == 1) {
			#	$ranked_display = "<img src='/pr_firms_database/rankings_seal.jpg' border=0 alt='Ranking'>";
			#	$text = $text."&nbsp;".$ranked_display;
			#}
			
			#if ($firm_list_array[$k]["firm_pictures"] == 1) {
			#	$pictures_display = "<img src='/pr_firms_database/pictures_seal.jpg' border=0 alt='Pictures'>";
			#	$text = $text."&nbsp;".$pictures_display;
			#}
			
			$text = $text . "\r\n";

		}
	}

	# End New Code
		
### END CATEGORY LOOP
	$cat_cnt++;
}

echo '<pre>'.$text.'</pre>';
	
?>