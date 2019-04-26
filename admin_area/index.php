<?php
	session_start();
	if(!isset($_SESSION['admin_email']))
	{
		echo "<script>alert('Restricted area, Are you an admin?')</script>";
		echo "<script>window.open('admin_login.php','_self')</script>";
	}
	else
	{
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Admin Panel</title>
	<link rel="stylesheet" href="../styles/Astyle.css" type="text/css" media="all">
	<link rel="stylesheet" href="../styles/normalize.css" type="text/css" media="all">

</head>

<body>
<header>
	<div class="adminAreaHeader"><span>Welcome to the Admin Panel</span></div>
</header>
 <nav id="nav1">
	 <?php
		 if(isset( $_SESSION['admin_email'] ))
		 {
			 $email = $_SESSION['admin_email'];
			 echo "<p>Admin $email is <span style='color: #007e36'>logged in</span></p>";
		 }
	?>
 </nav>
<main class="container">
	<section id="main_section">
		<aside>
			<div class="category">
				<h2>Functions</h2>
				<ul>
					<li><a href="index.php?newProduct">Insert new product</a></li>
					<li><a href="index.php?viewProducts">View all products</a></li>
					<li><a href="index.php?newCategory">Insert a new category</a></li>
					<li><a href="index.php?viewCategory">View all categories</a></li>
					<li><a href="index.php?newBrand">Insert new brand</a></li>
					<li><a href="index.php?viewBrand">View all brands</a></li>
					<li><a href="index.php?viewCustomers">View all customers</a></li>
					<li><a href="index.php?viewOrders">View all orders</a></li>
					<li><a href="index.php?viewPayment">View payments</a></li>
					<li><a href="index.php?addAdmin">Add Another Admin</a></li>
					<li><a href="admin_logout.php">Admin logout</a></li>
				</ul>
			</div>
		</aside>
		<div class="product_box">
			<?php
				if(isset($_GET['newProduct']))
				{
				   include_once "add_products.php";
				}
				else if(isset($_GET['viewProducts']))
				{
				  include_once "viewProducts.php";
				}
				else if(isset($_GET['edit_pro']))
				{
					include_once "editProducts.php";
				}
				else if(isset($_GET['newCategory']))
				{
					include_once "addCategory.php";
				}
				else if(isset($_GET['viewCategory']))
				{
					include_once "viewCategory.php";
				}
				else if(isset($_GET['edit_cat']))
				{
					include_once "editCategory.php";
				}
				else if(isset($_GET['newBrand']))
				{
					include_once "addBrand.php";
				}
				else if(isset($_GET['viewBrand']))
				{
					include_once "viewBrand.php";
				}
				else if(isset($_GET['edit_brand']))
				{
					include_once "editBrand.php";
				}
				else if(isset($_GET['viewCustomers']))
				{
					include_once "viewCustomers.php";
				}
				else if(isset( $_GET['addAdmin'] ))
				{
					include_once "addAdmin.php";
				}
	?>
		</div>
	</section>
</main>
<footer>All copyrights&copy; reserved to Mahmoud Galal</footer>
</body>
</html>
<?php } ?>