<?php 

	if(!mysql_connect("localhost","root","oldhouse"))
	{
		echo "<h2>Can't Connect to Database.</h2>";
		die();
	}
	mysql_select_db("odwyer");
	
	$query = 'SELECT * FROM corp WHERE dirtype = 1 and inactive = 0 and company like "' . $_POST["fieldvalue"] . '%" ORDER BY company';
	
	$text = "";
	
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
		
		$text = $text .  "@CO:" . strtoupper($row['company']) . "\r\n";
		
		if($row['undertitle']!='')
		{
			$maininfo = $maininfo .  "@BODYTEXT:" . $row['undertitle'] . "\r\n";
		}
		
		
		if($row['phone']!='')
		{			
			$phone = $row['phone'];
			if (strlen($phone) == 7)
			{
			       sscanf($phone, "%3s%4s", $prefix, $exchange);
			}
			else if (strlen($phone) == 10)
			{
			       sscanf($phone, "%3s%3s%4s", $area, $prefix, $exchange);
			}
			else if (strlen($phone) > 10)
			{
			       sscanf($phone, "%3s%1s%3s%1s%4s", $area, $firstdiv, $prefix, $secdiv, $exchange);
			}
			else
			{
			       $phone = "";
			}
			
			$out = "";
			if($phone!="")
			{
				$out .= isset($area) ? $area . '/' : "";
				$out .= $prefix . '-' . $exchange;
			}
			
			$maininfo = $maininfo .  "@BODYTEXT:" . $out . "\r\n";
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
				
		if($row['zip']!='' && $row['country']!='')
		{
			$maininfo = $maininfo . ", " . $row['zip'];
		}
		
		if($row['city']!='')
		{
			$maininfo = $maininfo . ", " . $row['city'];
		}
		
		if($row['state']!='')
		{
			$maininfo = $maininfo . ", " . $row['state'];
		}
		
		
		if($row['zip']!='' && $row['country']=='')
		{
			$maininfo = $maininfo . " " . $row['zip'];
		}
		
		if($row['country']!='')
		{
			$maininfo = $maininfo . ", " . $row['country'];
		}
		
		$maininfo = $maininfo . "\r\n";
		
		/*
		$maininfo = $maininfo . "@BODYTEXT:";
		
		if($row['fax']!='')
		{
			$maininfo = $maininfo .  "Fax:" . $row['fax'];
		}
		
		if($row['email']!='')
		{
			$maininfo = $maininfo . "; Email:" . $row['email'];
		}
		
		$maininfo = $maininfo . "\r\n";

		if($row['url']!='')
		{
			$maininfo = $maininfo . "@BODYTEXT:" . $row['url'] . "\r\n";
		}
		*/
		
		$maininfo = str_replace("@BODYTEXT:\r\n","",$maininfo);
		
		$text = $text . $maininfo;
		$text = $text . "@BODYTEXT:";
				
		
		if($row['miscinfo1']!='')
		{
			
			$miscinfo = $row['miscinfo1'];
			
			$miscinfo = str_replace("ì","",$miscinfo);
			$miscinfo = str_replace(" 
","",$miscinfo);
			$miscinfo = str_replace("\r\n\r\n"," ",$miscinfo);
			$miscinfo = str_replace("\r\n"," ",$miscinfo);
			$text = $text . $miscinfo;
		}
		
		$text = $text . "\r\n";
		$text = $text . "@BODYTEXT:";
		
		if($row['prcontact']!='')
		{
			$text = $text . "@CCD1:" . $row['prcontact'];
		
			if($row['prtitle']!='')
			{
				$text = $text . ", " . $row['prtitle'];
			}
		}

		$text = $text . "\r\n";
		$text = str_replace("@BODYTEXT:@CCD1:","@CCD1:",$text);
		$text = $text . "@BODYTEXT:";
		
		if($row['miscinfo2']!='')
		{
			
			$miscinfo = $row['miscinfo2'];
			
			$miscinfo = str_replace("ì","",$miscinfo);
			$miscinfo = str_replace(" 
","",$miscinfo);
			$miscinfo = str_replace("\r\n","\r\n@BODYTEXT:",$miscinfo);
			
			$miscinfo = str_replace("@BODYTEXT:\r\n","",$miscinfo);
			$text = $text . $miscinfo;
		}
		$text = $text . "\r\n";
		
		$text = str_replace("@BODYTEXT:\r\n","",$text);
		$text = str_replace("@BODYTEXT:@CO:","@CO:",$text);
		
		$text = $text . "@BODYTEXT: \r\n";
		
	}	
	
	$text = str_replace("@BODYTEXT:@BODYTEXT: \r\n","@BODYTEXT:\r\n",$text);
	echo '<pre>'.$text.'</pre>';
?>