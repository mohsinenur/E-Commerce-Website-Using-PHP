<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	header("location: login.php");
	$user = "";
}
else {
	$user = $_SESSION['admin_login'];
	$result = mysqli_query($con, "SELECT * FROM admin WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$utype_db=$get_user_email['type'];
			if($utype_db == 'staff'){
				header("location: login.php");
			}
}

?>


<!doctype html>
<html>
	<head>
		<title>Welcome to ebuybd online shop</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body class="home-welcome-text" style="background-image: url(../image/homebackgrndimg2.png);">
		<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none;color: #fff;" href="logout.php">LOG OUT</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none;color: #fff;" href="login.php">Hi '.$uname_db.'</br><span style="color: #de2a74">'.$utype_db.'</span></a>';
						}
						else {
							echo '<a style="text-decoration: none;color: #fff;" href="login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="../image/cart.png">
				</a>
			</div>
			<div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="http://www.google.com">
					        <input type="text" class="srctextinput" name="q" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
		<div class="categolis">
			<table>
				<tr>
					<th>
						<a href="index.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Home</a>
					</th>
					<th><a href="addproduct.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Add Product</a></th>
					<th><a href="newadmin.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">New Admin</a></th>
					<th><a href="orders.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Orders</a></th>
					<th><a href="DeliveryRecords.php" style="text-decoration: none;color:  #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">DeliveryRecords</a></th>
					<th><a href="report.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #24bfae;border-radius: 12px;">Reports</a></th>
					<th><a href="sales_report_pdf.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #bc0987;border-radius: 12px;">Print</a></th>

				</tr>
			</table>
		</div>
		<div style="margin-top: 20px;">
			<div style="width: 950px; margin: 0 auto;">
			
				<ul>
					<li style="float: left;">
						<div class="settingsleftcontent">
							<ul>
								<ul>
								<li><?php echo '<a href="report.php" >List Of Products</a>'; ?></li>
								<li><?php echo '<a href="all_customer.php" >All Customers</a>'; ?></li>
								<li><?php echo '<a href="sales_report.php" style=" background-color: #169e8f; border-radius: 4px; color: #fff;">Sales Reports</a>'; ?></li>
							</ul>
							</ul>
						</div>
					</li>
					<li style="float: right; background-color: #fff;">
						<div>
							<table class="rightsidemenu">
								<tr style="font-weight: bold;" colspan="10" bgcolor="#4DB849">
									<th>Customer Id</th>
									<th>Customer Name</th>
									<th>Payment</th>
								</tr>
								<tr>
									<?php include ( "../inc/connect.inc.php");
									$total = 0;
									$query = "SELECT * FROM orders WHERE dstatus='yes' ORDER BY id DESC";
									$run = mysqli_query($con, $query);
									while ($row=mysqli_fetch_assoc($run)) {
										$uid = $row['uid'];
										$productId = $row['pid'];
										$quantity = $row['quantity'];
										$query1 = "SELECT * FROM user WHERE id='$uid'";
										$run1 = mysqli_query($con, $query1);
										$row1=mysqli_fetch_assoc($run1);
										$FirstName = $row1['firstName'];

										$query2 = "SELECT * FROM products WHERE id='$productId'";
										$run2 = mysqli_query($con, $query2);
										$row2=mysqli_fetch_assoc($run2);
										$pPrice = $row2['price'];
										$payment = $pPrice * $quantity;
										$total+=$payment;
									 ?>
									<th><?php echo $uid; ?></th>
									<th><?php echo $FirstName; ?></th>
									<th><?php echo $payment; ?> Php</th>
								</tr>
								<?php } ?>
								<tr style="font-weight: bold;" colspan="10" bgcolor="#4DB849">
									<th>Total Sales</th>
									<th></th>
									<th><?php echo $total; ?> Php</th>
								</tr>
							</table>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>