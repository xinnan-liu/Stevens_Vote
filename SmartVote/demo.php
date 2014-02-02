<?php
include("conn.php");

#echo "test!!!";
/*******************
*******************/

$test=new Vote();
$test->acquire_main();
//$test->acquire_all();

/******************
#$arr = array('asdf',"fds","asdfas");
#echo(json_encode($arr));

include("conn.php");
$sql= "Select * from vote";
$result=mysql_query($sql,$link);

$arr = array();
while($row=mysql_fetch_array($result))
{
	$arr[] = $row['name'];
}

echo(json_encode($arr));
******************/



//echo(json_encode($row=mysql_fetch_array($result)));
/*
$arr = array('asdf',"fds","asdfas");
echo "\n";
echo(json_encode($arr));

$count=mysql_num_rows($result);

echo $count;
echo "\n";


while($row=mysql_fetch_array($result))
{
echo(json_encode($row['name']));
echo "\n";
echo $row['name'];

}*/
?>
