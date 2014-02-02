<?php

include("conn.php");

class Temp extends Vote{



	function temp()
	{
		$this->id="test";
		echo $this->id; 
	}
}