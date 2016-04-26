function validateAddProductCategoryForm() {
	var categoryName = document.getElementById("productCategoryName").value;
	document.getElementById("categoryActiveValue").value = document.getElementById("categoryActive").options[document.getElementById("categoryActive").selectedIndex].value;
	if(categoryName == "") {
		$("#productCategoryName").focus();
		$("#error").html("<font color=\"red\"> Please enter Product Category Name. </font>");
		return false;
		
	} else {
		$.ajax({
			url : "http://localhost/MobileStore/checkProduct.php",
			type: 'POST',
			async: false,
	        data: { "name": categoryName, "checkParameter": "category"} ,
			success : function(data) {
				if(data.isexists) {
					$("#productCategoryName").focus();
					$("#error").html("<font color=\"red\"> Product Category Already Exists! </font>");
					return false;
				} else {
					$("#AddProductCategoryForm").submit();
				}
			},
			error : function() {
				alert("error while sending request please try again after some tine");
				return "false";
			}
		});
	}
}

function validateUpdateProductCategoryForm() {
	var categoryName = document.getElementById("productCategoryName").value;
	document.getElementById("categoryActiveValue").value = document.getElementById("categoryActive").options[document.getElementById("categoryActive").selectedIndex].value;
	if(categoryName == "") {
		$("#categoryName").focus();
		$("#error").html("<font color=\"red\"> Please enter Product Category Name. </font>");
		return false;
		
	} else {
		$("#UpdateProductCategoryForm").submit();
	}
}

function showUpdateProductCategoryForm(categoryId, categoryName, active) {
	document.getElementById("productCategoryId").value = categoryId;
	document.getElementById("productCategoryName").value = categoryName;
	document.getElementById("categoryActive").value = active;
	document.getElementById("categoryActiveValue").value = active;
	document.getElementById("productCategoryUpdateAction").value = "update";
	document.getElementById("updateProductCategoryFormDiv").style.display = "block";
}

function confirmDeleteProductCategoryForm(productCategoryId) {
	document.getElementById("productDeleteCategoryId").value = productCategoryId;
	document.getElementById("productCategoryDeleteAction").value = "delete";
	var result = confirm("Are you sure Want to delete this category?");
	if (result == true) {
		$("#DeleteProductCategoryForm").submit();
	}
}

function validateAddProductForm() {
	var productName = document.getElementById("productName").value;
	var productDescription = document.getElementById("productDescription").value;
	document.getElementById("categoryValue").value = document.getElementById("productCategory").options[document.getElementById("productCategory").selectedIndex].value;
	var productPrice =  document.getElementById("productPrice").value;
	var quantity = document.getElementById("productQuantity").value;
	document.getElementById("productName").value = productName;
	document.getElementById("productActiveValue").value = document.getElementById("productActive").options[document.getElementById("productActive").selectedIndex].value;
	var regexDecimalNumber = /^\d+\.\d{0,2}$/;
	
	if(productName == "") {
		$("#productName").focus();
		$("#error").html("<font color=\"red\"> Please enter Product Name. </font>");
		return false;
		
	} else if(productDescription == "") {
		$("#productDescription").focus();
		$("#error").html("<font color=\"red\"> Please enter Product Description. </font>");
		return false;
		
	} else if(productPrice == "") {
		$("#productDescription").focus();
		$("#error").html("<font color=\"red\"> Please enter Product Price. </font>");
		return false;
		
	} else if(!productPrice.match(regexDecimalNumber)) {
		$("#productDescription").focus();
		$("#error").html("<font color=\"red\"> Please enter valid Price. </font>");
		return false;
		
	} else if(quantity == "") {
		$("#productDescription").focus();
		$("#error").html("<font color=\"red\"> Please enter product Quantity. </font>");
		return false;
		
	} else if(!quantity.match(/\d/g)) {
		$("#productDescription").focus();
		$("#error").html("<font color=\"red\"> Please enter valid product Quantity. </font>");
		return false;
		
	} else {
		$.ajax({
			url : "http://localhost/MobileStore/checkProduct.php",
			type: 'POST',
			async: false,
	        data: { "name": productName, "checkParameter": "product"} ,
			success : function(data) {
				if(data.isexists) {
					$("#productName").focus();
					$("#error").html("<font color=\"red\"> Product Already Exists! </font>");
					return false;
				} else {
					$("#AddProductForm").submit();
				}
			},
			error : function() {
				alert("error while sending request please try again after some time");
				return "false";
			}
		});
		//$("#AddProductForm").submit();
	}
}

function showUpdateProductForm(productId, productName, productDescription, productCategoryId, productPrice, quantity, active) {
	document.getElementById("productId").value = productId;
	document.getElementById("productName").value = productName;
	document.getElementById("productDescription").value = productDescription;
	document.getElementById("productCategory").value = productCategoryId;
	document.getElementById("categoryValue").value = productCategoryId;
	document.getElementById("productPrice").value = productPrice;
	document.getElementById("productQuantity").value = quantity;
	document.getElementById("productActive").value = active;
	document.getElementById("productActiveValue").value = active;
	document.getElementById("productUpdateAction").value = "update";
	document.getElementById("updateFormDiv").style.display = "block";
}

function validateUpdateProductForm() {
	var productName = document.getElementById("productName").value;
	var productDescription = document.getElementById("productDescription").value;
	document.getElementById("categoryValue").value = document.getElementById("productCategory").options[document.getElementById("productCategory").selectedIndex].value;
	var productPrice =  document.getElementById("productPrice").value;
	var quantity = document.getElementById("productQuantity").value;
	document.getElementById("productName").value = productName;
	document.getElementById("productActiveValue").value = document.getElementById("productActive").options[document.getElementById("productActive").selectedIndex].value;
	var regexDecimalNumber = /^\d+\.?\d{0,2}?$/;
	
	if(productName == "") {
		$("#productName").focus();
		$("#error").html("<font color=\"red\"> Please enter Product Name. </font>");
		return false;
		
	} else if(productDescription == "") {
		$("#productDescription").focus();
		$("#error").html("<font color=\"red\"> Please enter Product Description. </font>");
		return false;
		
	} else if(productPrice == "") {
		$("#productDescription").focus();
		$("#error").html("<font color=\"red\"> Please enter Product Price. </font>");
		return false;
		
	} else if(!productPrice.match(regexDecimalNumber)) {
		$("#productDescription").focus();
		$("#error").html("<font color=\"red\"> Please enter valid Price. </font>");
		return false;
		
	} else if(quantity == "") {
		$("#productDescription").focus();
		$("#error").html("<font color=\"red\"> Please enter product Quantity. </font>");
		return false;
		
	} else if(!quantity.match(/\d/g)) {
		$("#productDescription").focus();
		$("#error").html("<font color=\"red\"> Please enter valid product Quantity. </font>");
		return false;
		
	} else {
		$("#UpdateProductForm").submit();
	}
}

function confirmDeleteProductForm(productId ) {
	document.getElementById("productDeleteId").value = productId;
	document.getElementById("productDeleteAction").value = "delete";
	var result = confirm("Are you sure Want to delete this category?");
	if (result == true) {
		$("#DeleteProductForm").submit();
	}
	
}
