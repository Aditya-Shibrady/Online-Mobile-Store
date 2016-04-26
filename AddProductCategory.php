<?php

include 'dbconnect.php';

$productCategoryName = $_POST['productCategoryName'];
$productCategoryActiveValue = $_POST['categoryActiveValue'];

$query = "select max(productCategoryId) as 'productCategoryId' from product_category";
$result = mysql_query($query, $conn);
$id = 0;
while($row = mysql_fetch_assoc($result))
{
	$id = $row['productCategoryId'];
}
$nextProductId = intval($id + 1);

$query = "INSERT INTO product_category ". "(productCategoryId, productCategoryName, categoryActive)". "VALUES ($nextProductId, '$productCategoryName', '$productCategoryActiveValue')";
#print $query;

$retval = mysql_query($query);
if(! $retval )
{
	echo 'Could not enter data: ' . mysql_error();
}
mysql_close($conn);
header('Location: http://localhost/MobileStore/AdminViewProductCategory.php');
?>

						
