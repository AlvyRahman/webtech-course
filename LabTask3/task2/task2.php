<!DOCTYPE html>
<html>

<head>
	<title>Task 2</title>

	 <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
	<?php
		$currPass = $newPass = $retypeNewPass = " ";
		$newPassErr = $retypeNewPassErr = " ";

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			if ($_POST["currPass"] == $_POST["newPass"]) {
				$newPassErr = "New Password should not be same as the Current Password";
			}
			else if ($_POST["retypeNewPass"] != $_POST["newPass"]) {
				$retypeNewPassErr = "New Password must match with the Retyped Password";
			}
			else{
				$currPass = $newPass;
			}
		}
	?>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		Current Password:
		<input type="Password" name="currPass"><br>

		New Password:
		<input type="Password" name="newPass"><br>
		<span class="error"><?php echo $newPassErr;?></span><br>

		Retype New Password:
		<input type="Password" name="retypeNewPass"><br>
		<span class="error"><?php echo $retypeNewPassErr;?></span><br>

		<input type="submit" name="submit"><br>

		<?php  
			/*echo $currPass;
			echo $newPass;
			echo $retypeNewPass;
			echo $newPassErr;
			echo $retypeNewPassErr;*/
		?>
	</form>
</body>
</html>
