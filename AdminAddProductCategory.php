<?php
session_start();

include 'dbconnect.php';

if(!isset($_SESSION['emailAddress']) && !isset($_SESSION['firstName']) && !isset($_SESSION['lastName']))
	header('Location: http://localhost/MobileStore/Login.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" type="text/css" href="./css/index.css">
<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="./js/validateAdmin.js"></script>
<title>Add Product Category</title>
<script type="text/javascript">
</script>
</head>
<body>
	<?php include 'AdminLeftNav.php'; ?>

	<div id="section" style="height: 500px !important">
		<h4> Add Product Category </h4>
		<div id="error"></div>
		<form id="AddProductCategoryForm" name="form" method="post" action="AddProductCategory.php">
			<fieldset style="width: 500px">
				<legend>Product Category:</legend>
				<table>
					<tbody>
						<tr>
							<td>Enter Category Name: </td>
							<td><input type="text" name="productCategoryName"
								id="productCategoryName"></td>
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
						<tr>
							<td colspan="1" align="center"><input type="button" value="Add Category"
								onclick="validateAddProductCategoryForm()" /></td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</form>
	</div>

	<div id="footer">Copyright � techstore.com</div>

</body>
</html>