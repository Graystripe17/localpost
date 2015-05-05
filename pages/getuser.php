<?php
	if(!isset($_SESSION)){
		session_start();
	}
	require "conn.php";
	//Brase yourselves... SQL is coming
	//Later add a tracking algorithm
	$unique = $dbh->prepare(
		"SELECT * FROM friends 
		WHERE (AskerId=:AskerId AND AcceptorId=:AcceptorId) 
		OR (AskerId=:AcceptorId AND AcceptorId=:AskerId AND mutual=true)
		");
	$unique->execute(array(
			'AskerId'=>$_SESSION['UserId'],
			'AcceptorId'=>$_POST['friendadd']
		));
	if($unique->rowCount()==0){//Does this bond already exist?
		$mutual = $dbh->prepare(//Did the acceptor already friend the asker?
			"SELECT * FROM friends
			WHERE (AskerId=:AcceptorId AND AcceptorId=:AskerId AND mutual=false)
			");
		$mutual->execute(array(
			'AskerId'=>$_SESSION['UserId'],
			'AcceptorId'=>$_POST['friendadd']
			));
		if($mutual->rowCount()==0){
			$gtu = $dbh->prepare("INSERT INTO friends (AskerId, AcceptorId, mutual, type) VALUES(:AskerId, :AcceptorId, :mutual, :type)");
			$gtu->execute(array(
				'AskerId'=>$_SESSION['UserId'],
				'AcceptorId'=>$_POST['friendadd'],
				'mutual'=>false,
				'type'=>'friend'
				));
		} else {//Flip the switch to mutual
			$update = $dbh->prepare(
				"UPDATE friends
				SET mutual=true
				WHERE (AskerId=:AskerId AND AcceptorId=:AcceptorId AND mutual=false)
				OR (AskerId=:AcceptorId AND AcceptorId=:AskerId AND mutual=false)
				");
			$update->execute(array(
				'AskerId'=>$_SESSION['UserId'],
				'AcceptorId'=>$_POST['friendadd']
				));
		}
	}
?>