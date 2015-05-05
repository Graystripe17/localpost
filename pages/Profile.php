<!DOCTYPE.html>
	<link rel="stylesheet" type="text/css" href="profile.css">
	<title>LocalPost | Profile</title>

	<!--Header-->
	<?php
		require "Header.php";
	?>

	<?php
		$Lone_Profile = new user();
		$Profile_View_User_Id = $_SESSION['UserId'];
	?>

	<img src="<?php echo $Lone_Profile->retrievePosterPicture($Profile_View_User_Id); ?>">


	<div class="panel panel-default">
		<div class="panel-body">Edit Line</div>
		<div class="panel-body">Edit Description</div>
		<div class="panel-body">Edit </div>
	</div>


	<div id="topbar">
		<div id="topbar-content" class="span12 user">
			<ul id="leftside" class="menu pull-left">
				<li class="home">
					<a href="javascript:;"></a>
				</li>
				<li class="blankspace">
				</li>
			</ul>
		</div>
	</div>

	<div class="">

	</div>
</html>