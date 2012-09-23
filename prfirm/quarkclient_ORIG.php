<?php 

	if(!mysql_connect("localhost","root","oldhouse"))
	{
		echo "<h2>Can't Connect to Database.</h2>";
		die();
	}
	mysql_select_db("odwyer");
	switch ($_POST["fieldvalue"]) {
		case "09":
			$text = "@BREAKER:0-9";
			$query = "SELECT   `prfirm`.`name` as firm,  `clientstofirm`.`name` AS client FROM  `clientstofirm`  INNER JOIN `prfirm` ON (`clientstofirm`.`pid` = `prfirm`.`id`) WHERE `clientstofirm`.`name` <> '' and (`clientstofirm`.`name` like '0%' or `clientstofirm`.`name` like '1%' or `clientstofirm`.`name` like '2%' or `clientstofirm`.`name` like '3%' or `clientstofirm`.`name` like '4%' or `clientstofirm`.`name` like '5%' or `clientstofirm`.`name` like '6%' or `clientstofirm`.`name` like '7%' or `clientstofirm`.`name` like '8%' or `clientstofirm`.`name` like '9%' or `clientstofirm`.`name` like '@%') ORDER BY `clientstofirm`.`name`,  `prfirm`.`name`";
			
			break;
		case "AB":
			$query = "SELECT   `prfirm`.`name` as firm,  `clientstofirm`.`name` AS client FROM  `clientstofirm`  INNER JOIN `prfirm` ON (`clientstofirm`.`pid` = `prfirm`.`id`) WHERE `clientstofirm`.`name` <> '' and (`clientstofirm`.`name` like 'A%' or `clientstofirm`.`name` like 'B%') ORDER BY `clientstofirm`.`name`,  `prfirm`.`name`";
		
			break;
		case "CD":
			$query = "SELECT   `prfirm`.`name` as firm,  `clientstofirm`.`name` AS client FROM  `clientstofirm`  INNER JOIN `prfirm` ON (`clientstofirm`.`pid` = `prfirm`.`id`) WHERE `clientstofirm`.`name` <> '' and (`clientstofirm`.`name` like 'C%' or `clientstofirm`.`name` like 'D%') ORDER BY `clientstofirm`.`name`,  `prfirm`.`name`";
				
			break;
		case "EH":
			$query = "SELECT   `prfirm`.`name` as firm,  `clientstofirm`.`name` AS client FROM  `clientstofirm`  INNER JOIN `prfirm` ON (`clientstofirm`.`pid` = `prfirm`.`id`) WHERE `clientstofirm`.`name` <> '' and (`clientstofirm`.`name` like 'E%' or `clientstofirm`.`name` like 'F%' or `clientstofirm`.`name` like 'G%' or `clientstofirm`.`name` like 'H%') ORDER BY `clientstofirm`.`name`,  `prfirm`.`name`";
			
			break;
		case "IL":
			$query = "SELECT   `prfirm`.`name` as firm,  `clientstofirm`.`name` AS client FROM  `clientstofirm`  INNER JOIN `prfirm` ON (`clientstofirm`.`pid` = `prfirm`.`id`) WHERE `clientstofirm`.`name` <> '' and (`clientstofirm`.`name` like 'I%' or `clientstofirm`.`name` like 'J%' or `clientstofirm`.`name` like 'K%' or `clientstofirm`.`name` like 'L%') ORDER BY `clientstofirm`.`name`,  `prfirm`.`name`";
			
			break;
		case "MP":
			$query = "SELECT   `prfirm`.`name` as firm,  `clientstofirm`.`name` AS client FROM  `clientstofirm`  INNER JOIN `prfirm` ON (`clientstofirm`.`pid` = `prfirm`.`id`) WHERE `clientstofirm`.`name` <> '' and (`clientstofirm`.`name` like 'M%' or `clientstofirm`.`name` like 'N%' or `clientstofirm`.`name` like 'O%' or `clientstofirm`.`name` like 'P%') ORDER BY `clientstofirm`.`name`,  `prfirm`.`name`";
			
			break;	
		case "QT":
			$query = "SELECT   `prfirm`.`name` as firm,  `clientstofirm`.`name` AS client FROM  `clientstofirm`  INNER JOIN `prfirm` ON (`clientstofirm`.`pid` = `prfirm`.`id`) WHERE `clientstofirm`.`name` <> '' and (`clientstofirm`.`name` like 'Q%' or `clientstofirm`.`name` like 'R%' or `clientstofirm`.`name` like 'S%' or `clientstofirm`.`name` like 'T%') ORDER BY `clientstofirm`.`name`,  `prfirm`.`name`";
			
			break;	
		case "UZ":
			$query = "SELECT   `prfirm`.`name` as firm,  `clientstofirm`.`name` AS client FROM  `clientstofirm`  INNER JOIN `prfirm` ON (`clientstofirm`.`pid` = `prfirm`.`id`) WHERE `clientstofirm`.`name` <> '' and (`clientstofirm`.`name` like 'U%' or `clientstofirm`.`name` like 'V%' or `clientstofirm`.`name` like 'W%' or `clientstofirm`.`name` like 'X%' or `clientstofirm`.`name` like 'Y%' or `clientstofirm`.`name` like 'Z%') ORDER BY `clientstofirm`.`name`,  `prfirm`.`name`";
			
			break;	
		default:
			$query = "SELECT   `prfirm`.`name` as firm,  `clientstofirm`.`name` AS client FROM  `clientstofirm`  INNER JOIN `prfirm` ON (`clientstofirm`.`pid` = `prfirm`.`id`) WHERE `clientstofirm`.`name` <> '' ORDER BY `clientstofirm`.`name`,  `prfirm`.`name` LIMIT 1000";
			break;
	}
	

	
	$result=mysql_query($query);
	
	$i=0;
	$client = "";
	$letter = "";
	while( $row=mysql_fetch_array($result) )
	{
		
		if($client == $row['client'])
		{
			$client = $row['client'];
		}else{			
			$text = $text . "\r\n";
			
			if(!is_numeric(strtoupper(substr($row['client'],0,1))) && strtoupper(substr($row['client'],0,1)) != "@")
			{
				if($letter == strtoupper((substr($row['client'],0,1))))
				{
					$letter = strtoupper(substr($row['client'],0,1));
				}else{
					$letter = strtoupper(substr($row['client'],0,1));
					$text = $text . "@BREAKER:" . $letter . "\r\n";
				}
			}
			
			$client = $row['client'];
			$text = $text . "@BODYTEXT3:" . $client . ": ";
		}
		
		$text = $text . $row['firm'] . "; ";
		$text = str_replace("; \r\n","\r\n",$text);
		
		
	}	
	
	echo '<pre>'.$text.'</pre>';
?>