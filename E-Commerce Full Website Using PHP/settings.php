<?php include ( "inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
}
else {
	$user = $_SESSION['user_login'];
	$result = mysql_query("SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysql_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$uemail_db = $get_user_email['email'];
			$upass = $get_user_email['password'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}

if (isset($_REQUEST['uid'])) {
	
	$user2 = mysql_real_escape_string($_REQUEST['uid']);
	if($user != $user2){
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

if (isset($_POST['changesettings'])) {
//declere veriable
$email = $_POST['email'];
$opass = $_POST['opass'];
$npass = $_POST['npass'];
$npass1 = $_POST['npass1'];
//triming name
	try {
		if(empty($_POST['email'])) {
			throw new Exception('Email can not be empty');
			
		}
			if(isset($opass) && isset($npass) && isset($npass1) && ($opass != "" && $npass != "" && $npass1 != "")){
				if( md5($opass) == $upass){
					if($npass == $npass1){
						$npass = md5($npass);
						mysql_query("UPDATE user SET password='$npass' WHERE id='$user'");
						$success_message = '
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">
							Password changed.
						</font></div>';
					}else {
					$success_message = '
						<div class="signupform_text" style=" color: red; font-size: 18px; text-align: center;">
						<font face="bookman">
							New password not matched!
						</font></div>';
					}
				}else {
				$success_message = '
					<div class="signupform_text" style=" color: red; font-size: 18px; text-align: center;">
					<font face="bookman">
						Fillup password field exactly.
					</font></div>';
				}
			}else {
				$success_message = '
					<div class="signupform_text" style=" color: red; font-size: 18px; text-align: center;">
					<font face="bookman">
						Fillup password field exactly.
					</font></div>';
				}

			if($uemail_db != $email) {
				if(mysql_query("UPDATE user SET  email='$email' WHERE id='$user'")){
					//success message
					$success_message = '
					<div class="signupform_text" style="font-size: 18px; text-align: center;">
					<font face="bookman">
						Settings change successfull.
					</font></div>';
				}
			}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>SAREE</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-image: url(image/homebackgrndimg1.png);">
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
					<img style=" height: 75px; width: 130px;" src="image/ebuybdlogo.png">
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
					<a href="women/saree.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Saree</a>
				</th>
				<th><a href="women/ornament.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Ornament</a></th>
				<th><a href="women/watch.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Watch</a></th>
				<th><a href="women/perfume.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Perfume</a></th>
				<th><a href="women/hijab.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Hijab</a></th>
				<th><a href="women/tshirt.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">T-Shirt</a></th>
				<th><a href="women/footwear.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">FootWear</a></th>
				<th><a href="women/toilatry.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Toilatry</a></th>
			</tr>
		</table>
	</div>
	<div style="margin-top: 20px;">
		<div style="width: 901px; margin: 0 auto;">
		
			<ul>
				<li style="float: left;">
					<div class="settingsleftcontent">
						<ul>
							<li><?php echo '<a href="profile.php?uid='.$user.'" >My Orders</a>'; ?></li>
							<li><?php echo '<a href="settings.php?uid='.$user.'" style=" background-color: #169e8f; border-radius: 4px; color: #fff;">Settings</a>'; ?></li>
						</ul>
					</div>
				</li>
				<li style="float: right;">
					<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
						<form action="" method="POST" class="registration">
							<div class="container signupform_content ">
								<div style="text-align: center;font-size: 20px;color: #fff;margin: 0 0 5px 0;">
									<td >Change Password:</td>
								</div>
								<div>
									<td><input class="email signupbox" type="password" name="opass" placeholder="Old Password"></td>
								</div>
								<div>
									<td><input class="email signupbox" type="password" name="npass" placeholder="New Password"></td>
								</div>
								<div>
									<td><input class="email signupbox" type="password" name="npass1" placeholder="Repeat Password"></td>
								</div>
								<div style="text-align: center;font-size: 20px;color: #fff;margin: 0 0 5px 0;">
									<td >Change Email:</td>
								</div>
								<div>
									<td><?php echo '<input class="email signupbox" required type="email" name="email" placeholder="New Email" value="'.$uemail_db.'">'; ?></td>
								</div>
								<div>
									<td><input class="uisignupbutton signupbutton" type="submit" name="changesettings" value="Update Settings"></td>
								</div>
								<div>
									<?php if (isset($success_message)) {echo $success_message;} ?>
								</div>
							</div>
						</form>
					</div>
				</li>
			</ul>
		</div>
	</div>

	
</body>
</html>