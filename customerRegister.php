<?php require_once "functions/getShit.php"; session_start()?>
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
			width: 550px;
			margin:10px 100px;
		}
		.registerform  label
		{
			display: block;
			margin:5px
			color:#C6D6C4;
		}
		 .registerform input[type="text"],[type="email"],form input[type="password"]
		{
			width:60%;
			background-color:#4B5557;
			border:0;
			color:whitesmoke;
			padding:3px;
			margin: 5px;
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
	<img src="images/3.jpg">
</header>
<main class="container">

	<nav id="nav1">
		<ul>
			<li><a href="index.php">Home</a></li>
			<?php if(isset($_SESSION['user_email']))echo"<li><a href='customers/myAccount.php'>My Account</a></li>";?>
			<li><a href="customerRegister.php">SignUp</a></li>
			<li><a href="cart.php">Shopping Cart</a></li>
			<li><a href="#">Contact Us</a></li>
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
	<div class="login">
		<form class="registerform" method="post" action="customerRegister.php" enctype="multipart/form-data">
			<fieldset>
				<legend>Registration Form</legend>
			<label>Your Name</label>
			<input type="text" name="name" placeholder="Enter Your Name" required>
			<label>Your E-mail</label>
			<input type="email" name="email" placeholder="Enter Your E-mail" required>
			<label>Your Password</label>
			<input type="password" name="password" placeholder="Enter Your password" required>
			<label>Your Country</label>
			<select title="" name="country" required style="background-color: #4B5557; color: whitesmoke; margin-left: 5px">
				<option>          </option>
				<option>Egypt</option>
				<option> Saudi Arabia</option>
				<option>Palestine </option>
				<option>United Arab Emirates</option>
				<option>Lebanon</option>
				<option>Syria</option>
				<option>Jordan</option>
				<option> Yemen</option>
				<option>Bahrain</option>
				<option disabled>Qatar</option>
				<option>Libya </option>
				<option>Algeria</option>
				<option>Morocco</option>
				<option>Tunis</option>
				<option>Iraq</option>
				<option>Kuwait</option>
				<option>Oman</option>
			</select>
			<label>Your Phone</label>
			<input type="text" name="phone" placeholder="Enter Your phone with the country key" required>
			<label>Your image</label>
			<input type="file" name="image" required>
			</fieldset>
			<input type="submit" name="register" value="Register" style="float: right; margin:5px">

		</form>
	</div>
	<footer>All copyrights&copy; reserved to Mahmoud Galal</footer>
</main>
</body>
</html>

<?php
	global $object;
	if(isset( $_SESSION['user_email'] ))
	{
		echo "<script>alert('You already registered with us')</script>";
		echo "<script>window.open('customers/myAccount.php','_self')</script>";
	}
	else
	{
	if(isset($_POST['register']))
	{
		$user_ip = getUserIp();                        
		$user_name = sanitizeInput($_POST['name']);
		$in_password = $_POST['password'];
		$password = password_hash($in_password , PASSWORD_DEFAULT); // I can use also the PASSWORD_BCRYPT and CRYPT_BLOWFISH
		$email = sanitizeInput($_POST['email']);
		$country = $_POST['country'];
		$phone = $_POST['phone'];
		$customerImage = $_FILES['image']['name']; // I had an error as i didn't write the enctype attribute for the form tag
		$customerImage_tmp = $_FILES['image']['tmp_name'];
		$image_mimiType = $_FILES['image']['type'];
		$allowed = array("image/jpeg", "image/gif", "application/pdf","image/png");
		$existCheck = "SELECT * FROM customers WHERE user_name = '$user_name'";
		$runCheck = $object->query($existCheck);
		if($runCheck->num_rows >0)
			echo "<script>alert('This name already exists,Choose another one please')</script>";
		$existCheck = "SELECT * FROM customers WHERE user_email = '$email'";
		$runCheck = $object->query($existCheck);
		if($runCheck->num_rows >0)
			echo "<script>alert('This email already exists,Choose another one please')</script>";
		 if(!in_array($image_mimiType ,$allowed ))
		 {
			 echo "<script>alert('Upload a valid photo(jpeg,png,gif)')</script>";
		 }
		else
		{
		$insert_user = "INSERT INTO customers (`user_ip_address`,`user_name`,`user_pass`,`user_email`,`user_country`,`customer_contact`,`customer_image`)
VALUES ('$user_ip','$user_name','$password','$email','$country','$phone','$customerImage')";
		$runquery = $object->query($insert_user);

		if(!$runquery)
			echo "<script>alert('Something went wrong please try again')</script>";
		else
		{
			move_uploaded_file($customerImage_tmp,"customers/customer_images/$customerImage");
			$directQuery = "SELECT * FROM cart WHERE ip_address='$user_ip'";
			$runDirect = $object->query($directQuery);
			$_SESSION['user_email'] = $email;
			if($runDirect->num_rows == 0)
			{
			    echo "<script>alert('You registered successfully')</script>";
				echo "<script>window.open('customers/myAccount.php','_self')</script>";
			}
			else
			{
				echo "<script>alert('You registered successfully')</script>";
				echo "<script>window.open('cart.php','_self')</script>";
			}
		}
	  }
	}
	}
	?>