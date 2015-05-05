<?php
	try{
		$dbh = new PDO ("mysql:dbname=network; host=127.0.0.1", "root", "phpmyadmin");
	} catch(PDOException $e){
		echo "Connection has failed: ".$e->getMessage();
	}
?>