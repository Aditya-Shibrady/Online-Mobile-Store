<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">

	<title>The Online Mobile Store</title>

	<!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

	<!-- Custom styles for this template -->
	<link href="./css/carousel.css" rel="stylesheet">
	<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="./js/validateUser.js"></script>
<title>Login</title>
</head>
<body style="background-color: #e3e0cf"><center><br><br>
    <div class="navbar-wrapper">
        <div class="container">

            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="./index.html">Online Mobile Store</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="./login.php">Login</a></li>
                            <li><a href="./Signup.html">Register</a></li>
                            <li><a href="./ViewProduct.php">Products</a></li>
                            <li><a href="./MyCart.php">My Cart</a></li>
                            <li><a href="./Logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
    </div><center><br><br><br><h2>Login</h2>
	<div>
		<div id="error" style="display: block; padding-top: 100px !important">
			<font color="red"><?php if( isset($_GET['msg'])) { print "Username or Password do not match";} ?> </font>
		</div>

		<form id="loginForm" name="loginForm" method="post" action="Authenticate.php">
			<fieldset style="width: 400px">
				<table>
					<tbody>
						<tr>
							<td><input style="background-color: #c5d5cb" class="form-control" placeholder="Email ID" type="text" name="email" id="email" >
						</tr>
						<tr>
							<td><input style="background-color: #c5d5cb" class="form-control" type="password" name="password" id="password" placeholder="Password">
						</tr>
						<tr>
							<td><center><button type="button" class="btn btn-xs btn-success" value="Login" onclick="validateLoginForm()">Login</button><button type="button" value="Signup" class="btn btn-xs btn-primary" onclick="redirectToSignup()" />Signup</button></center>
							</td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</form>
        <br><br><br>

	</div>

	<div id="footer"><span class="glyphicon glyphicon-copyright-mark" aria-hidden=true></span> mobilestore.com</div></center>
</center>
</body>
</html>
