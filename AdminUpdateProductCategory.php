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
						<li class="active"><a href="./AdminUpdateProductCategory.php">Product Category</a></li>
						<li><a href="./AdminAddProduct.php">Add Product</a></li>
						<li><a href="./AdminViewProduct.php">View Product</a></li>
						<li><a href="./AdminUpdateProduct.php">Edit Product</a></li>
						<li><a href="./Logout.php">Logout</a></li>
					</ul>
				</div><!--/.nav-collapse --></div></div>
	
	<div id="section" style="height: auto !important">
		<div id="updateProductCategoryFormDiv" style="display: None;">
		<h2> Update Product </h2>
		<div id="error"></div>
		<form id="UpdateProductCategoryForm" name="form" method="post" action="UpdateProductCategory.php">
			<fieldset style="width: 500px">
				<legend>Product Category:</legend>
				<table>
					<tbody>
						<tr>
							<td>Enter Category Name: </td>
							<td><input type="text" name="productCategoryName"
								id="productCategoryName"><input type="hidden" name="productCategoryId"
								id="productCategoryId"><input type="hidden" name="productCategoryUpdateAction"
								id="productCategoryUpdateAction" value="update"></td>
						</tr>
						<tr>
							<td>Is Active (Active category will be diaplayed while Adding Product)</td>
							<td>
								<select id="categoryActive">
									<option value="true">true</option>
									<option value="false">false</option>
								</select>
								<input type="hidden" id="categoryActiveValue" name="categoryActiveValue"/>
							</td>
						</tr>

					</tbody>
				</table>
                <br>
                <button type="button" class="btn btn-xs btn-success" value="Update Category"
                        onclick="validateUpdateProductCategoryForm()" />Update</button>
			</fieldset>
		</form>
		</div>
		<div id="deleteProductCategoryDiv" style="display: none;">
			<form id="DeleteProductCategoryForm" name="form" method="post" action="UpdateProductCategory.php">
				<input type="hidden" name="productDeleteCategoryId" id="productDeleteCategoryId">
				<input type="hidden" name="productCategoryDeleteAction" id="productCategoryDeleteAction" value="delete">
			</form>
		</div>
		<br><h2>Product Categories</h2><br><br>
		<table id="productsTable" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Product Category Id</th>
				<th>Product Category Name</th>
				<th>Is Product Category Active</th>
				<th>Update Product Category</th>
				<th>Delete Product Category</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				$query = "select * from  product_category ";
				$result = mysql_query($query, $conn);
				while($row = mysql_fetch_assoc($result))
				{
					//echo $row['productId'];
					#".$row['productId']", ".$row['productName'].", ".$row['productDescription'].", ".$row['productCategoryName'].", ".$row['productPrice'].", ".$row['quantity'].", "$row['active']."
					$tableRow = "<tr align='center'><td>".$row['productCategoryId']."</td><td>".$row['productCategoryName']."</td><td>".$row['categoryActive']."</td>";
					$tableUpdateButton = "<td><input type='button' name='updateProductCategory'  id='updateProduct' value='Update' onclick='showUpdateProductCategoryForm(\"".$row['productCategoryId']."\",\"".$row["productCategoryName"]."\",\"".$row['categoryActive']."\")'/></td>";
					$tableDeleteButton = "<td><input type='button' name='deleteProductCategory'  id='deleteProduct' value='Delete' onclick='confirmDeleteProductCategoryForm(\"".$row['productCategoryId']."\")'/></td></tr>";
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