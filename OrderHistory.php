<?php
session_start();


include 'dbconnect.php';
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
<link rel="stylesheet" type="text/css" href="./css/jquery.dataTables.css">
<script type="text/javascript">

$(document).ready(function() {
    $('#orderHistoryTable').DataTable();
});

</script>
</head>
<body>
<center><div>
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
                        <li><a href="./MyCart.php">My Cart</a></li>
                        <li><a href="./Search.php">Search</a></li>
                        <li  class="active"><a href="./OrderHistory.php">Order History</a></li>
                        <li><a href="./ViewProduct.php">Products</a></li>
                        <li><a href="./Logout.php">Logout</a></li>


                    </ul>
                </div><!--/.nav-collapse --></div></div>
        <br><h2>Order History</h2><br><br>
	<div id="section" style="height: 500px !important">
		<table id="orderHistoryTable" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Product Name</th>
				<th>Product Description</th>
				<th>Product Category</th>
				<th>Product Price</th>
				<th>Quantity</th>
				<th>Checkout Date</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				$email = $_SESSION['emailAddress'];
				
				$query = "select * from  user_history, product, product_category where emailAddress='$email' and product.productId = user_history.productId and user_history.isCheckedOut = 'true' and product_category.productCategoryId = product.productCategoryId";
				
				$result = mysql_query($query, $conn);
				mysql_query($query);
				while($row = mysql_fetch_assoc($result))
				{
					//echo $row['productId'];
					echo "<tr align='center'><td>".$row['productName']."</td><td>".$row['productDescription']."</td><td>".$row['productCategoryName']."</td><td>".$row['buyQuantity']."</td><td>".$row['totalCost']."</td><td>".$row['checkoutDate']."</td></tr>";
				}
				mysql_close($conn);
			?>
			</tbody>
		</table>
	</div>

    <div id="footer"><span class="glyphicon glyphicon-copyright-mark" aria-hidden=true></span> mobilestore.com</div></center>

</body>
</html>