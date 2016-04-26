<?php 

include "dbconnect.php";
$productId = intval($_POST['productId']);
$inputEmailAddress = $_POST['email'];

$query = "INSERT INTO user_history ". "(emailAddress, productId, isCheckedOut)". "VALUES ('$inputEmailAddress', '$productId', 'false')";
$retval = mysql_query($query);
$status = [];
if(! $retval )
{
	$status['isSuccessful'] = false;
} else {
	$status['isSuccessful'] = true;
}
mysql_close($conn);

$response = $status;
header('content-type: application/json');
echo json_encode($response);

?>