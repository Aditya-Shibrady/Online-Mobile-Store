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

    <!-- Reference Libraries -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="./js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="./js/validateUser.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/jquery.dataTables.css">


<script type="text/javascript">
$(document).ready(function() {
    $('#searchTable').DataTable();
});
</script>
</head>
<body><center><div>
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
                <li  class="active"><a href="./Search.php">Search</a></li>
                <li><a href="./OrderHistory.php">Order History</a></li>
                <li><a href="./ViewProduct.php">Products</a></li>
                <li><a href="./Logout.php">Logout</a></li>


            </ul>
        </div><!--/.nav-collapse --></div></div>

	<div id="section" style="height: auto !important">
		<br><h2> Search Product </h2><br><br>
		<form id="SearchProductForm" name="form" method="post" action="Search.php">
			<div id="error"></div>
			<fieldset style="width: 500px">

				<table>
					<tbody>
						<tr>
							<td>Name: </td>
							<td> <input type="text" name="productName"
								id="productName"></td>
						</tr>
						
						<tr>
							<td>Price in $ </td>
							<td><input type="text" name="productPriceLower"
								id="productPriceLower"> to <input type="text" name="productPriceHigher"
								id="productPriceHigher"></td>
						</tr>
						
						<tr>
							<td>Category:</td>
							<td>
								<select id="productCategory" name="productCategory">
									<option value="-1">Select a Category</option>
									<?php 
										$query = "select * from  product_category where categoryActive='true'";
										$result = mysql_query($query, $conn);
										while($row = mysql_fetch_assoc($result))
										{
											echo "<option value='".$row['productCategoryId']."'>".$row['productCategoryName']."</option>";
										}
										mysql_close($conn);
									?>
								</select>
								<input type="hidden" id="categoryValue" name="categoryValue" value="-1"/>
							</td>
						</tr>
						



					</tbody>
				</table>
			</fieldset>
		</form>
        <br>
        <button type="button" class="btn btn-xs btn-success" value="Search"
                onclick="validateSearchProductForm()" />Search</button><br><br>
		
		<?php 
		if(isset($_POST['productName']) && isset($_POST['productPriceLower']) && isset($_POST['productPriceHigher']) && isset($_POST['categoryValue'])) {
			$productName = 	$_POST['productName'];
			$productPriceLower = intval($_POST['productPriceLower']);
			$productPriceHigher = intval($_POST['productPriceHigher']);
			$categoryValue = intval($_POST['categoryValue']);
		?>
		
		<div id="searchResult">

			<table id="searchTable" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Product Name</th>
				<th>Product Description</th>
				<th>Product Category</th>
				<th>Product Price</th>
				<th>Available Quantity</th>
				<th>Add to Cart</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				include 'dbconnect.php';
				
				$email = $_SESSION['emailAddress'];
				$query = "select * from  product, product_category where product_category.productCategoryId = product.productCategoryId and active='true' ";
				if($productName != "")
					$query = $query."and product.productName like '%".$productName."%'";
				else if($categoryValue != -1 && $categoryValue != 0)
					$query = $query."and product.productCategoryId=".$categoryValue." ";
				else if($productPriceLower != 0)
					$query = $query."and product.productPrice >=".$productPriceLower." ";
				else if($productPriceHigher != 0)
					$query = $query."and product.productPrice <=".$productPriceHigher." ";
				
				//echo $query;
				//$query = "select * from  product, product_category where product_category.productCategoryId = product.productCategoryId";
				$result = mysql_query($query, $conn);
				while($row = mysql_fetch_assoc($result))
				{
					$tableRow = "<tr align='center'><td>".$row['productName']."</td><td>".$row['productDescription']."</td><td>".$row['productCategoryName']."</td><td>".$row['productPrice']."</td><td>".$row['quantity']."</td>";
					$pId = intval($row['productId']);
					
					$checkProductInCartQuery = "select productId from user_history where user_history.emailAddress = '$email' and user_history.isCheckedOut = 'false' and productId=".$pId."";
					$checkResult = mysql_query($checkProductInCartQuery, $conn);
					
					$num_rows = mysql_num_rows($checkResult);
					$tableUpdateButton = "";
					if($num_rows == 0) {
						$tableUpdateButton = "<td><input type='button' name='addToCart'  id='addToCart".$row['productId']."' value='addToCart' onclick='addProductToCart(\"".$row['productId']."\",\"".$email."\")'/></td></tr>";
					}
					else {
						$tableUpdateButton = "<td>Item Already added to cart</td></tr>";
					}
					
					$tableFinalRow = $tableRow.$tableUpdateButton;
					echo $tableFinalRow;
				}
				mysql_close($conn);
			?>
			
			</tbody>
		</table>
		
		
		</div>
		<?php } ?>
	</div>
</center>

</body>
</html>