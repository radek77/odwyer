<?php

/****************************************
*	Session Class
****************************************/
class Session
{
	public $UserID;
	public $UserName;
	public $GroupID;
	public $SessionID;
	
	public $mDataAccess;
	public $Utilities;

	/***************************************
		Initialize the Session class
	****************************************/

	// create a 32 char unique id GUID
	public function CreateGUID()
	{
		list($usec, $sec) = explode(' ', microtime());
		mt_srand((float) $sec + ((float) $usec * 100000));
		$rand_string = md5(uniqid(mt_rand(), true));
		return $rand_string;
	}
	
	/***************************************
		Log In Function
		Returns a Boolean
	****************************************/
	public function LogIn($userid, $userpassword)
	{
		/*========================================
			Validate UserName and Password					
		=========================================*/
		if(!mysql_connect("localhost","root","oldhouse"))
		{
			echo "<h2>Can't Connect to Database.</h2>";
			die();
		}
		mysql_select_db("odwyer");
		$i=0;
		
		$query = 'SELECT id, groupid, firstname, lastname FROM users WHERE `userid` = "'. $userid .'" AND `password` = "' . $userpassword . '"';
		
		
		$result=mysql_query($query);
		
		while( $row=mysql_fetch_array($result) )
		{
			$this->UserID = $row['id'];
			$this->UserName = $row['firstname'] . ' ' . $row['lastname'];
			$this->GroupID = $row['groupid'];
			$i++;
		}

		
		if($this->UserID == '')
		{
			return false;
		}
		else
		{
			$this->StartSession();
			return true;
		}
	}
	
	/***************************************
		Start Session Function
		Returns a Boolean
	****************************************/
	private function StartSession()
	{		
		//Get UserID from the database		
		//$this->DBA->AddParameter('userid', $this->UserID);
		//$result = $this->DBA->Execute('getallsessionbyuser');
		//delete the old session and cache files
		
		//Close all old Sessions for User
		if(!mysql_connect("localhost","root","oldhouse"))
		{
			echo "<h2>Can't Connect to Database.</h2>";
			die();
		}
		
		mysql_select_db("odwyer");
		
		
		$query = "UPDATE login SET valid = 0 WHERE userid = '".$this->UserID."'";		
		mysql_query($query);
		
		//Delete the session from the DB
		$query = "DELETE FROM login WHERE userid = '".$this->UserID."' and valid = 0";		
		mysql_query($query);
		
		
		$this->SessionID = $this->CreateGUID();
		$query = 'INSERT INTO login (sessionid, userid, username, groupid, valid, datetime) VALUES ("'.$this->SessionID.'","'.$this->UserID.'","'.$this->UserName.'","'.$this->GroupID.'",1,"'.date('Y-m-d G:i:s').'")';	
		mysql_query($query);
		//return the session id
	}
	
	public function ValidateSession($sessionid)
	{
		if(!mysql_connect("localhost","root","oldhouse"))
		{
			echo "<h2>Can't Connect to Database.</h2>";
			die();
		}
		mysql_select_db("odwyer");
		$i=0;
		
		$query = 'SELECT * FROM login WHERE `sessionid` = "'. $sessionid .'" AND `valid` = 1';
		
		
		$result=mysql_query($query);
		
		while( $row=mysql_fetch_array($result) )
		{
			$this->SessionID = $row['sessionid'];
			$this->UserID = $row['userid'];
			$this->UserName = $row['username'];
			$this->GroupID = $row['groupid'];
			$i++;
		}
		
		if($this->SessionID == $sessionid)
		{
			return  true;
		}else{
			return  false;
		}
	}
}
?>
