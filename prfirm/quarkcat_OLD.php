<?php 

	if(!mysql_connect("localhost","root","oldhouse"))
	{
		echo "<h2>Can't Connect to Database.</h2>";
		die();
	}
	mysql_select_db("odwyer");
	
	$text = "";
	
	$cat_query = "SELECT * FROM category ORDER BY name ";
	$cat_result=mysql_query($cat_query);
	
	$cat_cnt=0;
	
	while( $cat_row=mysql_fetch_array($cat_result) ) {
	
		$category_id = $cat_row['id'];
		$category_name = $cat_row['name'];
		
		$text = $text . "@BODYTEXT2:\r\n";
		$text = $text . "@HEADING:" . $category_name . "\r\n";
		
		
		$query = "SELECT DISTINCT  `prfirm`.`name`,  `statecode`.`name` as state,  `prfirm`.`country`,  `prfirm`.`city` FROM  `prfirm`  LEFT JOIN `statecode` ON (`prfirm`.`state` = `statecode`.`code`) WHERE  (prfirm.inactive = 0) AND (category LIKE '%$category_id%') ORDER BY  `prfirm`.`country`,  `statecode`.`name`,  `prfirm`.`name`";
	
		$result=mysql_query($query);
	
		$i=0;
		$statecountry = "";

		while( $row=mysql_fetch_array($result) )
		{
			if($row['country']=='')
			{
			
				if($statecountry == ($row['state']))
				{
					$statecountry = ($row['state']);
				}else{
					$text = $text . "@BODYTEXT2:\r\n";
					$statecountry = ($row['state']);
					$text = $text . "@GEOSTATE2:" . $statecountry . "\r\n";
				}
			}else{
				if($statecountry == ($row['country']))
				{
					$statecountry = ($row['country']);
				}else{				
					$text = $text . "@BODYTEXT2:\r\n";
					$statecountry = ($row['country']);
					$text = $text . "@GEOSTATE2:" . $statecountry . "\r\n";
				}
			}
		
			$text = $text .  "@BODYTEXT2:" . trim($row['name']);
			
			if (trim($row['city']) != "") {
				$text = $text . ", ".trim($row['city'])."\r\n";
			}
			else {
				$text = $text . "\r\n";
			}
		}	
		
				
		$cat_cnt++;
	}
	
	echo '<pre>'.$text.'</pre>';
	
?>