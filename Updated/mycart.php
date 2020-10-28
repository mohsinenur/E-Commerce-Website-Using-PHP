<?php include ( "inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($con, "SELECT * FROM user WHERE id='$user'");
	$get_user_email = mysqli_fetch_assoc($result);
	$uname_db = $get_user_email != null ? $get_user_email['firstName'] : null;
	$uemail_db = $get_user_email != null ? $get_user_email['email'] : null;
	$ulast_db= $get_user_email != null ? $get_user_email['lastName'] : null;

	$umob_db = $get_user_email != null ? $get_user_email['mobile'] : null;
	$uadd_db = $get_user_email != null ? $get_user_email['address'] : null;
}

if (isset($_REQUEST['uid'])) {
	
	$user2 = mysqli_real_escape_string($con, $_REQUEST['uid']);
	if($user != $user2){
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

if (isset($_REQUEST['cid'])) {
		$cid = mysqli_real_escape_string($con, $_REQUEST['cid']);
		if(mysqli_query($con, "DELETE FROM orders WHERE pid='$cid' AND uid='$user'")){
		header('location: mycart.php?uid='.$user.'');
	}else{
		header('location: index.php');
	}
}

$search_value = "";


//order

if (isset($_POST['order'])) {
//declere veriable
$mbl = $_POST['mobile'];
$addr = $_POST['address'];
$del = $_POST['Delivery'];
//triming name
	try {
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['address'])) {
			throw new Exception('Address can not be empty');
			
		}
		if(empty($_POST['Delivery'])) {
			throw new Exception('Type of Delivery can not be empty');
			
		}

		
		// Check if email already exists
		
		
						$d = date("Y-m-d"); //Year - Month - Day
						
						// send email
						$msg = "
					
						Your Order suc

						
						";
						//if (@mail($uemail_db,"eBuyBD Product Order",$msg, "From:eBuyBD <no-reply@ebuybd.xyz>")) {
						$result = mysqli_query($con, "SELECT * FROM cart WHERE uid='$user'");
						$t = mysqli_num_rows($result);
						if($t <= 0) {
							throw new Exception('No product in cart. Add product first.');
							
						}
						while ($get_p = mysqli_fetch_assoc($result)) {
							$num = $get_p['quantity'];
							$pid = $get_p['pid'];

							mysqli_query($con, "INSERT INTO orders (uid,pid,quantity,oplace,mobile,odate,delivery) VALUES ('$user','$pid',$num,'$_POST[address]','$_POST[mobile]','$d','$del')");
						}
							
						if(mysqli_query($con, "DELETE FROM cart WHERE uid='$user'")){

							//success message
							
						$success_message = '
						<div class="signupform_content">
						<h2><font face="bookman"></font></h2>

						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">

						</font></div></div>
						';
							
						}
						//}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Noodles&Canned</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-image: url(image/homebackgrndimg1.jpg);">
	<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="signin.php">SIGN IN</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="image/cart.png">
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
					<th><?php echo '<a href="mycart.php?uid='.$user.'" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">My Cart</a>'; ?></th>
					<th>
						<?php echo '<a href="profile.php?uid='.$user.'" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #fff;border-radius: 12px;">My Orders</a>'; ?>
					</th>
					<th>
						<?php echo '<a href="my_delivery.php?uid='.$user.'" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #fff;border-radius: 12px;">MyDeliveryHistory</a>'; ?>
					</th>
					<th><?php echo '<a href="settings.php?uid='.$user.'" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #fff;border-radius: 12px;">Settings</a>'; ?></th>
					

				</tr>
			</table>
		</div>
	<div style="margin-top: 20px; padding: 0 10%;">
		<div style=" margin: 0 auto; width: 55%;float: left;">
		
			<ul>
				<li style=" background-color: #fff;">
					<div>
						<div>
							<table class="rightsidemenu">
								<tr style="font-weight: bold;" colspan="10" bgcolor="#3A5487">
									<th>Product Name</th>
									<th>Price</th>
									<th>Pieces</th>
									<th>Description</th>
									<th>View</th>
									<th>Remove</th>
								</tr>
								<tr>
									<?php include ( "inc/connect.inc.php");
									$query = "SELECT * FROM cart WHERE uid='$user' ORDER BY id DESC";
									$run = mysqli_query($con, $query);
									$total = 0;
									while ($row=mysqli_fetch_assoc($run)) {
										$pid = $row['pid'];
										$quantity = $row['quantity'];
										
										//get product info
										$query1 = "SELECT * FROM products WHERE id='$pid'";
										$run1 = mysqli_query($con, $query1);
										$row1=mysqli_fetch_assoc($run1);
										$pId = $row1['id'];
										$pName = substr($row1['pName'], 0,50);
										$price = $row1['price'];
										$description = $row1['description'];
										$picture = $row1['picture'];
										$item = $row1['item'];
										$category = $row1['category'];

										$total += ($quantity*$price);
										$_SESSION['total'] = $total;
									 ?>
									<th><?php echo $pName; ?></th>
									<th><?php echo $price; ?></th>
									<th><?php echo '<a href="delete_cart.php?sid='.$pId.'" style="text-decoration: none;padding: 0px 5px;font-size: 25px;color: white;border: 1px solid;margin: 10px;">-</a>' ?><?php echo $quantity; ?><?php echo '<a href="delete_cart.php?aid='.$pId.'" style="text-decoration: none;padding: 0px 5px;font-size: 25px;color: white;border: 1px solid;margin: 10px;">+</a>' ?></th>
									<th><?php echo $description; ?></th>
									<th><?php echo '<div class="home-prodlist-img"><a href="OurProducts/view_product.php?pid='.$pId.'">
													<img src="image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi" style="height: 75px; width: 75px;">
													</a>
												</div>' ?></th>
									<th><?php echo '<div class="home-prodlist-img"><a href="delete_cart.php?cid='.$pId.'" style="text-decoration: none;">X</a>
												</div>' ?></th>
								</tr>
								<?php } ?>
								<tr style="font-weight: bold;" colspan="10" bgcolor="#3A5487">
									<th>Total</th>
									<th></th>
									<th><?php echo $total ?> Php</th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
							</table>
						</div>
					</div>
				</li>
				
			</ul>
		</div>
		<div class="holecontainer" style="float: right;width: 35%;">
			<div class="container signupform_content ">
				<div>
					<div style="">
					
					<?php 
						if(isset($success_message)) {echo $success_message;

										echo '<h3 style="color:#169E8F;font-size:45px;"> Payment&Delivery </h3>';


							$user = $_SESSION['user_login'];
		$result = mysqli_query($con, "SELECT * FROM user WHERE id='$user'");
			$get_user_email = mysqli_fetch_assoc($result);
				$uname_db = $get_user_email['firstName'];
				$ulast_db=$get_user_email['lastName'];
				$uemail_db = $get_user_email['email'];
				$umob_db = $get_user_email['mobile'];
				$uadd_db = $get_user_email['address'];
				echo '<h3 style="color:black;font-size:25px;"> First Name: </h3>';
				echo'<span style="color:#34ce6c;font-size:25px;">'. $uname_db.'</span>';
				echo '<h3 style="color:black;font-size:25px;"> Last Name: </h3>';
				echo'<span style="color:#34ce6c;font-size:25px;">' .$ulast_db.'</span>';
				echo '<h3 style="color:black;font-size:25px;"> Email: </h3>'; 
				echo '<span style="color:#34ce6c;font-size:25px;">' .$uemail_db.'</span>';
				echo '<h3 style="color:black;font-size:25px;"> Contact Number: </h3>';
				echo '<span style="color:#34ce6c;font-size:25px;">' .$umob_db.'</span>';
				echo '<h3 style="color:black;font-size:25px;"> Home Address: </h3>';
				echo '<span style="color:#34ce6c;font-size:25px;">'.$uadd_db.'</span>';
				
				$del = $_POST['Delivery'] ;
				echo '<h3 style="color:black;font-size:25px;">Types of Delivery:</h3>';
				echo'<span style="color:#34ce6c;font-size:25px;">' .$del.'</span>';
				
				echo '<h3 style="color:#169E8F;font-size:35px;"> Total: Php '.$_SESSION['total'].' Php</h2>';
				

						}
						else {
						echo '
							
							<div class="signupform_text"></div>
							

								<form action="" method="POST" class="registration">
							
									<div class="signup_form" >
									<h3 style="color:red;font-size:18px; padding: 5px;">Accepting CashOnDelivery Only</h3>
										<div>
											<td>
												<input name="fullname" placeholder="your name" required="required" class="email signupbox" type="text" size="30" value="'.$uname_db.'">
											</td>
										</div>

										<div>
											<td>
												<input name="lastname" placeholder="Your last name" required="required" class="email signupbox" type="text" size="30" value="'.$ulast_db.'">
											</td>
										</div>



										<div>
										<td>
												<input name="mobile" placeholder="Your mobile number" required="required" class="email signupbox" type="text" size="30" value="'.$umob_db.'">
											</td>
										</div>
										<div>
											<td>
												<input name="address" id="password-1" required="required"  placeholder="Write your full address" class="password signupbox " type="text" size="30" value="'.$uadd_db.'">
											</td>
										</div>

										<div>
										<td>

										<font style="italic" family="arial" size="5px" color="#169e">
										Types of Delivery <br>
										

										 <input name="Delivery" required="required" value="Express Delivery +100php upon cash on delivery" type="radio"  placeholder="Mode Of Payment"> Express Delivery </br>
										 <input name="Delivery" type="radio" value="Standard Delivery" required="required" placeholder="Mode Of Payment"> Standard Delivery </br>
										 </font>


										</td>
										</div>


										<div>
										</div>
										
										
										<div>
											<input onclick="myFunction()" name="order" class="uisignupbutton signupbutton" type="submit" value="Confirm Order">
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

						}

					 ?>
						</h3>
					</div>

				</div>
			</div>
		</div>
	</div>
	
	
</body>
</html>