<?php
// PHP Document

//************************************************************
//   fileName: mySQL.php
//discription: PHP for CSSA airport pick-up form 
//      usage: handle the params posted from clients and connect with mySQL
//     author: Beichen Li
//         QQ: 754950989
//************************************************************

	//mysql_query("INSERT INTO Persons (FirstName, LastName, Age) 
	//VALUES ('Glenn', 'Quagmire', '33')");
	//mysql_query("INSERT INTO Persons (FirstName, LastName, Age) ;
	//VALUES ('gag', 'lbc', '34')");

class SQL{
	//      mySQL security params
	private $DB_HOST='localhost';
	private $DB_DATABASE='relidinc_cssa';
	private $DB_USERNAME='relidinc_php';
	private $DB_PASSWORD='lbc2605403028';
	private $DB_FORM_NAME='Users';
	private $DB_FORM_NAME_BROADCAST='Broadcast';
	private $DB_FORM_NAME_SECURITY='Security';
	private $DB_FORM_NAME_LOG='log';	
	private $con;
function setUTF8()
{
	mysql_query("SET NAMES UTF8"); 
}
//==========================
//    open SQL connection
//==========================
function open(){	
//         Connect to database
    $this->con=mysql_connect ($this->DB_HOST,$this->DB_USERNAME, $this->DB_PASSWORD);
	$this->setUTF8();
	if (!$this->con)
	  {
	  die('[open]Could not connect to database: ' . mysql_error());
	  }
//         Select database

	$db_select = mysql_select_db($this->DB_DATABASE);
	if (!$db_select)
	{
		die ("Could not select the database: <br />". mysql_error(  ));
	}
}
//==========================
//    close SQL connection
//==========================
function close()
{
	mysql_close($this->con);
}
//==========================
//   check if $data is in $column, returns boolean
//==========================
function isExist($column,$data)
{

		$result = mysql_query("SELECT ".$column." FROM ".$this->DB_FORM_NAME);
		
		if (!$result)
		{
		   die ("[isExist]Could not query the database: <br />". mysql_error(  ));
		}
	
		while ($result_row = mysql_fetch_row($result))
		{
      		 	$result_row[0];
				
				if ($result_row[0]==$data)
				
				{
					
					return true;
				}
		}
		
		return false;
}
//==========================
//   check if $column_1,$data_1's row contain $column_2,$data_2
//==========================
function isCorrect($column_1,$data_1,$column_2,$data_2){
	
		$result = mysql_query("SELECT ".$column_2." FROM ".$this->DB_FORM_NAME." WHERE ".$column_1." = '".$data_1."'");
		if (!$result)
		{
		   die ("[isCorrect]Could not query the database: <br />". mysql_error(  ));
		}

		$result_row = mysql_fetch_row($result);
		mysql_free_result($result);
		 if ($result_row[0]==$data_2)
		 {
			 return true;
			 
		 }
		return false;
}
//==========================
//  	get UID (user ID is a special int to distinguish users
//==========================
function getUID($username,$password)
{
		$result = mysql_query("SELECT UID FROM ".$this->DB_FORM_NAME." WHERE Username = "."'".$username."'"." AND Password = "."'".$password."'");
		if (!$result)
		{
		   die ("[getUID]Could not query the database: <br />". mysql_error(  ));
		}

		$result_row = mysql_fetch_row($result);
		mysql_free_result($result);
		 if (($result_row[0]=="")or($result_row[0]==null))
		 {
			 return (-1);
			 
		 }
		 else
		 {
			return $result_row[0];	 	 
		 }
}
function getUIDSimple($username)
{
		$result = mysql_query("SELECT UID FROM ".$this->DB_FORM_NAME." WHERE Username = "."'".$username."'");
		if (!$result)
		{
		   die ("[getUID]Could not query the database: <br />". mysql_error(  ));
		}

		$result_row = mysql_fetch_row($result);
		mysql_free_result($result);
		 if (($result_row[0]=="")or($result_row[0]==null))
		 {
			 return (-1);
		 }
		 else
		 {
			return $result_row[0];	 	 
		 }
}
//==========================
//  	get UID (user ID is a special int to distinguish users
//==========================
function getIP($username,$password)
{
		$result = mysql_query("SELECT LastLoginIP FROM ".$this->DB_FORM_NAME." WHERE Username = "."'".$username."'"." AND Password = "."'".$password."'");
		if (!$result)
		{
		   die ("[getIP]Could not query the database: <br />". mysql_error(  ));
		}

		$result_row = mysql_fetch_row($result);
		mysql_free_result($result);
		 if (($result_row[0]=="")or($result_row[0]==null))
		 {
			 return (-1);
			 
		 }
		 else
		 {
			return $result_row[0];	 	 
		 }
}
//==========================
//  	get data
//==========================
function getData($UID,$username,$column){
		$result = mysql_query("SELECT ".$column." FROM ".$this->DB_FORM_NAME." WHERE UID = '".$UID."' AND Username = '".$username."'");
		if (!$result)
		{
		   die ("[getData]Could not query the database: <br />". mysql_error(  ));
		}

		$result_row = mysql_fetch_array($result);
		mysql_free_result($result);
		return $result_row[0];
}

function getColumn($column){
		$result = mysql_query("SELECT ".$column." FROM ".$this->DB_FORM_NAME);
		if (!$result)
		{
		   die ("[getData]Could not query the database: <br />". mysql_error(  ));
		}

		$result_row = mysql_fetch_array($result);
		mysql_free_result($result);
		return $result_row;
}
//==========================
//  	get broadcast
//==========================
function getBroadcast(){
		$result = mysql_query("SELECT Content FROM ".$this->DB_FORM_NAME_BROADCAST." WHERE User = 'all'");
		if (!$result)
		{
		   die ("[getBroadcast]Could not query the database: <br />". mysql_error(  ));
		}

		$result_row = mysql_fetch_array($result);
		mysql_free_result($result);
		return $result_row[0];
}

//==========================
//  	update data
//==========================
function updateData($UID,$username,$column,$data)
{
		$result = mysql_query("UPDATE ".$this->DB_FORM_NAME." SET ".$column." = '".$data."' WHERE UID = '".$UID."' AND Username = '".$username."'");
		
		if (!$result)
		{
			mysql_free_result($result);
		   die ("[updateData]Could not query the database: <br />". mysql_error(  ));
		}
	    else
		{
			mysql_free_result($result);
			return true;	
		}
}

function updateMultiData($UID,$username,$line)
{

		$result = mysql_query("UPDATE ".$this->DB_FORM_NAME." SET ".$line." WHERE UID = '".$UID."' AND Username = '".$username."'");
		
		if (!$result)
		{
			mysql_free_result($result);
		   die ("[updateMultiData]Could not query the database: <br />". mysql_error(  ));
		}
	    else
		{
			mysql_free_result($result);
			return true;	
		}
}

//==========================
//  	update LastLoginIP
//==========================
function updateIP($UID,$username,$IP)
{
		$result = mysql_query("UPDATE ".$this->DB_FORM_NAME." SET LastLoginIP = '".$IP."' WHERE UID = '".$UID."' AND Username = '".$username."'");
		
		if (!$result)
		{
			mysql_free_result($result);
		   die ("[updateIP]Could not query the database: <br />". mysql_error(  ));
		}
	    else
		{
			mysql_free_result($result);
			return true;	
		}
}
function addDate($UID,$username,$column)
{	$date = date('Y-m-d H:i:s');
	$result = mysql_query("UPDATE ".$this->DB_FORM_NAME." SET ".$column." = '".$date."' WHERE UID = '".$UID."' AND Username = '".$username."'");
	
		if (!$result)
		{
			mysql_free_result($result);
		   die ("[addDate]Could not query the database: <br />". mysql_error(  ));
		}
	    else
		{
			mysql_free_result($result);
			return true;	
		}
}
function insertData($columns,$datas)
{

	$query = "INSERT INTO ".$this->DB_FORM_NAME." ".$columns."
		VALUES ".$datas;
		$result = mysql_query($query);
		
		if (!$result)
		{
			mysql_free_result($result);
		   die ("[insertData]Could not query the database: <br />". mysql_error(  ));
		}
	    else
		{
			mysql_free_result($result);
			return true;	
		}
}

function addLog($UID,$username,$IP,$method,$result,$reason)
{	

	$date = date('Y-m-d H:i:s');
	$columns = "(Time,Username,UID,IP,Method,Result,Reason)";
	$datas   = "('".$date."','".$username."','".$UID."','".$IP."','".$method."','".$result."','".$reason."')";
	
	$query = "INSERT INTO ".$this->DB_FORM_NAME_LOG." ".$columns."
		VALUES ".$datas;
		$result = mysql_query($query);
		
		if (!$result)
		{
			mysql_free_result($result);
		   die ("[addLog]Could not query the database: <br />". mysql_error(  ));
		}
	    else
		{
			mysql_free_result($result);
			return true;	
		}
	
}

//========================================= TODO: Make the website safer

//=========================================================== [important] Database Security
function databaseSecurity()
{
	$ip=$_SERVER['REMOTE_ADDR'];
	$timeStamp_now = time();
	$timeStamp_past = "";
	$flag = "";
	$count = "";
	
	if($this->isIPExist($ip))
	{
		$timeStamp_past=$this->getSecurityData("timeStamp",$ip);
		$time = $timeStamp_now - $timeStamp_past;
		$flag =$this->getSecurityData("flag",$ip);
		$count =$this->getSecurityData("count",$ip);
		
		if (($flag=="count")&($time>=30)&($count>=30))
		{
			//------------------------------- cool down
			$flag = "coolDown";
			$timeStamp_past = $timeStamp_now;
			$count = 0; 	
			
			$this->updateSecurityData($ip,$flag,$timeStamp_past,$count);	
				// redrect to error.php
			include("path.php");
			$this->close();
			$errorMsg = "coolDown";
			header("Location: ".$FILE_PATH.$ERROR_PATH."?errorMsg=".$errorMsg);
			// make sure following lines will not be executed
			exit;
		}
		else if (($flag=="coolDown")&($time>=30))
		{
				//------------------------------- cool down
			$flag = "count";
			$timeStamp_past = $timeStamp_now;
			$count = $count + 1;
			$this->updateSecurityData($ip,$flag,$timeStamp_past,$count);
				
			
			
			
			
		}
	}
	else
	{
		
		$this->insertSecurityData($columns,$datas);
	}
	
}

//==========================
//   check if $data is in $column, returns boolean
//==========================
function isIPExist($column,$data)
{

		$result = mysql_query("SELECT ".$column." FROM ".$this->DB_FORM_NAME_SECURITY);
		
		if (!$result)
		{
		   die ("[isExist]Could not query the database: <br />". mysql_error(  ));
		}
	
		while ($result_row = mysql_fetch_row($result))
		{
      		 	$result_row[0];
				
				if ($result_row[0]==$data)
				
				{
					
					return true;
				}
		}
		
		return false;
}
function insertSecurityData($columns,$datas)
{

	$query = "INSERT INTO ".$this->DB_FORM_NAME_SECURITY." ".$columns."
		VALUES ".$datas;
		$result = mysql_query($query);
		
		if (!$result)
		{
			mysql_free_result($result);
		   die ("[insertData]Could not query the database: <br />". mysql_error(  ));
		}
	    else
		{
			mysql_free_result($result);
			return true;	
		}
}
//==========================
//  	get data
//==========================
function getSecurityData($column,$ip){
		$result = mysql_query("SELECT ".$column." FROM ".$this->DB_FORM_NAME_SECURITY." WHERE ip = '".$ip,"'");
		if (!$result)
		{
		   die ("[getData]Could not query the database: <br />". mysql_error(  ));
		}

		$result_row = mysql_fetch_array($result);
		mysql_free_result($result);
		return $result_row[0];
}
//==========================
//  	update data
//==========================
function updateSecurityData($ip,$flag,$timeStamp_past,$count)
{
		$result = mysql_query("UPDATE ".$this->DB_FORM_NAME_SECURITY." SET flag = '".$flag."' timeStamp = '".$timeStamp_past."' count = '".$count."' WHERE ip = '".$ip);
		
		if (!$result)
		{
			mysql_free_result($result);
		   die ("[updateData]Could not query the database: <br />". mysql_error(  ));
		}
	    else
		{
			mysql_free_result($result);
			return true;	
		}
}

//==========================
//  	is application locked
//==========================
function isLocked($uid,$username)
{
	$arrivalTime = $this->getData($uid,$username,"ArrivalTime");
	
	if ($arrivalTime=="")
	{
		return false;
	}
	
	//print("ArrivalTime:".$arrivalTime."</br>");
	
	$year=((int)substr($arrivalTime,0,4));//Get Year
	
	$month=((int)substr($arrivalTime,5,2));// Get Month 
	
	$day=((int)substr($arrivalTime,8,2));// Get Day 
	
	$hour=((int)substr($arrivalTime,11,2));// Get hour
	
	$min=((int)substr($arrivalTime,14,2));// Get minute
	
	$a=(substr($arrivalTime,17,2));// Get AM/PM
	
	if ($a=="PM")
	{
		$min = $min + 12;
	}
	$arrivalTimeStamp = mktime($hour,$min,0,$month,$day,$year); 
	//echo $arrivalTimeStamp;
	//echo "</br>";
	//=======================================
	$currentTimeStamp = time();
	$currentTime = date("Y-m-d h:i A",$currentTimeStamp);
	//print("currentTime:".$currentTime."</br>");
	//echo time();
	//=======================================
	//echo "</br>";
	$result =     $arrivalTimeStamp - $currentTimeStamp;
	// for 72 hours
	if ($result<=259200)
	{
		//echo "result:".$result;
		//echo "</br>";
		//echo "islocked";
		return false;
	}
	else
	{
		//echo "result:".$result;
		//echo "</br>";
		//echo "isntlocked";
		return true;	
	}
}
}
?>
