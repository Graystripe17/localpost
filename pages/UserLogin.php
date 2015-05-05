<?php
	require_once "classes.php";
	if(!isset($_SESSION)){
		session_start(); //This is necessary above every file that uses session variables!
	}
	$aPost = $_POST;
	$aPost['UserMailLogin']=$_POST['UserMailLogin'];
	$aPost['UserPasswordLogin']=$_POST['UserPasswordLogin'];
	if(!empty($aPost['UserMailLogin']) && !empty($aPost['UserPasswordLogin'])){//Grab by name
		$user = new user(); //Adds an object
		$user->setUserMail($aPost['UserMailLogin']);
		$user->setUserPassword(sha1($aPost['UserPasswordLogin']));
		if($user->validlogin()==true){
			$_SESSION['UserName']=$user->getUserName();//Use -> when left is object, :: otherwise, => to assign key-value pairs in assoc array
			$_SESSION['UserMail']=$user->getUserMail();
			$_SESSION['UserId']=$user->getUserId();
			$_SESSION['Age']=$user->getUserAge();
			$_SESSION['UserLocation']=$user->getUserLocation();
			$_SESSION['UserProfilePicture']=$user->getUserProfilePicture();
		}
	}
	if(!empty($_SESSION['UserId'])){
		echo "You're logged in!";
	}
	var_dump($_SESSION);
?>