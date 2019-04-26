<?php
	require_once "login.php";
	global $object;
?>
<!DOCTYPE html>
<html>
<head>
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
		padding: 5px;
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
<h3 align="center">All We Have</h3>
<table>
	<tr>
		<th>Product Id</th>
		<th>P. Title</th>
		<th>P. Category</th>
		<th>P. Brand</th>
		<th>P. Price</th>
		<th>P. Description</th>
		<th>P. Image</th>
		<th>P. Keywords</th>
	</tr>
<?php
	 $getProducts = "SELECT * FROM products";
	$runProducts = $object->query($getProducts);
	while($productRow = mysqli_fetch_array($runProducts))
	{
		$productId = $productRow['product_id'];
		$productTitle = $productRow['product_title'];
		$productCategory = $productRow['product_cat'];
		$productBrand = $productRow['product_brand'];
		$productPrice = $productRow['product_price'];
		$productDescription = $productRow['product_description'];
		$productImage = $productRow['product_image'];
		$productKeys = $productRow['product_keyword'];

		$getCat = "SELECT cat_title FROM categories WHERE cat_id='$productCategory'";
		$runCat = $object->query($getCat);
		$fetchCat = mysqli_fetch_array($runCat);
		 $pCatTitle = $fetchCat['cat_title'];

		$getBrand = "SELECT brand_title FROM brands WHERE brand_id='$productBrand'";
		$runBrand = $object->query($getBrand);
		$fetchBrand = mysqli_fetch_array($runBrand);
		$pBrandTitle = $fetchBrand['brand_title'];
		echo <<<END
<tr>
<td>#$productId</td>
<td>$productTitle</td>
<td>$pCatTitle</td>
<td>$pBrandTitle</td>
<td>$$productPrice</td>
<td>$productDescription</td>
<td><img src="uploaded_products_images/$productImage" width="50" height="50"></td>
<td>$productKeys</td>
<td><a href="viewProducts.php?delete=$productId">Delete</a></td>
<td><a href="index.php?edit_pro=$productId">Edit</a></td>
 </tr>
END;
	}
?>
	</table>
</body>
</html>
 <?php
	 if(isset($_GET['delete']))
	 {
		$delete_id = $_GET['delete'];
		 $delete = "DELETE FROM products WHERE product_id='$delete_id'";
		 $runDelete = $object->query($delete);

		 if($runDelete)
		 {
			 echo "<script>alert('The product has been deleted successfully')</script>";
			 echo "<script>window.open('index.php?viewProducts' , '_self')</script>";
		 }
		 else
			 echo "<script>alert('Could\'nt delete the product')</script>" ;
	 }
	?>