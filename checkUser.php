<?php 

include "dbconnect.php";
$inputEmailAddress = $_POST['email'];

$query = "select emailAddress from  user where emailAddress='".$inputEmailAddress."'";

$result = mysql_query($query, $conn);
$num_rows = mysql_num_rows($result);

$status = [];
if($num_rows == 0) {
	$status['isexists'] = false;
}
else {
	$status['isexists'] = true;
}
#mysql_close($conn);
$response = $status;
header('content-type: application/json');
echo json_encode($response);

?>