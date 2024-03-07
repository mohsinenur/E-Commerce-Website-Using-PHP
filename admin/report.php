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
					
					<th><a href="orders.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Orders</a></th>
					<th><a href="DeliveryRecords.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color:  #e6b7b8;border-radius: 12px;">DeliveryRecords</a></th>
					<?php 
						if($utype_db == 'admin'){
							echo '<th><a href="report.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #24bfae;border-radius: 12px;">Reports</a></th>
								<th><a href="newadmin.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;;border-radius: 12px;">New Admin</a></th>';
						}
					?>

				</tr>
			</table>
		</div>
		<div style="margin-top: 20px;">
			<div style="width: 1200px; margin: 0 auto;">
			
				<ul>
					<li style="float: left;">
						<div class="settingsleftcontent">
							<ul>
								<ul>
								<li><?php echo '<a href="report.php" style=" background-color: #169e8f; border-radius: 4px; color: #fff;" >List Of Products</a>'; ?></li>
								<li><?php echo '<a href="all_customer.php" >All Customers</a>'; ?></li>
								<li><?php echo '<a href="sales_report.php" >Sales Reports</a>'; ?></li>
							</ul>
							</ul>
						</div>
					</li>
					<li style="float: right; background-color: #fff;">
						<div>
							<table class="rightsidemenu">
								<tr style="font-weight: bold;" colspan="10" bgcolor="#4DB849">
									<th>Id</th>
									<th>P Name</th>
									<th>Description</th>
									<th>Price</th>
									<th>Available</th>
									<th>Category</th>
									<th>Type</th>
									<th>Item</th>
									<th>P Code</th>
									<th>Edit</th>
								</tr>
								<tr>
									<?php include ( "../inc/connect.inc.php");
									$query = "SELECT * FROM products ORDER BY id DESC";
									$run = mysqli_query($con, $query);
									while ($row=mysqli_fetch_assoc($run)) {
										$id = $row['id'];
										$pName = substr($row['pName'], 0,50);
										$descri = $row['description'];
										$price = $row['price'];
										$available = $row['available'];
										$category = $row['category'];
										$type = $row['type'];
										$item = $row['item'];
										$pCode = $row['pCode'];
										$picture = $row['picture'];
									
									 ?>
									<th><?php echo $id; ?></th>
									<th><?php echo $pName; ?></th>
									<th><?php echo $descri; ?></th>
									<th><?php echo $price; ?></th>
									<th><?php echo $available; ?></th>
									<th><?php echo $category; ?></th>
									<th><?php echo $type; ?></th>
									<th><?php echo $item; ?></th>
									<th><?php echo $pCode; ?></th>
									<th><?php echo '<div class="home-prodlist-img"><a href="editproduct.php?epid='.$id.'">
													<img src="../image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi" style="height: 75px; width: 75px;">
													</a>
												</div>' ?></th>
								</tr>
								<?php } ?>
							</table>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>