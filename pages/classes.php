<?php

	if(!isset($_SESSION)){
		session_start(); //This is necessary above every file that uses session variables!
	}
	
	class user {

		private $UserId, $UserName, $UserMail, $UserPassword, $Age, $UserLocation, $UserProfilePicture; //$ disappear when referring to characteristic $this->UserName

		public function getUserId(){
			return $this->UserId;//Called in UserLogin.php with object $user
		}
		public function setUserId($UserId){//$UserId is equal to $_POST['UserId']
			$this->UserId=$UserId;
		}

		public function getUserName(){
			return $this->UserName;
		}
		public function setUserName($UserName){//Where the substitution takes place
			$this->UserName=$UserName;
		}

		public function getUserMail(){
			return $this->UserMail;
		}
		public function setUserMail($UserMail){
			$this->UserMail=$UserMail;
		}

		public function getUserPassword(){
			return $this->UserPassword;
		}
		public function setUserPassword($UserPassword){
			$this->UserPassword=$UserPassword;
		}

		public function getAge(){
			return $this->Age;
		}
		public function setAge($Age){
			$this->Age=$Age;
		}

		public function getUserLocation(){
			return $this->UserLocation;
		}
		public function setUserLocation($UserLocation){
			$this->UserLocation=$UserLocation;
		}

		public function getUserProfilePicture(){
			return $this->UserProfilePicture;
		}
		public function setUserProfilePicture($UserProfilePicture){
			$this->UserProfilePicture=$UserProfilePicture;
		}
	
		public function validlogin(){
			require_once "conn.php";//LOCALSCOPE
			$req=$dbh->prepare("SELECT * FROM users WHERE UserMail=:UserMail AND UserPassword=:UserPassword");//:thepassword
			$req->execute(array(
				'UserMail'=>$this->getUserMail(),
				'UserPassword'=>$this->getUserPassword()
				));
			if($req->rowCount()==0){//None matched, 0 selected
				//header("Location: ../index.php?error=1");
				//echo "<script type='text/javascript'>alert('Incorrect Email or Password.');</script>";
				header("Location: ../index.php?error=1");
				//exit();
				//echo "<script>window.location='../index.php?error=1';</script>";
				return false;
			}
			else{
				while($data=$req->fetch()){//Fetches closest row from table
					//echo '<script>alert("A");</script>';
					$this->setUserId($data['UserId']);
					$this->setUserName($data['UserName']);
					$this->setUserPassword($data['UserPassword']);
					$this->setAge($data['Age']);
					$this->setUserMail($data['UserMail']);
					$this->setUserLocation($data['UserLocation']);
					//FIND OUT HOW TO FRIEND THIS
					//$this->setUserIdLocation($data['UserId']);//PROFILE PICTURE SET
					header("Location: Home.php");
					return true;
				}
			}
		}
		public function InsertUser(){//prepare($sql, keypair array)
			require_once "conn.php";
			$res=$dbh->prepare("SELECT * FROM users WHERE UserName=:UserName");
			$res->execute(array('UserName'=>$this->getUserName()));
			if($res->rowCount()==0){
				$red=$dbh->prepare("INSERT INTO users(UserName, UserPassword, UserMail, Age, UserLocation, UserProfilePicture) VALUES (:UserName, :UserPassword, :UserMail, :Age, :UserLocation, :UserProfilePicture)");		
				$red->execute(array(
					'UserName'=>$this->getUserName(),
					'UserPassword'=>$this->getUserPassword(),
					'UserMail'=>$this->getUserMail(),
					'Age'=>$this->getAge(),
					'UserLocation'=>$this->getUserLocation(),
					'UserProfilePicture'=>'uploads/blank.jpg'
					));
				return 1;
			} else{
				return 0;
			}
		}
		public function addProfilePicture(){
			require "conn.php";//Used to be require_once
			$sql=$dbh->prepare("UPDATE users SET UserProfilePicture=:UserProfilePicture WHERE UserName=:UserName;");
			$sql->execute(array(
				'UserProfilePicture'=>$this->getUserProfilePicture(),
				'UserName'=>$_SESSION['UserName'],
				));
		}
		public function retrievePosterPicture($requestedUserId){
			require "conn.php";
			$mpp=$dbh->prepare("SELECT * FROM users WHERE UserId=:UserId LIMIT 1;");
			$mpp->execute(array(
				'UserId'=>$requestedUserId
				));
			$maker_data=$mpp->fetch();
			return $maker_data['UserProfilePicture'];
		}
	};

?>