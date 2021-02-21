<!DOCTYPE html>
<html>

<head>
	<title>Lab Task 2</title>

	 <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
	
	<?php  
		$name= $email = $date = $gender = $degree = $blood = "";
		$nameErr= $emailErr = $dateErr = $genderErr = $degreeErr = $bloodErr = "";

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			//Name Check
			if (empty($_POST["name"])) {
    			$nameErr = "This cannot be empty";
  			}
  			else if (str_word_count($_POST["name"]) < 2) {
        		$nameErr = "Name should contain at least two words.";
        	}
        	else if (!preg_match("/^[a-z ,.'-]+$/i", $_POST["name"])) {
        		$nameErr = "Must start with a letter and can contain a-z, A-Z, period, dashonly.";
    		}
        	else {
        		$name = test_input($_POST["name"]);
    		}

    		//Email Check
    		if (empty($_POST["email"])) {
        		$emailErr = "This cannot be empty";
    		} else {
        		$email = test_input($_POST["email"]);
        		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            		$emailErr = "Invalid email format";
        		}
    		}

    		//Date Check
    		if (empty($_POST["dd"]) || empty($_POST["mm"]) || empty($_POST["yyyy"])) {
        		$dateErr = "Invalid birth date";
    		}

    		//Gender check
    		if (empty($_POST["gender"])) {
        		$genderErr = "Gender is required";
    		}
    		else {
        		$gender = test_input($_POST["gender"]);
    		}

    		//Degree Check
    		$count = 0;
    		foreach ($_POST['check_list'] as $selected) {
        		$count = $count + 1;
    		}
    		if ($count < 2) {
        		$degreeErr = "At least two degree must be selected";
    		}

    		//blood check
    		$count = 0;
    		 if ($_POST["gender"] == null) {
        		$bloodErr = "Must be selected";
    		}
		}

		function test_input($data)
		{
		    $data = trim($data);
		    $data = stripslashes($data);
		    $data = htmlspecialchars($data);
		    return $data;
		}
	?>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		Name:
		<input type="text" name="name"><br>
		<span class="error"><?php echo $nameErr; ?></span><br>
		
		Email:
		<input type="email" name="email"><br>
		<span class="error"><?php echo $emailErr; ?></span><br>
		
		Date Of Birth:
		<p>dd / mm / yyyy</p><br>
		<input type="number" id="dd" name="dd" min="1" max="31">
		<input type="number" id="mm" name="mm" min="1" max="12">
		<input type="number" id="yyyy" name="yyyy" min="1953" max="1998">
		<span class="error"><?php echo $dateErr; ?></span><br>

		Gender:
		<input type="radio" name="gender" value="female">Male
        <input type="radio" name="gender" value="male">Female
        <input type="radio" name="gender" value="other">Other<br>
        <span class="error"><?php echo $genderErr; ?></span><br>

        Degree:
        <input type="checkbox" id="ssc" name="check_list[]" value="ssc">
        <label for="ssc"> SSC</label>
        <input type="checkbox" id="hsc" name="check_list[]" value="hsc">
        <label for="hsc"> HSC</label>
        <input type="checkbox" id="bsc" name="check_list[]" value="bsc">
        <label for="bsc"> BSc</label>
        <input type="checkbox" id="msc" name="check_list[]" value="msc">
        <label for="msc"> MSc</label><br>
        <span class="error"><?php echo $degreeErr; ?></span><br>

        Blood Group:
        <select name="bg" id="bg">
            <option value="null"></option>
            <option value="a+">A+</option>
            <option value="b+">B+</option>
            <option value="a-">A-</option>
            <option value="b-">B-</option>
        </select>
        <span class="error"><?php echo $bloodErr; ?></span><br>

		<input type="submit" name="submit" value="Submit"><br>
	</form>

</body>
</html>
