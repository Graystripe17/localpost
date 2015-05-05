<?php
	require_once "imageUpload.php";
	require_once "classes.php";
	$user = new user();//INSTANTIATE OBJECT
	if(isset($_POST['UserName']) && isset($_POST['UserMail']) && isset($_POST['UserPassword'])){
		$user->setUserName($_POST['UserName']);
		$user->setUserMail($_POST['UserMail']);
		$user->setUserPassword(sha1($_POST['UserPassword']));
		if(isset($_POST['Age'])){
			$user->setAge($_POST['Age']);
		}

		$user->setUserLocation($_POST['UserLocation']);

		if(isset($_POST['UserLocation'])){
			$user->setUserLocation($_POST['UserLocation']);
		} else{
			$user->setUserLocation("On this website");
		}

		if(!$user->InsertUser()){
			//PHP cannot output an echo and then use a redirect. Use Output Buffering
			//While output buffering on, only header outputs make it through, others stored internally
			//End flush ends obmode and dumps internal buffer			
			echo '<META HTTP-EQUIV=REFRESH CONTENT="1; ../index.php">';
			echo "<script type='text/javascript'>alert('UserName already exists.');</script>";
		} else{
			header("Location: ../index.php?success=1");
			exit();
		}
	}
?>