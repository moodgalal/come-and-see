<?php require_once "functions/getShit.php";
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Come and See Online shop</title>
	<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
	<link rel="stylesheet" href="styles/normalize.css" type="text/css" media="all">
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
		<article>Welcome to your Shopping Cart- &nbsp;<span style="color: #DDD">Total Items: <?php countCartItems();?> &nbsp;&nbsp;| Total Price: <?php cartPrice();?> </span> &nbsp;&nbsp; | <a href="cart.php" style="text-decoration: none; color:#5683e6;">Go to Cart</a> |

			<?php
				if(!isset($_SESSION['user_email']))
					echo "<a href='user_login.php' style=\"text-decoration: none; color:whitesmoke;margin-left: 3px;\">Login</a>";
				else
					echo "<a href='logout.php' style=\"text-decoration: none; color:whitesmoke; margin-left: 3px;\">Logout</a>";
			?>
		</article>
	</nav>
	<section id="main_section">
		<aside>
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
			<?php getSearchedProducts();?>
		</div>
	</section>
	<footer>All copyrights&copy; reserved to Mahmoud Galal</footer>
</main>
</body>
</html>

