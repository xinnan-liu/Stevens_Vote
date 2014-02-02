<?php
include("conn.php");

if (!isset($_POST['time']) {
	exit();
}

set_time_limit(0);
$temp=new Vote();
$i = 0;
/*
while (true) {
	sleep(1);
	$i=80;

	
		
		exit();
}

*/
$temp->acquire_main();
?>