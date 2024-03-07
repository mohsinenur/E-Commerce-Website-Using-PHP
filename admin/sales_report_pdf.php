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



require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$sales_report = new Dompdf();
$page = file_get_contents("sales_report_pdf.php");


$output = '
		<html>
		<head>
			<title>Welcome to ebuybd online shop</title>
			<link rel="stylesheet" type="text/css" href="../css/style.css">
		</head>
		<body style="">
		<div style="width:400px; margin: 2% 17%;">
		<h2 style="text-align: center; padding: 10px;">Sales Report</h2>
			<table class="rightsidemenu">
				<tr style="font-weight: bold;" colspan="10" bgcolor="#4DB849">
					<th>Customer Id</th>
					<th>Customer Name</th>
					<th>Payment</th>
				</tr>
				';

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
	$output .=
			'<tr><th>'.$uid.'</th>
			<th>'.$FirstName.'</th>
			<th>'.$payment.'Php</th>
			</tr>';
}

$output .= 
				'<tr style="font-weight: bold;" colspan="10" bgcolor="#4DB849">
					<th>Total Sales</th>
					<th></th>
					<th>'.$total.'Php</th>
				</tr>
			</table>
		</div></body>';

$sales_report->loadHtml($output);
$sales_report->setPaper('A4', 'portrait');
$sales_report->render();
$sales_report->stream("Sales_Report", array("Attachment"=>0));

?>