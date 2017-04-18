<?php include ( "../inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	$user = "";
	header("location: login.php?ono=".$epid."");
}
else {
	if (isset($_REQUEST['epid'])) {
	
		$epid = mysql_real_escape_string($_REQUEST['epid']);
	}else {
		header('location: index.php');
	}
	$user = $_SESSION['admin_login'];
	$result = mysql_query("SELECT * FROM admin WHERE id='$user'");
	$get_user_email = mysql_fetch_assoc($result);
		$uname_db = $get_user_email['firstName'];

}
$getposts = mysql_query("SELECT * FROM products WHERE id ='$epid'") or die(mysql_error());
	if (mysql_num_rows($getposts)) {
		$row = mysql_fetch_assoc($getposts);
		$id = $row['id'];
		$pName = $row['pName'];
		$price = $row['price'];
		$description = $row['description'];
		$picture = $row['picture'];
		$item = $row['item'];
		$itemu = ucwords($row['item']);
		$type = $row['type'];
		$typeu = ucwords($row['type']);
		$category = $row['category'];
		$categoryu = ucwords($row['category']);
		$code = $row['pCode'];
		$available =$row['available'];
	}	

//update product
if (isset($_POST['updatepro'])) {
	$pname = $_POST['pname'];
	$price = $_POST['price'];
	$available = $_POST['available'];
	$category = $_POST['category'];
	$type = $_POST['type'];
	$item = $_POST['item'];
	$pCode = $_POST['code'];
	//triming name
	$_POST['pname'] = trim($_POST['pname']);

	if($result = mysql_query("UPDATE products SET pName='$_POST[pname]',price='$_POST[price]',description='$_POST[descri]',available='$_POST[available]',category='$_POST[category]',type='$_POST[type]',item='$_POST[item]',pCode='$_POST[code]' WHERE id='$epid'")){
		header("Location: editproduct.php?epid=".$epid."");

	}else {
		echo "no changed";
	}
}
if (isset($_POST['updatepic'])) {

if($_FILES['profilepic'] == ""){
	
		echo "not changed";
}else {
	//finding file extention
$profile_pic_name = @$_FILES['profilepic']['name'];
$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

if (((@$_FILES['profilepic']['type']=='image/jpeg') || (@$_FILES['profilepic']['type']=='image/png') || (@$_FILES['profilepic']['type']=='image/jpg') || (@$_FILES['profilepic']['type']=='image/gif')) && (@$_FILES['profilepic']['size'] < 1000000)) {

	$item = $item;
	if (file_exists("../image/product/$item")) {
		//nothing
	}else {
		mkdir("../image/product/$item");
	}
	
	
	$filename = strtotime(date('Y-m-d H:i:s')).$file_ext;

	if (file_exists("../image/product/$item/".$filename)) {
		echo @$_FILES["profilepic"]["name"]."Already exists";
	}else {
		if(move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "../image/product/$item/".$filename)){
			$photos = $filename;
			if($result = mysql_query("UPDATE products SET picture='$photos' WHERE id='$epid'")){

				$delete_file = unlink("../image/product/$item/".$picture);
				header("Location: editproduct.php?epid=".$epid."");
			}else {
				echo "Wrong!";
			}
		}else {
			echo "Something Worng on upload!!!";
		}
		//echo "Uploaded and stored in: userdata/profile_pics/$item/".@$_FILES["profilepic"]["name"];
		
		
	}
	}
	else {
		$error_message = "Choose a picture!";
	}

}
}



if (isset($_POST['delprod'])) {
//triming name
	$getposts1 = mysql_query("SELECT pid FROM orders WHERE pid='$epid'") or die(mysql_error());
					if ($ttl = mysql_num_rows($getposts1)) {
						$error_message = "You can not delete this product.<br>Someone ordered this.";
					}
					else {
						if(mysql_query("DELETE FROM products WHERE id='$epid'")){
						header('location: orders.php');
						}
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
							echo '<a style="text-decoration: none;color: #fff;" href="login.php">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none;color: #fff;" href="login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="../image/ebuybdlogo.png">
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
						<a href="index.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Home</a>
					</th>
					<th><a href="addproduct.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Add Product</a></th>
					<th><a href="newadmin.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">New Admin</a></th>
					<th><a href="allproducts.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">All Products</a></th>
					<th><a href="orders.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Orders</a></th>
				</tr>
			</table>
		</div>
	<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
		<div class="container signupform_content ">
			<div>

				<h2 style="padding-bottom: 20px;">Edit Product Info</h2>
				<div style="float: right;">
				<?php 
					echo '
						<div class="">
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration">
								<div class="signup_form">
									<div>
										<td >
											<input name="pname" id="first_name" placeholder="Product Name" required="required" class="first_name signupbox" type="text" size="30" value="'.$pName.'" >
										</td>
									</div>
									<div>
										<td >
											<input name="price" id="last_name" placeholder="Price" required="required" class="last_name signupbox" type="text" size="30" value="'.$price.'" >
										</td>
									</div>
									<div>
										<td>
											<input name="available" placeholder="Available Quantity" required="required" class="email signupbox" type="text" size="30" value="'.$available.'">
										</td>
									</div>
									<div>
										<td >
											<input name="descri" id="first_name" placeholder="Description" required="required" class="first_name signupbox" type="text" size="30" value="'.$description.'" >
										</td>
									</div>
									<div>
										<td>
											<select name="category" required="required" style=" font-size: 20px;
										font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;" class="">
												<option selected value="'.$category.'">'.$categoryu.'</option>
												<option value="women">Women</option>
											</select>
										</td>
									</div>
									<div>
										<select name="type" required="required" style=" font-size: 20px;
										font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;" class="">
											<option selected value="'.$type.'">'.$typeu.'</option>
												<option value="clothing">Clothing</option>
												<option value="other">Other</option>
											</select>
									</div>
									<div>
										<td>
											<select name="item" required="required" style=" font-size: 20px;
										font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;" class="">
												<option selected value="'.$item.'">'.$itemu.'</option>
												<option value="saree">Saree</option>
												<option value="ornament">Ornaments</option>
												<option value="watch">Watch</option>
												<option value="tshirt">T-Shirt</option>
												<option value="hijab">Hijab</option>
												<option value="perfume">Perfume</option>
												<option value="footwear">Footwear</option>
												<option value="toiletry">Toiletry</option>
												<option value="Other">Other</option>
											</select>
										</td>
									</div>
									<div>
										<td>
											<input name="code" id="password-1" required="required"  placeholder="Code" class="password signupbox " type="text" size="30" value="'.$code.'">
										</td>
									</div>
									<div>
										<input name="updatepro" class="uisignupbutton signupbutton" type="submit" value="Update Product">
									</div>
									<div>
										<input name="delprod" class="uisignupbutton signupbutton" type="submit" value="Delete This Product">
									</div>
									<div class="signup_error_msg">
										<?php 
											if (isset($error_message)) {echo $error_message;}
											
										?>
									</div>
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
								<div class="home-prodlist-img prodlist-img">';
								if (file_exists('../image/product/'.$item.'/'.$picture.'')){
									echo '<img src="../image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi">';
								}else {
									echo '
									<div class="home-prodlist-imgi" style="text-align: center; padding: 0 0 6px 0;">No Image Found!</div>';
								} echo '
									
								</div>
							</li>
							<li>
								<form action="" method="POST" class="registration" enctype="multipart/form-data">
										<div class="signup_form">
											<div>
												<td>
													<input name="profilepic" style="width: 115px;" class="password signupbox" type="file" value="Add Picture">
												</td>
											</div>
											<div>
												<input name="updatepic" style="width: 144px;" class="uisignupbutton signupbutton" type="submit" value="Change Picture">
											</div>
											<div class="signup_error_msg">';
											if(isset($error_message)) {echo $error_message;}
											' </div>
										</div>
									</form>
							</li>
						</ul>
					';
				?>
			</div>

		</div>
	</div>
</body>
</html>