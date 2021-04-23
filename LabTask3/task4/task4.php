<?php
    $name = $email = $userName = $password = $confirmPassword = $gender = $dob = "";
    $ok = 1;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST[$name]; 
        $email = $_POST[$email];
        $gender = $_POST[$gender];
        $userName = $_POST[$userName];
        $password = $_POST[$password];
        $confirmPassword = $_POST[$confirmPassword];
        $dob = array($_POST[$day], $_POST[$month], $_POST[$year]);
        
        /*if (empty($name)) {
            echo "<span class='error'>*Name cannot be empty*</span><br>";
            $ok = 0;
        }*/
        if (str_word_count($name) < 2) {
            echo "<span class='error'>*Name must conttain at least two words*</span><br>";
            $ok = 0;
        }
        else if (!preg_match("/^[a-z A-Z ,.'-]+$/", $name)) {
            echo "<span class='error'>*Name must start with a letter and can contain a-z, A-Z, period, dash only*</span><br>";
            $ok = 0;
        }

        if ($password != $confirmPassword) {
            echo "<span class='error'>*Password and Confirm Password have to match*</span><br>";
            $ok = 0;
        }

        if (empty($email) || empty($password) || empty($confirmPassword || empty($userName) || empty($gender) || empty($dob))) {
            echo "<span class='error'>*None of the fields can be empty*</span><br>";
            $ok = 0;
        }

        if($ok && file_exists('data.json')){
            $ar = array('name' =>  $name, 'email' => $email, 'userName' => $userName, 'password' => $password, 'confirmPassword' => $confirmPassword, 'gender' => $gender);

            $fp = fopen('data.json', 'w');
            fwrite($fp, json_encode($ar));
            fclose($fp);

            echo "Done!";
        }
    }
?>

<html>
<head>
	<title>Task 4</title>

	<style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h2>Registation Page</h2><br>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        Name: <input type="text" name="name" id="name" value="Enter your Name"><br><br>
        E-mail: <input type="text" name="email" id="email" value="your email"><br><br>
        User Name: <input type="text" name="userName" id="userName" value="Enter your User Name"><br><br>
        Password: <input type="password" name="password" id="password" ><br><br>
        Confirm Password: <input type="Password" name="confirmPassword" id="confirmPassword"><br><br>
        Gender:
        <input type="radio" name="gender"  value="male">Male
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender"  value="other">Other<br><br>
        Date of birth:
        <input type="number" id="dd" name="day" min="1" max="31" value="dd">
		<input type="number" id="mm" name="month" min="1" max="12" value="mm">
		<input type="number" id="yyyy" name="year" min="1953" max="2000" value="yyyy">
        (dd/mm/yyyy)<br><br>
        <input type="submit" value="submit" name="submit"><br>
    </form>
</body>
</html>
