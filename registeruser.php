<?php 

include 'dbconnect.php';

$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$gender = $_POST['genderval'];
$phnumber = $_POST['phnumber'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$password = $_POST['password'];
$zipcode = $_POST['zipcode'];

print $email;
echo $fname;

$query = "INSERT INTO user (emailAddress, firstName, lastName, gender, phoneNumber, address, password, city, state, zipCode) VALUES ('$email', '$fname', '$lname', '$gender', '$phnumber', '$address', '$password', '$city', '$state', '$zipcode')";
print $query;

mysql_query($query);
mysql_close($conn);
header('Location: http://localhost/MobileStore/Login.php');

?>