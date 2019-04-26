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
		form input[type="text"]
		{
			width:80%;
			background-color:#4B5557;
			border:0;
			color:whitesmoke;
			padding:3px;
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
			margin-left: 160px;
			margin-top:15px
		}
		form input[type="submit"]:hover{color:#007e36}
	</style>
</head>
<body>

<form method="post" action="addBrand.php" enctype="multipart/form-data">
	<label>Add new Brand</label>
	<br>
	<input type="text" name="newBrand" title="" placeholder="Enter the Brand name" required>
	<br>
	<input type="submit" value="Add" name="Add" title="">
</form>
</body>
</html>
<?php
	require_once "login.php";
	global $object;
	if(isset($_POST['Add']))  // Be careful with the index (case sensitive)
	{
		$newBrand = $_POST['newBrand'];
		$add = "INSERT INTO `brands` (`brand_title`) VALUES ('$newBrand')";
		$runAdd = $object->query($add);

		if($runAdd)
		{
			echo "<script>alert('The Brand had been Added successfully')</script>";
			echo "<script>window.open('index.php?viewBrand' , '_self')</script>";
		}
		else
			echo "<script>alert('Could\'nt Add the Brand , Try again please')</script>" ;
	}
?>