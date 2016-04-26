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
<script type="text/javascript" src="./js/validateAdmin.js"></script>
<link rel="stylesheet" type="text/css" href="./css/jquery.dataTables.css">
<script type="text/javascript">

$(document).ready(function() {
    $('#productsTable').DataTable();
});

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
                        <li><a href="./AdminAddProduct.php">Add Product</a></li>
                        <li><a href="./AdminViewProduct.php">View Product</a></li>
                        <li class="active"><a href="./AdminUpdateProduct.php">Edit Products</a></li>
                        <li><a href="./Logout.php">Logout</a></li>
                    </ul>
                </div><!--/.nav-collapse --></div></div>
	
	<div id="section" style="height: auto !important">
		<div id="updateFormDiv" style="display: None;">
		<br><br><h2> Update Product </h2><br>
		<div id="error"></div>
		<form id="UpdateProductForm" name="form" method="post" action="UpdateProduct.php">
			<fieldset style="width: 500px">
				<table>
					<tbody>
						<tr>
							<td>Enter Product Name: </td>
							<td><input type="text" name="productName"
								id="productName"><input type="hidden" name="productId"
								id="productId"><input type="hidden" name="productUpdateAction" id="productUpdateAction" value="update"></td>
						</tr>
						
						<tr>
							<td>Enter Product Description: </td>
							<td><textarea rows="2" cols="10" name="productDescription" id="productDescription"> </textarea></td>
						</tr>
						
						<tr>
							<td>Enter Product Price: </td>
							<td><input type="text" name="productPrice"
								id="productPrice"></td>
						</tr>
						
						<tr>
							<td>Enter Product Quantity: </td>
							<td><input type="text" name="productQuantity"
								id="productQuantity"></td>
						</tr>
						
						<tr>
							<td>Select Product Category:</td>
							<td>
								<select id="productCategory" name="productCategory">
									<?php 
										$query = "select * from  product_category where categoryActive='true'";
										$result = mysql_query($query, $conn);
										while($row = mysql_fetch_assoc($result))
										{
											echo "<option value='".$row['productCategoryId']."'>".$row['productCategoryName']."</option>";
										}
									?>
								</select>
								<input type="hidden" id="categoryValue" name="categoryValue"/>
							</td>
						</tr>
						
						<tr>
							<td>Is Active</td>
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
                <button type="button" class="btn btn-xs btn-success" value="Update Product"
                        onclick="validateUpdateProductForm()" />Update</button>
			</fieldset>
		</form>
		</div>
		
		<div id="deleteProductDiv" style="display: none;">
			<form id="DeleteProductForm" name="form" method="post" action="UpdateProduct.php">
				<input type="hidden" name="productDeleteId" id="productDeleteId">
				<input type="hidden" name="productDeleteAction" id="productDeleteAction" value="delete">
			</form>
		</div>
		
		<br><h2>All Products Listing</h2><br><br>
		<table id="productsTable" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Product Id</th>
				<th>Product Name</th>
				<th>Product Description</th>
				<th>Product Category</th>
				<th>Product Price</th>
				<th>Quantity</th>
				<th>Is Product Active</th>
				<th>Update Product</th>
				<th>Delete Product</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				$query = "select * from  product, product_category where product_category.productCategoryId = product.productCategoryId";
				$result = mysql_query($query, $conn);
				while($row = mysql_fetch_assoc($result))
				{
					//echo $row['productId'];
					#".$row['productId']", ".$row['productName'].", ".$row['productDescription'].", ".$row['productCategoryName'].", ".$row['productPrice'].", ".$row['quantity'].", "$row['active']."
					$tableRow = "<tr align='center'><td>".$row['productId']."</td><td>".$row['productName']."</td><td>".$row['productDescription']."</td><td>".$row['productCategoryName']."</td><td>".$row['productPrice']."</td><td>".$row['quantity']."</td><td>".$row['active']."</td>";
					$tableUpdateButton = "<td><input type='button' name='updateProduct'  id='updateProduct' value='Update' onclick='showUpdateProductForm(\"".$row['productId']."\",\"".$row["productName"]."\",\"".$row['productDescription']."\",\"".$row['productCategoryId']."\",\"".$row['productPrice']."\",\"".$row['quantity']."\",\"".$row['active']."\")'/></td>";
					$tableDeleteButton = "<td><input type='button' name='deleteProduct'  id='deleteProduct' value='Delete' onclick='confirmDeleteProductForm(\"".$row['productId']."\")'/></td></tr>";
					$tableFinalRow = $tableRow.$tableUpdateButton.$tableDeleteButton;
					echo $tableFinalRow;
				}
				mysql_close($conn);
			?>
			
			</tbody>
		</table>
		
		
	</div>

    <div id="footer"><span class="glyphicon glyphicon-copyright-mark" aria-hidden=true></span> mobilestore.com</div></center>

</body>
</html>