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
<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="./css/index.css">
<link rel="stylesheet" type="text/css" href="./css/jquery.dataTables.css">
<title>My Order History</title>
<script type="text/javascript">

$(document).ready(function() {
    $('#categoryTable').DataTable();
});

</script>
</head>
<body>
	<?php include 'AdminLeftNav.php'; ?>
	
	<div id="section" style="height: auto; !important">
		<h4>All Products Categories Inventory</h4>
		<table id="categoryTable" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Product Category Id</th>
				<th>Product Category Name</th>
				<th>Is Product Category Active</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				$query = "select * from  product_category";
				$result = mysql_query($query, $conn);
				while($row = mysql_fetch_assoc($result))
				{
					echo "<tr align='center'><td>".$row['productCategoryId']."</td><td>".$row['productCategoryName']."</td><td>".$row['categoryActive']."</td></tr>";
				}
				mysql_close($conn);
			?>
			</tbody>
		</table>
	</div>

	<div id="footer">Copyright � techstore.com</div>

</body>
</html>