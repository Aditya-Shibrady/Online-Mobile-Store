<?php

include 'dbconnect.php';

$productName = $_POST['productName'];
$productDescription = $_POST['productDescription'];
$productPrice = floatval($_POST['productPrice']);
$productQuantity = intval($_POST['productQuantity']);
$categoryValue = $_POST['categoryValue'];
$productActiveValue = $_POST['productActiveValue'];

$query = "select max(productId) as 'productId' from product";
$result = mysql_query($query, $conn);
$id = 0;
while($row = mysql_fetch_assoc($result))
{
	$id = $row['productId'];
}
$nextProductId = intval($id + 1);
#$sql = "INSERT INTO employee ". "(emp_name,emp_address, emp_salary, join_date) ". "VALUES('$emp_name','$emp_address',$emp_salary, NOW())";

$query = "INSERT INTO product ". "(productId, productName, productDescription, productPrice, quantity, productCategoryId, active)". "VALUES ($nextProductId, '$productName', '$productDescription', $productPrice, $productQuantity, $categoryValue, '$productActiveValue')";
print $query;

$retval = mysql_query($query);
if(! $retval )
{
	echo 'Could not enter data: ' . mysql_error();
}
mysql_close($conn);
header('Location: http://localhost/MobileStore/AdminViewProduct.php');
?>

						
