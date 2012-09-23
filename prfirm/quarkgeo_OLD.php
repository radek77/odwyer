<?php 

	if(!mysql_connect("localhost","root","oldhouse"))
	{
		echo "<h2>Can't Connect to Database.</h2>";
		die();
	}
	mysql_select_db("odwyer");
	
	$query = "SELECT DISTINCT  `prfirm`.`name`,  `prfirm`.`city`,  `statecode`.`name` as state,  `prfirm`.`country` FROM  `prfirm`  LEFT JOIN `statecode` ON (`prfirm`.`state` = `statecode`.`code`) WHERE  (`city` <> '') and prfirm.inactive = 0 ORDER BY  `prfirm`.`country`,  `statecode`.`name`,  `prfirm`.`city`,  `prfirm`.`name`";
	

	
	$result=mysql_query($query);
	
	$i=0;
	$statecountry = "";
	$city = "";
	while( $row=mysql_fetch_array($result) )
	{
		if($row['country']=='')
		{
			
			if($statecountry == strtoupper($row['state']))
			{
				$statecountry = strtoupper($row['state']);
			}else{
				$text = $text . "@BODYTEXT2:\r\n";
				$statecountry = strtoupper($row['state']);
				$text = $text . "@GEOSTATE:" . $statecountry . "\r\n";
			}
		}else{
			if($statecountry == strtoupper($row['country']))
			{
				$statecountry = strtoupper($row['country']);
			}else{				
				$text = $text . "@BODYTEXT2:\r\n";
				$statecountry = strtoupper($row['country']);
				$text = $text . "@GEOSTATE:" . $statecountry . "\r\n";
			}
		}
		
		$textoffice = "";
		$textclient = "";
		$agencystatement = "";
		$staffinfo = "";
		$miscinfo = "";
		$maininfo = "";
		
		
		if($city == ($row['city']))
		{
			$city = ($row['city']);
		}else{			
			$city = ($row['city']);
			$text = $text . "@BODYTEXT2:" . "\r\n";
			$text = $text . "@GEOCITY:" . $city . "\r\n";
		}
	
		$text = $text .  "@BODYTEXT2:" . trim($row['name']) . "\r\n";
		
		
	}	
	
	echo '<pre>'.$text.'</pre>';
?>