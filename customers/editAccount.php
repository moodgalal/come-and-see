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

					$userName = $fetchUser['user_name'];
					$userImage = $fetchUser['customer_image'];
					echo "<h3 style='margin-top:3px; text-transform:capitalize;color: #2c2c2c'>$userName</h3>";
					echo "<img src='customer_images/$userImage' width='200px' height='200px' style='border-radius: 50%;margin: 5px;'>";
				?>
			</div>
		</aside>

		<div class="product_box">
			<?php
				global $object;
				$user = $_SESSION['user_email'];
				$getUser = "SELECT * FROM customers WHERE user_email='$user'";
				$runUser = $object->query($getUser);
				$fetchUser = mysqli_fetch_array($runUser);

				$userId = $fetchUser['user_id'];
				$userCountry = $fetchUser['user_country'];
				$userContact = $fetchUser['customer_contact'];
				echo <<<END
		<br> <h3 style="margin-left: 4px">Edit Your Information</h3> <br>
		<form class="registerform" method="post" action="editAccount.php" enctype="multipart/form-data">
			<label>Your Name</label>
			<input type="text" name="name" placeholder="Enter Your Name" value="$userName"> <br>
			<label>Your Country</label> <br>
			<input type="text" name="country" value="$userCountry"> <br>
			<label>Your Phone</label>
			<input type="text" name="phone" placeholder="Enter Your phone with the country key" value="$userContact">  <br>
			<label>Your image</label>
			<input type="file" name="image" value="$userImage">
			 <img src="customer_images/$userImage" width="50" height="50"><br><br>
			<input type="submit" name="Update" value="Update" style=" margin:5px 0 5px 400px">

		</form>
END;
			?>
		</div>
	</section>
	<footer>All copyrights&copy; reserved to Mahmoud Galal</footer>
</main>
</body>
</html>

<?php
	if(isset($_POST['Update']))
	{
	  $c_name = sanitizeInput($_POST['name']);
		$c_country = sanitizeInput($_POST['country']);
		$c_phone = sanitizeInput($_POST['phone']) ;
		$c_image_tmp = $_FILES['image']['tmp_name'];
		$c_image = $_FILES['image']['name'];
		$update = "UPDATE customers SET user_name='$c_name', user_country='$c_country', customer_contact='$c_phone'
, customer_image='$c_image' WHERE user_id='$userId'";

		$runUpdate = $object->query($update);
		if($runUpdate)
		{
			move_uploaded_file($c_image_tmp , "customer_images/$c_image");
			echo "<script>alert('The data has been updated')</script>";
			echo "<script>window.open('myAccount.php','_self')</script>";
		}

		else
		{
			echo "<script>alert('Try again please')</script>";
			echo "<script>window.open('editAccount.php','_self')</script>";
		}
	}
	?>