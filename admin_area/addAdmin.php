<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../styles/normalize.css" type="text/css" media="all">
	<style>
		#nav1
		{
			height:35px;
			background: #9e9e9e;
			color:#2c2c2c;
			padding:10px;
			font-weight: bold;
		}
		form
		{
			height:250px;
			width: 500px;
			margin: auto;
			margin-top: 30px;
		}
		form label
		{
			display: block;
			color:#2c2c2c;
			font-weight: bold;
		}
		form input[type="email"],form input[type="password"]
		{
			width:80%;
			background-color:#4B5557;
			border:0;
			color:whitesmoke;
			padding:10px;
			margin-left: 5px;
		}
		::-webkit-input-placeholder{color:#8bb4c2}
		::-moz-placeholder{color:#8bb4c2}
		:-ms-input-placeholder{color:#8bb4c2}
		form input[type="submit"]
		{
			border:0;
			padding:10px 20px ;
			background-color:#191E22;
			color:#fff;
			margin-left: 220px;
			margin-top:15px
		}
		form input[type="submit"]:hover{color:#007e36}
	</style>
</head>
<body>
<form method="post" action="addAdmin.php" enctype="multipart/form-data">
	<label>Add new Admin</label>
	<br> <br>
	<input type="email" name="email" title="" placeholder="Enter the Email" required>
	<br> <br>
	<input type="password" name="pass" title="" placeholder="Enter the Password" required>
<br>
	<input type="submit" value="Add" name="add" title="">
</form>
</body>
</html>
<?php
//	require_once "login.php";
	require_once "../functions/getShit.php";
	global $object;
	if(isset($_POST['add']))
	{
		$email = sanitizeInput($_POST['email']);
		$pass = $_POST['pass'];
		$pass = password_hash($pass , PASSWORD_DEFAULT);

		$register = "INSERT INTO admins (admin_email, admin_pass) VALUES ('$email' , '$pass')";
		$run = $object->query($register);

		if($run)
		{
			echo "<script>alert('The Admin has been Added successfully')</script>";
			echo "<script>window.open('index.php?viewProducts' , '_self')</script>";
		}
		else
			echo "<script>alert('Could\'nt Add the  New Admin , Try again please')</script>" ;

	}
?>