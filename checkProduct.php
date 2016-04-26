<?php

include "dbconnect.php";
$name = $_POST['name'];
$checkParameter = $_POST['checkParameter'];

if($checkParameter == "category") {
	$query = "select productCategoryName from product_category where productCategoryName='".$name."'";
	
	$result = mysql_query($query, $conn);
	$num_rows = mysql_num_rows($result);
	
	$status = [];
	if($num_rows == 0) {
		$status['isexists'] = false;
	}
	else {
		$status['isexists'] = true;
	}
	
	$response = $status;
	header('content-type: application/json');
	echo json_encode($response);
	
} else {
	$query = "select productName from product where productName='".$name."'";
	
	$result = mysql_query($query, $conn);
	$num_rows = mysql_num_rows($result);
	
	$status = [];
	if($num_rows == 0) {
		$status['isexists'] = false;
	}
	else {
		$status['isexists'] = true;
	}
	
	$response = $status;
	header('content-type: application/json');
	echo json_encode($response);
	
}
?>