<?php

Class Vote
{
  		public $id;
  		private $name;
  		private $intro;
  		private $sq;
  		private $hasStarted;
  		private $category;
  		private $subCategory;
  		private $artist;
  		private $star_1;
  		private $star_2;
  		private $star_3;
  		private $star_4;
  		private $star_5;
  		
  		/*构造anyway...*/
  		function _construct()
  		{

  		}

  		/*数据库连接*/
  		/************
  		上传服务器后sitcssa.com更换localhost
  		*************/
  		function connect()
  		{
			$link = mysql_connect("localhost", "relidinc_admin", "babyface28");
			$db = mysql_select_db("relidinc_sitcssa");
			mysql_query("set names utf8", $link);
			if (mysqli_connect_errno($link))
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			#echo "hello world!";
  		}

  		/*获取主要数据*/
  		function acquire_main()
  		{	
  			$this->connect();
			$result=mysql_query("Select * from vote");
			$arr = array();
			while($row=mysql_fetch_array($result))
			{
				$this->id    = $row['id'];
				$this->name  = $row['name'];
				$this->intro =$row['intro'];
				$this->sq    =$row['sq'];
				$this->category=$row['category'];
				$arr[]       =(array($this->id,$this->name,$this->intro,$this->sq,$this->category));
			}
			echo(json_encode($arr));	
  		}

  		/*获取全部数据*/
  		function acquire_all()
  		{
  			$this->connect();
			$result=mysql_query("Select * from vote_program");
			$arr = array();
			while($row=mysql_fetch_array($result))
			{
				$this->id          = $row['id'];
				$this->name        = $row['name'];
				$this->intro       =$row['intro'];
				$this->sq          =$row['sq'];
				$this->category    =$row['category'];
				$this->hasStarted  =$row['hasStarted'];
				$this->subCategory =$row['subCategory'];
				$this->artist      =$row['artist'];
				$this->star_1      =$row['star_1'];
				$this->star_2      =$row['star_2'];
				$this->star_3      =$row['star_3'];
				$this->star_4      =$row['star_4'];
				$this->star_5      =$row['star_5'];
				$arr[]             =(array($this->id,$this->name,$this->intro,$this->sq,$this->category,$this->hasStarted,
				$this->subCategory,$this->artist,$this->star_1,$this->star_2,$this->star_3,$this->star_4,$this->star_5));
			}
			echo(json_encode($arr));
  		}

}
?>