<?php
session_start();

include "dbconnect.php";
$inputEmailAddress = $_SESSION['emailAddress'];
$productId = intval($_POST['productId']);
$historyId = $_POST['historyId'];
$quantity = $_POST['quantity'];

#echo $inputEmailAddress."...".$productId."...".$quantity.".......".$historyId;
$getCostQuery = "select productPrice, quantity from product where productId=".$productId;
$result = mysql_query($getCostQuery, $conn);
$price = 0;
while($row = mysql_fetch_assoc($result))
{
	$price = $row['productPrice'];
	$availableProductQuantity = $row['quantity'];
}



$totalCost = floatval($quantity) * $price;
//emailAddress productId checkoutDate buyQuantity isCheckedOut totalCost historyId
$query = "update user_history set checkoutDate=now(), buyQuantity = ".$quantity.", isCheckedOut='true', totalCost='$totalCost' where historyId=".$historyId."";

$retval = mysql_query($query);
if(! $retval )
{
	echo 'Could not enter data: ' . mysql_error();
}
$newquantity = $availableProductQuantity - $quantity;

$updateInventoryQuery = "update product set quantity=".$newquantity." where productId=".$productId;
$retval = mysql_query($updateInventoryQuery);
if(! $retval )
{
	echo 'Could not enter data: ' . mysql_error();
}
header('Location: http://localhost/MobileStore/Payment.php');
?>