<?php

include 'dbconnect.php';

if(isset($_POST['productUpdateAction'])) {
	$productId = $_POST['productId'];
	$productName = $_POST['productName'];
	$productDescription = $_POST['productDescription'];
	$productPrice = floatval($_POST['productPrice']);
	$productQuantity = intval($_POST['productQuantity']);
	$categoryValue = $_POST['categoryValue'];
	$productActiveValue = $_POST['productActiveValue'];
	
	$query = "update product set productName= '$productName', productDescription = '$productDescription', productPrice = $productPrice, quantity = $productQuantity, productCategoryId = $categoryValue, active= '$productActiveValue' where productId=$productId";
	
	$retval = mysql_query($query);
	if(! $retval )
	{
		echo 'Could not enter data: ' . mysql_error();
	}
	mysql_close($conn);
	header('Location: http://localhost/MobileStore/AdminUpdateProduct.php');
}

else if(isset($_POST['productDeleteAction'])) {
	$productId = $_POST['productDeleteId'];
	
	$query = "update product set active= 'false' where productId=$productId";
	
	$retval = mysql_query($query);
	if(! $retval )
	{
		echo 'Could not enter data: ' . mysql_error();
	}
	mysql_close($conn);
	header('Location: http://localhost/MobileStore/AdminUpdateProduct.php');
	
} else {
	mysql_close($conn);
	header('Location: http://localhost/MobileStore/Login.php');
}



?>

						
