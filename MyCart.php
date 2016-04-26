<?php
session_start();

include 'dbconnect.php';

if(!isset($_SESSION['emailAddress']) && !isset($_SESSION['firstName']) && !isset($_SESSION['lastName']))
	header('Location: http://localhost/MobileStore/Login.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Aditya Shibrady">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <link rel="icon" href="../../favicon.ico">

    <title>The Online Mobile Store</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<script type="text/javascript" src="./js/jquery.dataTables.js"></script>
<script type="text/javascript" src="./js/validateUser.js"></script>
<link rel="stylesheet" type="text/css" href="./css/jquery.dataTables.css">

<script type="text/javascript">

$(document).ready(function() {
    $('#cart').DataTable();
});

</script>
</head>
<body><center>
<div>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.html">Online Mobile Store</a>
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="./Home.php">Home</a></li>
                    <li class="active"><a href="./MyCart.php">My Cart</a></li>
                    <li><a href="./Search.php">Search</a></li>
                    <li><a href="./OrderHistory.php">Order History</a></li>
                    <li><a href="./ViewProduct.php">Products</a></li>
                    <li><a href="./Logout.php">Logout</a></li>


                </ul>
            </div><!--/.nav-collapse --></div></div>

	<div id="section" style="height: 500px !important">
		<br><br><h2> My Cart </h2><br><br>
		<div id="searchResult">
			<table id="cart" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Product Name</th>
				<th>Product Description</th>
				<th>Product Category</th>
				<th>Price</th>
				<th>Available Quantity</th>
				<th>Enter Quantity</th>
				<th>Checkout</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				include 'dbconnect.php';
				
				$email = $_SESSION['emailAddress'];
				$query = "select * from  user_history, product, product_category where product_category.productCategoryId = product.productCategoryId and active='true' and user_history.emailAddress = '$email' and user_history.isCheckedOut = 'false' and user_history.productId = product.productId";
				#echo $query;
				$result = mysql_query($query, $conn);
				while($row = mysql_fetch_assoc($result))
				{
                    $tableRow = "<tr align='center'>";
                    $tableData = "<td>".$row['productName']."</td><td>".$row['productDescription']."</td><td>".$row['productCategoryName']."</td><td>".$row['productPrice']."</td><td>".$row['quantity']."</td><td><input type='text' id='quantity".$row['productId']."' name='quantity".$row['productId']."' value='0' /></td>";
                    $tableButton="<td><input type='button' name='addToCart".$row['productId']."' id='addToCart".$row['productId']."' value='Checkout' onclick='validateCheckOutForm(\"".$row['productId']."\",\"".$email."\",\"".$row['historyId']."\",\"".$row['quantity']."\")'/></td></tr>";
                    $tableFinalRow = $tableRow.$tableData.$tableButton;
                    echo $tableFinalRow;
				}
				mysql_close($conn);
			?>
			
			</tbody>
		</table>
		</div>
		
		<div>
		<form id="checkoutForm" method="post" action="checkoutItem.php">
			<input type="hidden" name="quantity" id="quantity" />
			<input type="hidden" name="productId" id="productId" />
			<input type="hidden" name="historyId" id="historyId" />
		</form>
		</div>
	</div>

<div id="footer"><span class="glyphicon glyphicon-copyright-mark" aria-hidden=true></span> mobilestore.com</div></center>

</body>
</html>