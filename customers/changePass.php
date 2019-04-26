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
		a{color:#191E22;}
		a :hover
		{
			text-decoration: none;
			color:#191E22;
		}
		.registerform input[type="submit"]
		{
			border:0;
			padding:10px 20px ;
			background-color:#191E22;
			color:#fff;
		}
		.registerform input[type="submit"]:hover{color:#8bb4c2}
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
				<ul>
					<li><a href="myAccount.php?myOrder">My Orders</a></li>
					<li><a href="editAccount.php">Edit Account</a></li>
					<li><a href="changePass.php">Change Password</a></li>
					<li><a href="deleteConfirm.php">Delete Account</a></li>
				</ul>
			</div>
		</aside>

		<div class="product_box">
			<br> <h3 style="margin-left: 4px">Change Your Password</h3> <br>
			<form class="registerform" enctype="multipart/form-data" method="post" action="changePass.php">
					<label>Current Password</label>
					<input type="password" name="old" placeholder="Enter Your old password">
					<label>Your New Password</label>
					<input type="password" name="new" placeholder="Enter Your new password">  <br>
					<input type="submit" name="updatePass" value="Change">
			</form>
		</div>
	</section>
	<footer>All copyrights&copy; reserved to Mahmoud Galal</footer>
</main>
</body>
</html>

<?php
	if(isset($_POST['updatePass']))
	{
		$getOld = "SELECT * FROM customers WHERE user_email='$user'";
		$runOld = $object->query($getOld);

		$fetchOld = mysqli_fetch_array($runOld);
		$oldPass = $fetchOld['user_pass'];
		$oldUserPass = $_POST['old'];

		if(!password_verify($oldUserPass , $oldPass))
		{
			echo "<script>alert('Incorrect password , Please enter the current password correctly')</script>";
			echo "<script>window.open('changePass.php' , '_self')";
		}
		else
		{
			$newUserPass = $_POST['new'];
			$newUserPass = password_hash($newUserPass , PASSWORD_DEFAULT);
			$updatePass = "UPDATE customers SET user_pass='$newUserPass' WHERE user_id='$userId'";
			$runUpdate = $object->query($updatePass);

			if(!empty( $runUpdate ))
			{
				echo "<script>alert('Password has been Updated Successfully')</script>";
				echo "<script>window.open('myAccount.php' , '_self')</script>";
			}
			else
			{	echo "<script>alert('Something went wrong , Try again please')</script>";
				echo "<script>window.open('changePass.php' , '_self')</script>";
			}
		}
	}
	?>