<?php 

	if(!mysql_connect("localhost","root","oldhouse"))
	{
		echo "<h2>Can't Connect to Database.</h2>";
		die();
	}
	mysql_select_db("odwyer");

		
	$query = "SELECT lastname, firstname, companyname, titleinfo FROM `staff_corp` ORDER BY  lastname, companyname, firstname";
	
	$result=mysql_query($query);
	
	$i=0;
	$client = "";
	$letter = "";
	while( $row=mysql_fetch_array($result) )
	{
		
		if(!is_numeric(strtoupper(substr($row['lastname'],0,1))) && strtoupper(substr($row['lastname'],0,1)) != "@")
		{
			if($letter == strtoupper((substr($row['lastname'],0,1))))
			{
				$letter = strtoupper(substr($row['lastname'],0,1));
			}else{
				$letter = strtoupper(substr($row['lastname'],0,1));
				$text = $text . "@BREAKER:" . $letter . "\r\n";
			}
		}
		
		$client = $row['lastname'];
		$text = $text . "@BODYTEXT3:" . $client . ", " . $row['firstname'] .  ", " . $row['titleinfo'] . ": ";
	
		
		$text = $text . $row['companyname'];
		$text = $text . "\r\n";
		
		
	}	
		$text = str_replace("; \r\n","\r\n",$text);
	
	echo '<pre>'.$text.'</pre>';
?>