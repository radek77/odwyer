<?php 

	if(!mysql_connect("localhost","root","oldhouse"))
	{
		echo "<h2>Can't Connect to Database.</h2>";
		die();
	}
	mysql_select_db("odwyer");
	
	$query = 'SELECT * FROM prfirm WHERE (country = "" or isnull(country)) and inactive = 0 and alpha = "' . $_POST["fieldvalue"] . '" and (isnull(organization) or organization = 0) ORDER BY name';
	

	
	$result=mysql_query($query);
	
	$i=0;
	$text = $text .  "@BREAKER:" . $_POST["fieldvalue"] . "\r\n\r\n";
	while( $row=mysql_fetch_array($result) )
	{
		$textoffice = "";
		$textclient = "";
		$agencystatement = "";
		$staffinfo = "";
		$miscinfo = "";
		$maininfo = "";
		
		$text = $text .  "@CO:" . strtoupper($row['name']) . "\r\n";
		if($row['undertitle']!='')
		{
			$maininfo = $maininfo .  "@BODYTEXT:" . $row['undertitle'] . "\r\n";
		}
		
		$maininfo = $maininfo . "@BODYTEXT:";
		
		if($row['address1']!='')
		{
			$maininfo = $maininfo . $row['address1'];
		}
		
		if($row['address2']!='')
		{
			$maininfo = $maininfo . ", " . $row['address2'];
		}
		
		if($row['address3']!='')
		{
			$maininfo = $maininfo . ", " . $row['address3'];
		}
		
		if($row['address4']!='')
		{
			$maininfo = $maininfo . ", " . $row['address4'];
		}
		
		if($row['zip']!='' && $row['country']!='')
		{
			$maininfo = $maininfo . ", " . $row['zip'];
			
			if($row['zip4']!='')
			{
				$maininfo = $maininfo . "-" . $row['zip4'];
			}
		}
		
		if($row['city']!='')
		{
			$maininfo = $maininfo . ", " . $row['city'];
		}
		
		if($row['state']!='')
		{
			$maininfo = $maininfo . ", " . $row['state'];
		}
		
		if($row['province']!='')
		{
			$maininfo = $maininfo . ", " . $row['province'];
		}
		
		if($row['zip']!='' && $row['country']=='')
		{
			$maininfo = $maininfo . " " . $row['zip'];
						
			if($row['zip4']!='')
			{
				$maininfo = $maininfo . "-" . $row['zip4'];
			}
		}
		
		if($row['country']!='')
		{
			$maininfo = $maininfo . ", " . $row['country'];
		}
		
		$maininfo = $maininfo . "\r\n";
		$maininfo = $maininfo . "@BODYTEXT:";
		
		if($row['phone']!='')
		{			
			$maininfo = $maininfo . $row['phone'];
		}
		
		if($row['fax']!='')
		{
			$maininfo = $maininfo . "; fax: " . $row['fax'];
		}
		
		if($row['email']!='')
		{
			$maininfo = $maininfo . "; " . $row['email'];
		}
		
		$maininfo = $maininfo . "\r\n";
		$maininfo = $maininfo . "@BODYTEXT:";
		
		if($row['url']!='')
		{
			$maininfo = $maininfo . $row['url'];
		}
		
		$maininfo = $maininfo . "\r\n";
		$maininfo = $maininfo . "@BODYTEXT:";
		
		$maininfo = str_replace("@BODYTEXT:\r\n","",$maininfo);
		
		$text = $text . $maininfo;
		
		if($row['miscinfo']!='')
		{
			
			$miscinfo = $row['miscinfo'];
			
			$pos = strpos(strtolower($row['miscinfo']), "employees:");

			if ($pos === false) {
				if($row['employees']!='' && $row['employees']!='0')
				{
					$miscinfo = $miscinfo . " Employees: " . $row['employees'] . ".";
				}else{
					$miscinfo = $miscinfo;
				}
			}
			
			$pos = strpos(strtolower($row['miscinfo']), "founded:");
			
			if ($pos === false) {
				if($row['founded']!='' && $row['founded']!='0')
				{					
					$miscinfo = $miscinfo . " Founded: " . $row['founded'] . ".";
				}else{
					$miscinfo = $miscinfo;
				}
			}
			$miscinfo = str_replace("@BODYTEXT:\r\n","",$miscinfo);
			$text = $text . $miscinfo;
		}
		
		$text = $text . "\r\n";
		
		if($row['agencystatement']!='')
		{
			$agencystatement = "@AGENCY:" . str_replace("\r\n","\r\n@AGENCY:",$row['agencystatement']) . "\r\n";
			$agencystatement = str_replace("@AGENCY:\r\n","",$agencystatement);	
			
			$text = $text . $agencystatement;
		}
		
		if($row['staffinfo']!='')
		{
			$staffinfo = "@CCD1:" . str_replace("@CCD1 = ","",$row['staffinfo']) . "\r\n";
			
			$staffinfo = str_replace("@BODYTEXT:\r\n","",$staffinfo);
			$text = $text . $staffinfo;
		}
		
		if($row['officeinfo']!='')
		{
			$textoffice = str_replace("@CCD1 = ","@CCD1:",$row['officeinfo']);
			$textoffice = "@BODYTEXT:" . str_replace("\r\n","\r\n@BODYTEXT:",$textoffice) . "\r\n";
			//$textoffice = str_replace("@BODYTEXT:@BODYTEXT:","",$textoffice);
			$textoffice = str_replace("@BODYTEXT:@CCD1:","@CCD1:",$textoffice);
			$textoffice = str_replace("@BODYTEXT:\r\n","",$textoffice);	
			
			$textoffice = $textoffice . "@BODYTEXT:\r\n";
			$text = $text . $textoffice;
		}
		
		if($row['clientinfo']!='')
		{
			$textclient = "@BODYTEXT:" . str_replace("\r\n","\r\n@BODYTEXT:",$row['clientinfo']) . "\r\n";
			
			$text = $text . str_replace("@BODYTEXT:\r\n","",$textclient);	
		}
		
		//$text = str_replace("@BODYTEXT:\r\n","",$text);
		
		$text = $text . "@BODYTEXT:\r\n";
		
	}	
	
	echo '<pre>'.$text.'</pre>';
?>