<!DOCTYPE.html>
	<title>LocalPost</title>

	<!--Session Start-->
	<?php
		if(!isset($_SESSION)){
			session_start();
		}
	?>

	<!--Header-->
	<?php
		require "header.php";
	?>


	<!--Home Greeter-->
	<div class="jumbotron">
		<?php
			echo "<h3>".$_SESSION['UserName']." Homepage</h1>";
			require_once "ImageUpload.php";
		?>
	</div>


	<!--Profile Picture-->
	<div>
		<?php
			require_once "classes.php";
			require "conn.php";
			//
			//Thus starts the convoluted journey in which we retrieve from the DB ProfilePicture *shudder*
			$upp = $dbh->prepare("SELECT * FROM users WHERE UserId=:UserId LIMIT 1");//IS CONCAT LEGAL?
			$upp->execute(array('UserId'=>$_SESSION['UserId']));//ONLY 1 ROW POSSIBLE
			$ctq = $upp->fetch();
			$_SESSION['UserProfilePicture'] = $ctq['UserProfilePicture'];//SETS IS STRAIGHT
			echo "<br><img src='".$_SESSION['UserProfilePicture']."'id='HOME_PROFILE_REAL' alt='No Profile Picture' style='width:128px;height:128px'<br>";//Unrequited
		?>
	</div>

	<!--Dash Load-->
	<div>
		<?php
			require "conn.php";
			$dsh = $dbh->prepare("SELECT * FROM channels WHERE SubscriberId=:SubscriberId LIMIT 5");
			$dsh->execute(array('SubscriberId'=>$_SESSION['UserId']));
			$ara = $dsh->fetchAll();
		?>
		<ul style="list-style-type:none">
			<?php
				for($i=0; $i<$dsh->rowCount(); $i++){
					$current_post=$ara[$i];//Warning: Values are strings use ==
					//current_post prints const, do not rereference
					if($current_post['PostType']=="TextPost"){
						?>

						<?php
					} else
					if($current_post['PostType']=="ImagePost"){
						?>
						<li class="post_container">
							<div id="<?php echo 'result'.$i ?>" class="newposts" style="height:50%; width:50%;">
								<div class="post_header">
									<img href="#1" src="<?php echo $user->retrievePosterPicture($current_post['MakerId']);?>">
								</div>
								<div class="post_body">
									<img href="#2" src="<?php echo $current_post['Content']; ?>">
								</div>
								<div class="comments">
									<ul style="list-style-type:none">
									</ul>
								</div>
							</div>
						</li>
						<?php
					} else
					if($current_post['PostType']==""){
						?>

						<?php
					}
			?>

			<?php
				}
			?>
		</ul>
	</div>

	<!--UserSearch-->
	<div>
		<form enctype="multipart/form-data" method="POST" action="Home.php"><!--CAN WE USE AJAX HERE?-->
			<br>
			<input name="usersearch" type="text"></input>
			<input name="search" type="submit" value="Search for user" class="btn btn-primary-sm"></input>
		</form>
	</div>


		<!--User Search-->
		<?php
			require_once "conn.php";
			if(isset($_POST['usersearch'])){
				$ctk=$dbh->prepare("SELECT * FROM users WHERE UserName LIKE '%".$_POST['usersearch']."%' AND NOT UserId=".$_SESSION['UserId'].";");//USE LIKE REGEX
				//$ctk->bindparam(":UserName", $_POST['usersearch'], PDO::PARAM_INT);
				$ctk->execute();
				$ctk_values=$ctk->fetchAll();
				if($ctk->rowCount()==0){
					echo "Nothing found: Try more broad search terms.";
				} else {
					echo $ctk->rowCount()." users found.<br>";
		?>
				

		<!--ADD FRIEND FORM-->
		<!--JS/jQuery/AJAX Friend add-->
		<script>
			$(document).ready(function(){//So far AJAX isn't asyncn.
				$(".acceptorbutton").on("click", function(){
						var cat = parseInt($(this).prop('name'), 10);
						$.ajax({
							type:"POST",
							url:"getuser.php",
							data: {friendadd : cat},
							success: function(){
								alert("Added!");
							}
						});//Add data: and success:function
				})
			});
		</script>


		<form id="friendadd" enctype="multipart/form-data">
		

		<!--For Loop Printing out-->
		<?php
			for($i=0; $i<$ctk->rowCount(); $i++){
				echo "<th rowspan='3'><img src='".$ctk_values[$i][6]."' alt='Blank' style='width:64px;height:64px'></th>";//PP, Later add clickable profile
				echo "<tr>	".$ctk_values[$i][0]."</tr>";//UN
				echo "<tr>	".$ctk_values[$i][1]."</tr>";//UL
				echo "<tr>	".$ctk_values[$i][5]."</tr>";//UA
				$GlobalAcceptorId=$ctk_values[$i][4];
		?>
		

		<!--Invisible Display-->
		<div id="dom-target" style="display:none;">
			<?php
				echo $GlobalAcceptorId;
			?>
		</div>


		<!--Add friend button-->
				<span class="badge">
		        	<span class="glyphicon glyphicon-plus-sign">
		        		<input class="acceptorbutton" type="button" id="<?php echo $GlobalAcceptorId; ?>" name="<?php echo $GlobalAcceptorId; ?>" value="<?php echo $ctk_values[$i][0]; ?>"></input>
		        	</span>
		        </span>
		        <br>


		<?php	
			}//Ends for loop
		?>
		</form>		
		<?php
				}
			}
		?>


	<!--Random User Selection Form-->
	<div>
		<form enctype="multipart/form-data" method="POST" action="Home.php">
			<input name="imfeelinglucky" type="submit" value="I'm Feeling Lucky!" class="btn btn-primary-sm"></input>
		</form>
		<!--Add Checkbox: Limit Search to Location-->
	</div>


	<!--Random User Selection-->
	<div>
		<?php
			require_once "conn.php";
			if(isset($_POST['imfeelinglucky'])){
				$rkp=$dbh->prepare("SELECT * FROM users ORDER BY rand() LIMIT 1");
				$rkp->execute();
				$temporaryquery=$rkp->fetch();
				echo $temporaryquery['UserName'];
			}
		?>
	</div>
</html>