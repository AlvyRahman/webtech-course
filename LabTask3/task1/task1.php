<!DOCTYPE html>
<html>

<head>
	<title>Task 1</title>

	 <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
	<?php  
		$name = $pass = " ";
		$nameErr= $passErr = " ";

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			//---Name Check---
			if (str_word_count($_POST["name"]) < 2) {
        		$nameErr = "Name should contain at least two words.";
        	}
        	else if (!preg_match("/^[a-zA-Z0-9,.-_ ]*$/", $_POST["name"])) {
        		$nameErr = "Name can contain alpha numeric characters, period, dash or underscore only";
    		}
    		else{
    			$name = $_POST["name"];
    		}

    		//---password check---
    		if (strlen($_POST["pass"]) <= 8) {
        		$passErr = "Your Password Must Contain At Least 8 Characters!";
    		}
    		else if(!preg_match("/^[@#$%]*$/", $_POST["pass"])) {
    			$passErr = "Your Password must contain at least one of the special characters (@, #, $,%)";
    		}
    		else{
    			$pass = $_POST["pass"];
    		}
		}
	?>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		User Name:
		<input type="text" name="name"><br>
		<span class="error"><?php echo $nameErr; ?></span><br>
		Password:
		<input type="password" name="pass"><br>
		<span class="error"><?php echo $passErr; ?></span><br>
		<input type="checkbox" name="remeberMe">
		<label for="remeberMe"> Remeber Me </label><br>
		<input type="submit" name="submit">
		<a href="url">Forgot password?</a>
	</form>
</body>
</html>
