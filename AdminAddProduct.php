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
<script type="text/javascript" src="./js/validateAdmin.js"></script>
<script type="text/javascript">
</script>
</head>
<body>
<center>
	<div id="nav">
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
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="./AdminHome.php">Home</a></li>
						<li><a href="./AdminUpdateProductCategory.php">Product Category</a></li>
						<li class="active"><a href="./AdminAddProduct.php">Add Product</a></li>
						<li><a href="./AdminViewProduct.php">View Product</a></li>
						<li><a href="./AdminUpdateProduct.php">Edit Product</a></li>
						<li><a href="./Logout.php">Logout</a></li>
					</ul>
				</div><!--/.nav-collapse --></div></div>

	<div id="section" style="height: 500px !important">
		<br><h2>Add Product</h2><br><br>
		<form id="AddProductForm" name="form" method="post" action="AddProduct.php">
			<div id="error"></div>
			<fieldset style="width: 500px">
				<table>
					<tbody>
						<tr>
							<td>Product Name: </td>
							<td><input type="text" name="productName"
								id="productName"></td>
						</tr>
						
						<tr>
							<td>Product Description: </td>
							<td><textarea rows="2" cols="10" name="productDescription" id="productDescription"> </textarea></td>
						</tr>
						
						<tr>
							<td>Product Price: </td>
							<td><input type="text" name="productPrice"
								id="productPrice"></td>
						</tr>
						
						<tr>
							<td>Product Quantity: </td>
							<td><input type="text" name="productQuantity"
								id="productQuantity"></td>
						</tr>
						
						<tr>
							<td>Product Category:</td>
							<td>
								<select id="productCategory" name="productCategory">
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
								<input type="hidden" id="categoryValue" name="categoryValue"/>
							</td>
						</tr>
						
						<tr>
							<td>Active</td>
							<td>
								<select id="productActive" name="productActive">
									<option value="true">true</option>
									<option value="false">false</option>
								</select>
								<input type="hidden" id="productActiveValue" name="productActiveValue"/>
							</td>
						</tr>
					</tbody>
				</table>
				<br>
				<button type="button" class="btn btn-xs btn-success" value="Add Product"
						onclick="validateAddProductForm()" />Add Product</button>
			</fieldset>
		</form>
	</div>

	<div id="footer"><span class="glyphicon glyphicon-copyright-mark" aria-hidden=true></span> mobilestore.com</div></center>

</body>
</html>