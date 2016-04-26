<?php
session_start();

include 'dbconnect.php';

$email = $_POST['email'];
$password = $_POST['password'];

if($email == "admin@techstore.com" && $password == "Admin!123") 
{
	$_SESSION['emailAddress'] = "admin@techstore.com";
	$_SESSION['firstName'] = "Admin";
	$_SESSION['lastName'] = "Admin";
	header('Location: http://localhost/MobileStore/AdminHome.php');
}

else 
{

	$query = "select * from  user where emailAddress='$email' and password='$password'";
	
	$result = mysql_query($query, $conn);
	$num_rows = mysql_num_rows($result);
	
	$status = [];
	if($num_rows == 0) {
		header('Location: http://localhost/MobileStore/Login.php?msg=wrong');
	}
	else {
		while($row = mysql_fetch_assoc($result))
		{
			$_SESSION['emailAddress'] = $row['emailAddress'];
			$_SESSION['firstName'] = $row['firstName'];
			$_SESSION['lastName'] = $row['lastName'];
			$_SESSION['gender'] = $row['gender'];
			$_SESSION['phoneNumber'] = $row['phoneNumber'];
			$_SESSION['address'] = $row['address'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['city'] = $row['city'];
			$_SESSION['state'] = $row['state'];
			$_SESSION['zipCode'] = $row['zipCode'];
		}
		header('Location: http://localhost/MobileStore/Home.php');
	}
	mysql_query($query);
	mysql_close($conn);
}
?>