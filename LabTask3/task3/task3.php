<?php 
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}

		//size check
		if ($_FILES["fileToUpload"]["size"] > 4000000) {
			echo "File size should not be more than 4 mb.";
			$uploadOk = 0;
		}

		//format check
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG files are allowed.";
			$uploadOk = 0;
		}

		//show image
		if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir)) 
		{
			echo "<img src=".$target_dir." height=200 width=300 />";
		} 
		else 
		{
			echo "Error !!";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Task 3</title>

	<style>
        .error {
            color: red;
        }
    </style>
</head>
<body>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
		<input type="file" name="fileToUpload" id="fileToUpload"><br>
		<input type="submit" value="Upload Image" name="submit"><br>
	</form>
</body>
</html>
