<?php

 $link = mysql_connect("localhost", "relidinc_admin", "babyface28");
        $db = mysql_select_db("relidinc_sitcssa");
        mysql_query("set names utf8", $link);
if (mysqli_connect_errno($link))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  //echo "Successful ";
?>