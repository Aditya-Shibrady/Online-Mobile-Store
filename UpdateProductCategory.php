<?php

include 'dbconnect.php';

if(isset($_POST['productCategoryUpdateAction'])) {
	$productCategoryId = intval($_POST['productCategoryId']);
	$productCategoryName = $_POST['productCategoryName'];
	$productCategoryActiveValue = $_POST['categoryActiveValue'];
	
	$query = "update product_category set productCategoryName = '$productCategoryName', categoryActive = '$productCategoryActiveValue' where productCategoryId = $productCategoryId";
	print $query;
	
	$retval = mysql_query($query);
	if(! $retval ) {
		echo 'Could not enter data: ' . mysql_error();
	}
	mysql_close($conn);
	header('Location: http://localhost/MobileStore/AdminUpdateProductCategory.php');

}

else if(isset($_POST['productCategoryDeleteAction'])) {
	$productCategoryId = intval($_POST['productDeleteCategoryId']);
	$query = "update product_category set categoryActive = 'false' where productCategoryId = $productCategoryId";
	print $query;
	$retval = mysql_query($query);
	if(! $retval ) {
		echo 'Could not enter data: ' . mysql_error();
	}
	mysql_close($conn);
	header('Location: http://localhost/MobileStore/AdminUpdateProductCategory.php');
}
else {
	mysql_close($conn);
	header('Location: http://localhost/MobileStore/AdminUpdateProductCategory.php');
}


?>

						
