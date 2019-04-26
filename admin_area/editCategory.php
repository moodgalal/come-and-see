<?php require_once 'login.php';
	global $object;
   $catId = $_GET['edit_cat'];
	$getCat = "SELECT * FROM categories WHERE cat_id='$catId'";
	$runCat = $object->query($getCat);
	$fetchCat = mysqli_fetch_array($runCat);

	$cat_Title = $fetchCat['cat_title'];
	 global $cat_Title;
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Edit Category</title>
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
				width:100%;
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
				margin-left: 220px;
				margin-top:15px
			}
			form input[type="submit"]:hover{color:#007e36}
		</style>
		
	</head>
	<body>

	<form action="" method="post" enctype="multipart/form-data">
		<h3>Updating the Category</h3> <br>
		<table>
			<tr>
				<td><label>Category Title</label></td>
				<td><input type="text" title="" name="catTitle" value="<?php echo $cat_Title?>"></td>
			</tr>
		</table>
		<input type="submit" name="update_cat" value="Update Category">
	</form>
	</body>
	</html>
<?php
	if(isset($_POST['update_cat']))
	{
		$catTitle = $_POST['catTitle'];
		$updatingCat = "UPDATE categories SET cat_title= '$catTitle' WHERE cat_id='$catId' ";
		$runCat = $object->query($updatingCat);

		if($runCat)
		{
			echo "<script>alert('The Category has been Updated successfully')</script>";
			echo "<script>window.open('index.php?viewCategory' , '_self')</script>";
		}
		else
			echo "<script>alert('Could\'nt Update the Category , Try again please')</script>" ;
	}
?>