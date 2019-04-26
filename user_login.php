<?php require_once "functions/getShit.php";
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Come and See Online shop</title>
	<link rel="stylesheet" href="styles/style.css" type="text/css" media="all">
	<link rel="stylesheet" href="styles/normalize.css" type="text/css" media="all">
	<style>
		.login
		{
			height:300px;
			width: 500px;
			margin: auto;
			margin-top: 20px;
		}
		form form label
		{
			display: block;
			margin:5px
			color:#C6D6C4;
		}
		form input[type="email"],form input[type="password"]
		{
			width:50%;
			background-color:#4B5557;
			border:0;
			color:whitesmoke;
			padding:3px;
			margin-left: 5px;
		}
		::-webkit-input-placeholder{color:#8bb4c2}
		::-moz-placeholder{color:#8bb4c2}
		:-ms-input-placeholder{color:#8bb4c2}
		a{color:#191E22;}
		a :hover
		{
			text-decoration: none;
			color:#191E22;
		}
		form input[type="submit"]
		{
			border:0;
			padding:10px 20px ;
			background-color:#191E22;
			color:#fff;
		}
		 form input[type="submit"]:hover{color:#8bb4c2}
	</style>
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
		<div class="login" align="center">
			<form method="post" action="" enctype="multipart/form-data" id="loginForm">
					<label>Email</label><input type="email" name="email" title=""  style="margin-left:35px" placeholder="Enter your email" required autocomplete="off">
				<br><br>
				    <label>Password </label>
						<input type="password" name="password" title="" placeholder="Enter your password" required autocomplete="off">
				<br><br>
				  <a href="checkout.php?forgotpass" >Forgot your password?</a>
				<br><br>
				<input type="submit" value="Sign in" name="signsubmit" title="">
				  or
				<a href="customerRegister.php" style="margin-left:10px">Register</a>
			</form>
		   <?php
			   global $object;
		      if(isset($_POST['signsubmit']))
		      {
			     $userEmail = sanitizeInput($_POST['email']);
			      $userPass = $_POST['password'];
			     $getInfo = "SELECT * FROM customers WHERE user_email='$userEmail'";
			     $runInfo = $object->query($getInfo);
			      $infoNum = $runInfo->num_rows;
			      $getInfo = mysqli_fetch_array($runInfo);
			      $dbPass = $getInfo['user_pass'];
			      $dbEmail = $getInfo['user_email'];
			      $userIp = getUserIp();
			      $cart = "SELECT * FROM cart WHERE ip_address = '$userIp'";
			      $runCart = $object->query($cart);
			      $cartItems = $runCart->num_rows;

			      if($userEmail != $dbEmail || !password_verify($userPass ,$dbPass ) || $infoNum == 0)
			      {
				      echo "<script>alert('Email or password incorrect,Try again please')</script>";
				      echo "<script>window.open('user_login.php','_self')</script>";
			      }
		      else if($cartItems == 0)
			      {
				      $_SESSION['user_email'] = $userEmail;
				      echo "<script>alert('You logged in successfully')</script>";
				      echo "<script>window.open('index.php','_self')</script>";
			      }
		      else if($cartItems > 0)
			      {
				      $_SESSION['user_email'] = $userEmail;
				      echo "<script>alert('You logged in successfully')</script>";
				      echo "<script>window.open('cart.php','_self')</script>";
			      }
		      }
		   ?>
		</div>
	<footer>All copyrights&copy; reserved to Mahmoud Galal</footer>
</main>
</body>
</html>

