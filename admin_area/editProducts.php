<?php require_once 'login.php';
	global $object;
	if(isset($_GET['edit_pro'])){
	$proId = $_GET['edit_pro'];
	$getProduct = "SELECT * FROM products WHERE product_id='$proId'";
	$runP = $object->query($getProduct);
	$productRow = mysqli_fetch_array($runP);
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
	}
  global $productId;global $productTitle;global $productCategory;global $productBrand;global $productPrice;global $productDescription;global $productImage;global $productKeys;global $pCatTitle;global $pBrandTitle;
?>
	<!DOCTYPE html>
	<html lang="en" xmlns="http://www.w3.org/1999/html">
	<head>
		<meta charset="utf-8">
		<title>Edit product</title>
		<link href="../styles/add_products_style.css" rel="stylesheet" type="text/css">
		<link href="../styles/normalize.css" rel="stylesheet" type="text/css">
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>  <!-- A text area that is pre made -->
		<script>tinymce.init({ selector:'textarea' });</script>
		<style>
		</style>
	</head>
	<body>
	<form action="" method="post" enctype="multipart/form-data">
		<h3>Updating the Product</h3>
		<table>
			<tr>
				<td><label>Product Title</label></td>
				<td><input type="text" title="Product title" name="productTitle" value="<?php echo $productTitle?>"></td>
			</tr>
			<tr>
				<td><label>Product Category</label></td>
				<td>
					<select title="Select a category" name="productCategory" >
						<option value="<?php echo $productCategory?>">Selected: <?php echo $pCatTitle?></option>
						<?php
							$get_cat = "Select * from categories";
							$run_cat = $object->query($get_cat );
							if($object->error) die ($object->error);
							while($cat_rows = mysqli_fetch_array($run_cat))
							{
								$cat_id = $cat_rows['cat_id'];
								$cat_title = $cat_rows['cat_title'];
								echo "<option value='$cat_id'>$cat_title</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Product Brand</label> </td>
				<td>
					<select title="Select a brand" name="productBrand" required>
						<option value="<?php echo $productBrand?>">Selected: <?php echo $pBrandTitle?></option>
						<?php
							global $object;
							$get_brands = "Select * from brands";
							$run_brands = mysqli_query($object ,$get_brands );
							if($object->error) die ($object->error);
							while($brands_rows = mysqli_fetch_array($run_brands))
							{
								$brands_id = $brands_rows['brand_id'];
								$brands_title = $brands_rows['brand_title'];
								echo "<option value='$brands_id'>$brands_title</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Product Image</label></td>
				<td><input type="file" title="" name="productImage" required>
				<img src="uploaded_products_images/<?php echo $productImage?>" height="50" width="50">

					<label><?php echo $productImage?></label>
				</td>
			</tr>
			<tr>
				<td><label>Product Description</label> </td>
				<td><textarea name="productDescription" title="" cols="70" rows="10"><?php echo $productDescription?></textarea></td> <!-- We can't add required at the text area field -->
			</tr>
			<tr>
				<td><label>Product Price</label></td>
				<td><input type="text" title="" name="productPrice" value="<?php echo $productPrice?>"></td>
			</tr>
			<tr>
				<td><label>Product keyword</label></td>
				<td><input type="text" title="" name="productKeyword" value="<?php echo $productKeys?>"></td>
			</tr>
		</table>
		<input type="submit" name="update_products" value="Update Product">
	</form>
	</body>
	</html>
<?php
	if(isset($_POST['update_products']))
	{
		$pTitle = $_POST['productTitle'];
		$pCategory = $_POST['productCategory'];
		$pBrand = $_POST['productBrand'];
		$pImage = $_FILES['productImage']['name']; // When we insert a file we extract it form the _FILE array mot POST or GET
		$pImage_tmp = $_FILES['productImage']['tmp_name'];
		$pDescription = $_POST['productDescription'];
		$pPrice = $_POST['productPrice'];
		$pKeyword = $_POST['productKeyword'];

		$updatingProduct = "UPDATE products SET product_cat= '$pCategory', product_brand='$pBrand', product_title='$pTitle', product_price='$pPrice',product_description='$pDescription', product_image='$pImage', product_keyword='$pKeyword' WHERE product_id='$proId' ";
		$runProduct = $object->query($updatingProduct);

		if($runProduct)
		{
			move_uploaded_file($pImage_tmp ,"uploaded_products_images/$pImage" ); // Move the uploaded photos to the project folder to be used again when displaying the products
			echo "<script>alert('The product had been Updated successfully')</script>";
			echo "<script>window.open('index.php?viewProducts' , '_self')</script>";
		}
		else
			echo "<script>alert('Could\'nt Update the product , Try again please')</script>" ;
	}
?>