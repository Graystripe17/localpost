<!DOCTYPE.html>
	<form enctype="multipart/form-data" action="Home.php" method="POST"><!--Encoding type client-side-->
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" name="submit" value="Upload Image">
	</form>
		<?php
			require_once "classes.php";
			require_once "InsertUser.php";
			$target_dir="uploads/";
			$target_file=$target_dir.basename($_FILES["fileToUpload"]["name"]);
			$uploadsuccess=1;
			$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
			$check=getimagesize($_FILES['fileToUpload']['tmp_name']);
				//Isrealimage
				if(isset($_POST['submit'])){	
					if($check!==false){
						echo "File is an image - ".$check["mime"].".";
						$uploadsuccess=1;
					} else {
						echo "File is not an image.";
						$uploadsuccess=0;
					}
					
					//VALIDATION
					if(file_exists($target_file)){
						echo " File Exists";
						$uploadsuccess=0;
					}
					//FILE SIZE
					if($_FILES['fileToUpload']['size']>500000){
						echo " File too large";
						$uploadsuccess=0;
					}
					//FILE TYPE
					if($imageFileType!="jpg" && $imageFileType!="png" && $imageFileType!="jpeg" && $imageFileType!="gif"){
						echo " Please only upload: <bold>JPG  JPEG  PNG  GIF";
						$uploadsuccess=0;
					}

					if($uploadsuccess&&move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)){
						echo " The file ".basename($_FILES['fileToUpload']['name'])." has been uploaded.";
						$user->setUserProfilePicture($target_file);//Updates object
						$_SESSION['UserProfilePicture']=$user->getUserProfilePicture();//Updates session
						$user->addProfilePicture();//Updates DB
						if($user->getUserProfilePicture()!=NULL){
							echo '<img src="'.$target_file. '" alt="nom">';
						}
					} else {
						echo "<br>Sorry, there was an error uploading your file.";
					}
				}
		?>
</html>