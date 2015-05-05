<!DOCTYPE.html>
	<!-- Stylesheets --> 
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> 
	<link rel="stylesheet" type="text/css" href="header.css"> 

	<!-- Scripts --> 
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
	<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	

	<!--Add Modals Later-->

		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="pages/uploads/Hamster.jpg">
		    </div>
		    <div class="item">
		      <img src="pages/uploads/sample1.jpg">
		    </div>
		    <div class="item">
		      <img src="pages/uploads/sample2.jpg">
		    </div>
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>



		<head>
				<title>LocalPost</title>
		</head>
		<body>
			<div>
				<?php
					//include_once "header.css";
				?>
			</div>
			<div id="LoginDiv" class="hot">
				<form method="POST" action="pages/UserLogin.php">
					<table>
							<tr><td>Email: </td><td><input type="email" name="UserMailLogin" /></td></tr>
							<tr><td>Password: </td><td><input type="password" name="UserPasswordLogin" /></td></tr>
							<tr><td><button type="submit" name="submit" class="btn btn-info">Log in</input></td></tr>
							<?php
								if(isset($_GET['error'])){
							?>
								<tr><td></td><td><span style="color:red" class="bg-danger">Incorrect Email or Password</span>
							<?php
								}
							?>
					</table>
				</form>
			</div>
			</br>
			</br>
			</br>
				<div id="SignUpDiv">
					<form method="POST" action="pages/InsertUser.php">
						<table>
							<tr><td>*Username: </td><td><input type="text" name="UserName" /></td></tr>
							<tr><td>*Password: </td><td><input type="password" name="UserPassword" pattern=".{6,}" required title="6 characters minimum" /></td></tr>
							<tr><td>*Email: </td><td><input type="email" name="UserMail" /></td><tr>
							<tr><td> Age: </td><td><input type="number" name="Age" /></td><tr>
							<tr><td> Location: </td><td><input type="text" name="UserLocation" /></td><tr>
							<tr><td><input type="submit" value="Create Account!" name="submit" class="btn btn-warning"/><td></tr>

							<?php
								if(isset($_GET['success'])){
							?>
							<tr>
								<td></td><td><span style="color:green" class="bg-success">Success!</span></td>
							</tr>
							<?php
								}
							?>
				
						</table>

						<!--We just testing out cURL-->
						<?php
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, "http://www.downdrops.com");
							curl_exec($ch);
							curl_close($ch);
						?>
		</body>
	</html>
