<?php require_once "../functions/getShit.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Come and See Online shop</title>
	<link rel="stylesheet" href="../styles/style.css" type="text/css" media="all">
	<link rel="stylesheet" href="../styles/normalize.css" type="text/css" media="all">

	<style>
		.registerform
		{
			margin-left: 8px;
		}
		.registerform  label
		{
			margin:5px
			color:#C6D6C4;
		}
		.registerform input[type="text"],[type="email"],form input[type="password"]
		{
			width:30%;
			background-color:#4B5557;
			border:0;
			color:whitesmoke;
			padding:3px;
			margin: 5px;
			display: block;
		}
		::-webkit-input-placeholder{color:#8bb4c2}
		::-moz-placeholder{color:#8bb4c2}
		:-ms-input-placeholder{color:#8bb4c2}
		.registerform button a{color:whitesmoke; text-decoration: none}
		.registerform button :hover
		{
			text-decoration: none;
			color:#8bb4c2;
		}
		.registerform input[type="submit"],.registerform button
		{
			border:0;
			padding:10px 20px ;
			background-color:#191E22;
			color:#fff;
		}
		.registerform input[type="submit"]:hover
		{color:#8bb4c2}
	</style>

</head>

<body>
<header>
	<img src="../images/3.jpg">
</header>
<main class="container">

	<nav id="nav1">
		<ul>
			<li><a href="../index.php">Home</a></li>
			<?php if(isset($_SESSION['user_email']))echo"<li><a href='../customers/myAccount.php'>My Account</a></li>"; ?>
			<li><a href="../customerRegister.php">SignUp</a></li>
			<li><a href="../cart.php">Shopping Cart</a></li>
			<li><a href="#">Contact Us</a></li>
		</ul>
		<form method="get" action="../search.php" enctype="multipart/form-data" id="searchForm">
			<input type="text" name="user_value" placeholder="Search a product" required>
			<input type="submit" name="search" value="Search">
		</form>
	</nav>
	<nav id="nav2">
		<article>Your Cart Info- &nbsp;<span style="color: #DDD">Total Items: <?php countCartItems()?>&nbsp;&nbsp;| Total Price: <?php cartPrice()?></span> &nbsp;&nbsp; | <a href="../cart.php" style="text-decoration: none; color:#5683e6;">Go to Cart</a> |<a href='../logout.php' style="text-decoration: none; color:whitesmoke; margin-left: 3px;">Logout</a></article>
	</nav>
	<section id="main_section">
		<aside style="float: right">
			<div class="category" align="center">
				<h2>My Account</h2>
				<?php
					global $object;
					$user = $_SESSION['user_email'];
					$getUser = "SELECT * FROM customers WHERE user_email='$user'";
					$runUser = $object->query($getUser);
					$fetchUser = mysqli_fetch_array($runUser);
					$userId = $fetchUser['user_id'];
					$userName = $fetchUser['user_name'];
					$userImage = $fetchUser['customer_image'];
					echo "<h3 style='margin-top:3px; text-transform:capitalize;color: #2c2c2c'>$userName</h3>";
					echo "<img src='customer_images/$userImage' width='200px' height='200px' style='border-radius: 50%;margin: 5px;'>";
				?>
			</div>
		</aside>

		<div class="product_box">
			<br> <h3 style="margin-left: 4px">Do you Want to Delete this Account? .. Make your choice Carefully !</h3> <br>
			<form class="registerform" method="post" action="deleteConfirm.php" enctype="multipart/form-data">
				<button><a href="myAccount.php" >Fuck that,Get me back</a></button>
				<input type="submit" name="deleteAccount" value="Hell YEAH">
			</form>
		</div>
	</section>
	<footer>All copyrights&copy; reserved to Mahmoud Galal</footer>
</main>
</body>
</html>

<?php
	if(isset($_POST['deleteAccount']))
	{
		$deleteAccount = "DELETE FROM customers WHERE user_id='$userId'";
		$runDelete = $object->query($deleteAccount);

		if($runDelete)
		{
			echo "<script>alert('Your account has been deleted successfully')</script>";
			echo "<script>window.open('../logout.php' , '_self')</script>";
		}
		else
		{
			echo "<script>alert('Something went wrong , Try again later')</script>";
			echo "<script>window.open('myAccount.php' , '_self')</script>";
		}
	}
	?>