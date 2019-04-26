<?php
	require_once "login.php";
	global $object;
?>
	<!DOCTYPE html>
	<html>
	<head>
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
	<h3 align="center">All Brands</h3>
	<table>
		<tr>
			<th>Brand Id</th>
			<th>Brand Title</th>
		</tr>
		<?php
			$getBrand = "SELECT * FROM brands";
			$runBrands = $object->query($getBrand);
			while($brandRow = mysqli_fetch_array($runBrands))
			{
				$brandId = $brandRow['brand_id'];
				$brandTitle = $brandRow['brand_title'];

				echo <<<END
<tr>
<td>#$brandId</td>
<td>$brandTitle</td>
<td><a href="viewBrand.php?delete_brand=$brandId">Delete</a></td>
<td><a href="index.php?edit_brand=$brandId">Edit</a></td>
 </tr>
END;
			}
		?>
	</table>
	</body>
	</html>
<?php
	if(isset($_GET['delete_brand']))
	{
		$delete_id = $_GET['delete_brand'];
		$delete = "DELETE FROM brands WHERE brand_id='$delete_id'";
		$runDelete = $object->query($delete);

		if($runDelete)
		{
			echo "<script>alert('The Brand has been deleted successfully')</script>";
			echo "<script>window.open('index.php?viewBrand' , '_self')</script>";
		}
		else
			echo "<script>alert('Could\'nt delete the Brand')</script>" ;
	}
?>