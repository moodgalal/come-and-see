<?php
	require_once "login.php";
	global $object;
?>
	<!DOCTYPE html>
	<html>
	<head>
		<link href="../styles/normalize.css" rel="stylesheet" type="text/css">
		<style>
			#nav1
			{
				height:35px;
				background: #9e9e9e;
				color:#2c2c2c;
				padding:10px;
				font-weight: bold;
			}
			h3
			{
				margin: 10px;
				color:#2c2c2c;
			}
			table {margin-top: 2px;}
			th{color: #007e36; font-weight: 600 }
			table ,tr,td,th
			{
				align-content: center;
				border:1px solid #007e36;
				padding: 5px;
				text-align: center;
			}
			td{font-weight: 500}
			a
			{
				text-decoration: none;
				color:#2c2c2c;
				font-weight: bold;
			}
			a:hover
			{
				text-decoration: none;
				color:#007e36;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
	<h3 align="center">All Customers</h3>
	<table>
		<tr>
			<th>Customer Id</th>
			<th>C. IP</th>
			<th>C. Name</th>
			<th>C. Email</th>
			<th>C. Country</th>
			<th>C. Contact</th>
			<th>C. Image</th>
		</tr>
		<?php
			$getCustomers = "SELECT * FROM customers";
			$runCustomers = $object->query($getCustomers);
			while($customerRow = mysqli_fetch_array($runCustomers))
			{
				$customerId = $customerRow['user_id'];
				$customerIp = $customerRow['user_ip_address'];
				$customerName = $customerRow['user_name'];
				$customerEmail = $customerRow['user_email'];
				$customerCountry = $customerRow['user_country'];
				$customerContact = $customerRow['customer_contact'];
				$customerImage = $customerRow['customer_image'];

				echo <<<END
<tr>
<td>#$customerId</td>
<td>$customerIp</td>
<td>$customerName</td>
<td>$customerEmail</td>
<td>$customerCountry</td>
<td>$customerContact</td>
<td><img src="../customers/customer_images/$customerImage" width="70" height="70"></td>
<td><a href="viewCustomers.php?delete=$customerId">Delete</a></td>
 </tr>
END;
			}
		?>
	</table>
	</body>
	</html>
<?php
	if(isset($_GET['delete']))
	{
		$delete_id = $_GET['delete'];
		$delete = "DELETE FROM customers WHERE user_id='$delete_id'";
		$runDelete = $object->query($delete);

		if($runDelete)
		{
			echo "<script>alert('The Customer has been deleted successfully')</script>";
			echo "<script>window.open('index.php?viewCustomers' , '_self')</script>";
		}
		else
			echo "<script>alert('Could\'nt delete the Customer')</script>" ;
	}
?>