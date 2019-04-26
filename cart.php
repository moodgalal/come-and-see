<?php require_once "functions/getShit.php"; session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Come and See Online shop</title>
	<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
	<link rel="stylesheet" href="styles/normalize.css" type="text/css">
</head>

<body>
<header>
	<img src="images/3.jpg">
</header>
<main class="container">

	<nav id="nav1">
		<ul>
			<li><a href="index.php">Home</a></li>
			<?php if(isset($_SESSION['user_email']))echo"<li><a href='customers/myAccount.php'>My Account</a></li>";?>			
			<li><a href="customerRegister.php">SignUp</a></li>
			<li><a href="cart.php">Shopping Cart</a></li>
			<li><a href="contactUs.php">Contact Us</a></li>
		</ul>
		<form method="get" action="search.php" enctype="multipart/form-data" id="searchForm">
			<input type="text" name="user_value" placeholder="Search a product" required>
			<input type="submit" name="search" value="Search">
		</form>
	</nav>
	<nav id="nav2">
		<article>Welcome to your Shopping Cart- &nbsp;<span style="color: #DDD">Total Items: <?php countCartItems();?> &nbsp;&nbsp;| Total Price: <?php cartPrice();?> </span> &nbsp;&nbsp; | <a href="index.php" style="text-decoration: none; color:#5683e6;">Back to shop</a> |

			<?php
				if(!isset($_SESSION['user_email']))
					echo "<a href='user_login.php' style=\"text-decoration: none; color:whitesmoke;margin-left: 3px;\">Login</a>";
				else
					echo "<a href='logout.php' style=\"text-decoration: none; color:whitesmoke; margin-left: 3px;\">Logout</a>";
			?>
		</article>
	</nav>

	<section id="main_section">
		<?php addToCart();?>
		<aside style="height: auto">
			<div class="category">
				<h2>Categories</h2>
				<ul>
					<?php getCategories();?>
				</ul>
			</div>
			<div class="category">
				<h2>Brands</h2>
				<ul>
					<?php getBrands();?>
				</ul>
			</div>
		</aside>
		<div class="product_box">
			<form action="cart.php" method="post" enctype="multipart/form-data" id="cartForm" style="float: left">
			<table align="center" border="1px solid #000" width="700px" >
			  <tr align="center">
				  <th>Remove</th>
				  <th>Product(s)</th>
				  <th>Unit Price</th>
			  </tr>
			   <?php  showCartProducts(); ?>
			</table>
				<table align="center" border="1px solid #000" width="195px" style="float: right;">
					<tr align="center">
						<th style="font-weight: bold">Total Items</th>
						<th style="font-weight: bold">Total Cost</th>
					</tr>
					<tr align="center">
						<td style="font-weight: bold"><?php countCartItems(); ?></td>
						<td style="font-weight: bold"><?php cartPrice(); ?></td>
					</tr>
				</table>
				<button style="float: left;margin: 10px;background: none;padding:10px;background-color: #ddd;border:1px solid #3f3f33"><a href="checkout.php" style="text-decoration:none;color: #3f3f3f;font-weight:bold">Check Out</a></button>
				<input type="submit" value="Update Cart"  name="update" style="float:left;margin: 10px;background: none;padding:10px;color:#3f3f3f;border:1px solid #3f3f33;font-weight: bold">
				<button  style="float: left;border:1px solid #3f3f33;margin: 10px;background: none;padding:10px;color: #3f3f3f;font-weight:bold"><a href="index.php" style="color: #3f3f3f;font-weight:bold;text-decoration: none">Continue Shopping</a></button>
					</form>
			<?php update();?>
		</div>
	</section>
	<footer>All copyrights&copy; reserved to Mahmoud Galal</footer>
</main>
</body>
</html>