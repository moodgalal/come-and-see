<?php require_once 'login.php' ?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="utf-8">
	<title>Add products</title>
	<link href="../styles/add_products_style.css" rel="stylesheet" type="text/css">
	<link href="../styles/normalize.css">
	<link rel="stylesheet" href="../styles/Astyle.css" type="text/css" media="all">
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>  <!-- A text area that is pre made -->
	<script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
  <form action="add_products.php" method="post" enctype="multipart/form-data">
	  <h3>Insert a new product</h3>
	  <table>
		 <tr>
			 <td><label>Product Title</label></td>
			 <td><input type="text" title="Product title" name="productTitle" required></td>
		 </tr>
		  <tr>
			  <td><label>Product Category</label></td>
			  <td>
				  <select title="Select a category" name="productCategory" required>
					  <option></option>
					  <?php
						  global $object;
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
					  <option></option>
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
			 <td><input type="file" title="" name="productImage" required> </td>
		 </tr>
		  <tr>
			  <td><label>Product Description</label> </td>
			  <td><textarea name="productDescription" title="" cols="70" rows="10"></textarea></td> <!-- We can't add required at the text area field -->
		  </tr>
		  <tr>
			  <td><label>Product Price</label></td>
		     <td><input type="text" title="" name="productPrice" required></td>
		  </tr>
		  <tr>
			  <td><label>Product keyword</label></td>
			  <td><input type="text" title="" name="productKeyword" required></td>
		  </tr>
	  </table>
	  <input type="submit" name="add_products" value="Add Product">
  </form>
</body>
</html>
<?php
	global $object;
  if(isset($_POST['add_products']))
	{
		$productTitle = $_POST['productTitle'];
		$productCategory = $_POST['productCategory'];
		$productBrand = $_POST['productBrand'];
		$productImage = $_FILES['productImage']['name']; // When we insert a file we extract it form the _FILE array mot POST or GET
		$productImage_tmp = $_FILES['productImage']['tmp_name'];
		$productDescription = $_POST['productDescription'];
		$productPrice = $_POST['productPrice'];
		$productKeyword = $_POST['productKeyword'];

		$insertProduct = "INSERT INTO `products` (`product_cat`, `product_brand`, `product_title`, `product_price`, `product_description`, `product_image`, `product_keyword`) 
            VALUES ('$productCategory','$productBrand','$productTitle','$productPrice','$productDescription','$productImage','$productKeyword')";

		$runProduct = $object->query($insertProduct);

		if(!$object->error)
		{
			move_uploaded_file($productImage_tmp ,"uploaded_products_images/$productImage" ); // Move the uploaded photos to the project folder to be used again when displaying the products
			echo "<script>alert('The product had been added successfully')</script>";
           echo "<script>window.open('index.php?newProduct' , '_self')</script>";
     	}
		else
		  echo "<script>alert('Could\'nt add the product')</script>" ;
	}
	?>