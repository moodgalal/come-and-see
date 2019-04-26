<?php
$hn = "localhost";
	$db = "ecommerce";
	$un = "root";
	$pw = "";

	$object = mysqli_connect($hn , $un ,$pw,$db) ;
	if($object->connect_error) die ($object->connect_error);
    ?>