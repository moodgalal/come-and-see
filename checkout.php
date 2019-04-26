<?php
	require_once "functions/getShit.php";
	session_start();
		     if(!isset( $_SESSION['user_email']))
			     include 'user_login.php';
			   else
			     include 'payment.php';
		   ?>