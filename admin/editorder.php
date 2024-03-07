<?php include ( "../inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	$user = "";
	header("location: login.php?ono=".$eoid."");
}
else {
	if (isset($_REQUEST['eoid'])) {
	
		$eoid = mysqli_real_escape_string($con, $_REQUEST['eoid']);
		$getposts5 = mysqli_query($con, "SELECT * FROM orders WHERE id='$eoid'") or die(mysqlI_error($con));
			if (mysqli_num_rows($getposts5)){

			}else {
				header('location: index.php');
			}
	}else {
		header('location: index.php');
	}
	$user = $_SESSION['admin_login'];
	$result = mysqli_query($con, "SELECT * FROM admin WHERE id='$user'");
	$get_user_email = mysqli_fetch_assoc($result);
		$uname_db = $get_user_email['firstName'];
		$type_db=$get_user_email['type'];
		$utype_db=$get_user_email['type'];


	$result1 = mysqli_query($con, "SELECT * FROM orders WHERE id='$eoid'");
		$get_order_info = mysqli_fetch_assoc($result1);
			$eouid = $get_order_info['uid'];
			$eopid = $get_order_info['pid'];
			$eoquantity = $get_order_info['quantity'];
			$eoplace = $get_order_info['oplace'];
			$eomobile = $get_order_info['mobile'];
			$eodstatus = $get_order_info['dstatus'];
			$eodustatus = ucwords($get_order_info['dstatus']);
			$eodate = $get_order_info['odate'];
			$eddate = $get_order_info['ddate'];

			$result2 = mysqli_query($con, "SELECT * FROM user WHERE id='$eouid'");
			$get_order_info2 = mysqli_fetch_assoc($result2);
			$euname = $get_order_info2['firstName'];
			$euemail = $get_order_info2['email'];
			$eumobile = $get_order_info2['mobile'];
}

$getposts = mysqli_query($con, "SELECT * FROM products WHERE id ='$eopid'") or die(mysqlI_error($con));
					if (mysqli_num_rows($getposts)) {
						$row = mysqli_fetch_assoc($getposts);
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$piece=$row['piece'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						$category = $row['category'];
						$available =$row['available'];
					}	

//order

if (isset($_POST['order'])) {
//declere veriable
$eodstatus = $_POST['dstatus'];
$dquantity = $_POST['quantity'];
$ddate = $_POST['ddate'];
//triming name
	try {
		if(empty($_POST['dstatus'])) {
			throw new Exception('Status can not be empty');
			
		}
				if(mysqli_query($con, "UPDATE orders SET dstatus='$eodstatus', ddate='$ddate', quantity='$dquantity' WHERE id='$eoid'")){
					//success message
				header('location: editorder.php?eoid='.$eoid.'');
				$success_message = '
				<div class="signupform_content"><h2><font face="bookman">Change successfull!</font></h2>
				</div>';
				}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}
if (isset($_POST['delorder'])) {
//triming name
	if(mysqli_query($con, "DELETE FROM orders WHERE id='$eoid'")){

	header('location: orders.php');
	}

	}
$search_value = "";


?>

<!DOCTYPE html>
<html>
<head>
	<title>SAREE</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-image: url(../image/homebackgrndimg1.png);">
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
			<div id="srcheader">
				<form id="newsearch" method="get" action="search.php">
				        <?php 
				        	echo '<input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..." value="'.$search_value.'"><input type="submit" value="search" class="srcbutton" >';
				         ?>
				</form>
			<div class="srcclear"></div>
			</div>
		</div>
		<div class="categolis">
			<table>
				<tr>
					<th>
						<a href="index.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Home</a>
					</th>
					<th><a href="addproduct.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Add Product</a></th>
					<th><a href="orders.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Orders</a></th>
					<th><a href="DeliveryRecords.php" style="text-decoration: none;color:#040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">DeliveryRecords</a></th>
					<?php 
						if($utype_db == 'admin'){
							echo '<th><a href="report.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Reports</a></th>
								<th><a href="newadmin.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #24bfae;;border-radius: 12px;">New Admin</a></th>';
						}
					?>

				</tr>
			</table>
		</div>
	<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
		<div class="container signupform_content ">
			<div>
				<h2 style="padding-bottom: 20px;">Change Delevary Status</h2>
				<div style="float: right;">
				<?php 
					echo '
						<div class="">
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration">
								<div class="signup_form" style="    margin-top: 38px;">
									<div>
										<td>
											<input name="ddate" placeholder="Delevary date" required="required" class="email signupbox" type="date" size="30" value="'.$eddate.'">
										</td>
									</div>
									<div>
										<td>
											<select name="dstatus" required="required" style=" font-size: 20px;
												font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;" class="">
														<option selected value="'.$eodstatus.'">'.$eodustatus.'</option>
														<option value="No">No</option>
														<option value="Yes">Yes</option>
														<option value="Cancel">Cancel</option>
													</select>
										</td>
									</div>
									<div>
										<td>
											<select name="quantity" required="required" style=" font-size: 20px;
										font-style: italic; margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;" class="">
										<option selected value="'.$eoquantity.'">Quantity: '.$eoquantity.'</option>';
				 								?><?php
												for ($i=1; $i<=$available; $i++) { 
													echo '<option value="'.$i.'">Quantity: '.$i.'</option>';
												}
											?>
											<?php echo '
											</select>
										</td>
									</div>
									<div>
										<input name="order" class="uisignupbutton signupbutton" type="submit" style="color: #169E8F" value="Confirm Change">
									</div>
									<div>
										<input name="delorder" class="uisignupbutton signupbutton" type="submit" style="color: #169E8F" value="Delete Order">
									</div>
									<div class="signup_error_msg"> '; ?>
										<?php 
											if (isset($error_message)) {echo $error_message;}
											
										?>
									<?php echo '</div>
								</div>
							</form>
							
						</div>
					</div>

					';
					if(isset($success_message)) {echo $success_message;}

				 ?>
					
				</div>
			</div>
		</div>
		<div style="float: left;">
			<div>
				<?php
					echo '
						<ul style="float: left;">
							<li style="float: left; padding: 0px 25px 25px 25px;">
								<div class="home-prodlist-img">
									<img src="../image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi">
									
									<div style="text-align: center; padding: 0 0 6px 0;">'.$pName.'</div>
								</div>
								
							</li>
						</ul>
					';
				?>
			</div>

		</div>
	</div>
</body>
</html>