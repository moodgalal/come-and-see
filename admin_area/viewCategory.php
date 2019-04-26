<?php
	require_once "login.php";
	global $object;
?>
	<!DOCTYPE html>
	<html>
	<head>
		<link href="../styles/normalize.css" rel="stylesheet" type="text/css">

		<style>
			h3
			{
				margin: 10px;
				color:#2c2c2c;
			}
			table {margin-top: 2px;}
			th{color: #007e36; font-weight: 600 }
			table ,tr,td,th
			{
				align-content: center;
				border:1px solid #007e36;
				padding: 10px;
				text-align: center;
			}
			td{font-weight: 500}
			a
			{
				text-decoration: none;
				color:#2c2c2c;
				font-weight: bold;
			}
			a:hover
			{
				text-decoration: none;
				color:#007e36;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
	<h3 align="center">All Categories</h3>
	<table>
		<tr>
			<th>Category Id</th>
			<th>Category Title</th>
		</tr>
		<?php
			$getCats = "SELECT * FROM categories";
			$runCats = $object->query($getCats);
			while($catRow = mysqli_fetch_array($runCats))
			{
				$catId = $catRow['cat_id'];
				$catTitle = $catRow['cat_title'];

				echo <<<END
<tr>
<td>#$catId</td>
<td>$catTitle</td>
<td><a href="viewCategory.php?delete_cat=$catId">Delete</a></td>
<td><a href="index.php?edit_cat=$catId">Edit</a></td>
 </tr>
END;
			}
		?>
	</table>
	</body>
	</html>
<?php
	if(isset($_GET['delete_cat']))
	{
		$delete_id = $_GET['delete_cat'];
		$delete = "DELETE FROM categories WHERE cat_id='$delete_id'";
		$runDelete = $object->query($delete);

		if($runDelete)
		{
			echo "<script>alert('The product has been deleted successfully')</script>";
			echo "<script>window.open('index.php?viewCategory' , '_self')</script>";
		}
		else
			echo "<script>alert('Could\'nt delete the product')</script>" ;
	}
?>