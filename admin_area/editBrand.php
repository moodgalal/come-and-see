<?php require_once 'login.php';
	global $object;
	$brandId = $_GET['edit_brand'];
	$getBrand = "SELECT * FROM brands WHERE brand_id='$brandId'";
	$runBrand = $object->query($getBrand);
	$fetchBrand = mysqli_fetch_array($runBrand);

	$brand_Title = $fetchBrand['brand_title'];
	global $brand_Title;
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Edit Brand</title>
		<link href="../styles/normalize.css" rel="stylesheet" type="text/css">
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

	<form action="" method="post" enctype="multipart/form-data">
		<h3>Updating the Brand</h3><br>
		<table>
			<tr>
				<td><label>Brand Title</label></td>
				<td><input type="text" title="" name="brandTitle" value="<?php echo $brand_Title?>"></td>
			</tr>
		</table>
		<input type="submit" name="update_brand" value="Update Brand">
	</form>
	</body>
	</html>
<?php
	if(isset($_POST['update_brand']))
	{
		$brandTitle = $_POST['brandTitle'];
		$updatingCat = "UPDATE brands SET brand_title= '$brandTitle' WHERE brand_id='$brandId' ";
		$runCat = $object->query($updatingCat);

		if($runCat)
		{
			echo "<script>alert('The Brand has been Updated successfully')</script>";
			echo "<script>window.open('index.php?viewBrand' , '_self')</script>";
		}
		else
			echo "<script>alert('Could\'nt Update the Brand , Try again please')</script>" ;
	}
?>