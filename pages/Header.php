<!--Front-end imports-->
<head>
	<link rel="stylesheet" type="text/css" href="header.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js">
	<script type="text/javascript" src=".../Js/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/bootstrap-dropdown.js"></script>
</head>

<?php
	if(!isset($_SESSION)){
		session_start(); //This is necessary above every file that uses session variables!
	}
	require "classes.php";
?>

<script type="text/javascript">
	//Profile
		document.getElementById("myBtn").addEventListener("click", function(){
			document.getElementById("demo").innerHTML = "Hello World";
		});
		$('.dropdown-toggle').dropdown(){
			alert("DBug");
		}
		$('#myDropdown').on('show.bs.dropdown', function(){
			alert("adorakitty");
		})
</script>


<!--NAVIGATION BAR-->
<nav class="navbar navbar-default">
<div class="container-fluid">
	<div class="navbar-header">
		<a class="navbar-brand" href="Home.php">LocalPost</a>
	</div>
	<ul class="nav navbar-nav">
		<li class="active"><a href="#">Home</a></li>
		<li>
			<div class="dropdown">
			   <button class="btn btn-default dropdown-toggle" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			     <shadow>;D BAE</shadow>
			     <span class="caret"></span>
			   </button>
			   <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			     <li role="presentation"><a data-toggle="tab" href="#">Yo</a></li>
			     <li role="presentation"><a data-toggle="tab" href="#">Yo</a></li>
			     <li role="presentation" class="divider"></li>
			     <li role="presentation"><a role="menuitem" tabindex="-1">CAT</a>
			   </ul>
			</div>
		</li>
		<li><a href="#Chats">Node Chat</a></li>
		<li><a href="javascript:void(0)" onclick="Profile();">Dash</a></li>
		<li><a href="Profile.php">Profile</a></li>
		<li><a href="http://google.com">Share</a></li>
		<li><a href="#Mail"><span class="glyphicon glyphicon-envelope"></span></a></li>
		<li><a href="">Recommend Features</a></li>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	</ul>
<div align="right">
	<a href="logout.php" class="button btn-danger">LOG OUT</a>
</div>
</div>