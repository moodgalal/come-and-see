<?php
  session_start();
	session_destroy();
	
	echo "<Script>window.open('index.php','_self')</script>";