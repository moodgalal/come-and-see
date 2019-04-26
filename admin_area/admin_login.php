<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Admin Login</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="../styles/Alogin.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
	<style>
	</style>
</head>

<body>
<div class="login">
	<h1>Admin Login</h1>
	<form method="post" action="admin_login.php" enctype="multipart/form-data">
		<input type="Email" name="email" placeholder="Enter Your Email" required="required"  />
		<input type="password" name="pass" placeholder="Enter Your Password" required="required" />
		<button type="submit" class="btn btn-primary btn-block btn-large" name="signIn">Login</button>
	</form>
</div>
<script src="js/index.js"></script>
</body>
</html>

<?php
	require_once "login.php";
	require_once "../functions/getShit.php";
	global $object;
	if(isset($_POST['signIn']))
	{
		$userEmail = sanitizeInput($_POST['email']);
		$userPass = $_POST['pass'];
		$getInfo = "SELECT * FROM admins WHERE admin_email='$userEmail'";
		$runInfo = $object->query($getInfo);
		$infoNum = $runInfo->num_rows;
		$getInfo = mysqli_fetch_array($runInfo);
		$dbPass = $getInfo['admin_pass'];
		$dbEmail = $getInfo['admin_email'];
		if ($userEmail != $dbEmail || !password_verify($userPass , $dbPass) || $infoNum == 0) {
			echo "<script>alert('Email or password incorrect,Try again please')</script>";
			echo "<script>window.open('admin_login.php','_self')</script>";
		}
		else
		{
			session_start();
			$_SESSION['admin_email'] = $userEmail;
			echo "<script>alert('Welcome, Sir')</script>";
			echo "<script>window.open('index.php','_self')</script>";
		}
	}
?>