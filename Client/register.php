<?php

	include ("config.php");	

	
	if(isset($_POST["submit"]))
	{
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$email = $_POST["email"];
		$myusername = $_POST["username"];
		$mypassword = $_POST["password"];
		$confirmpassword = $_POST["confirm"];

		$firstname = mysqli_real_escape_string($db, $firstname);
		$lastname = mysqli_real_escape_string($db, $lastname);
		$email = mysqli_real_escape_string($db, $email);
		$myusername = mysqli_real_escape_string($db, $myusername);
		$mypassword = mysqli_real_escape_string($db, $mypassword);
		$mypassword= md5($mypassword);
		
		$id = rand(0,10000);
		
		
		$sql="SELECT Username FROM users WHERE Username='$myusername'";
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		if(mysqli_num_rows($result) == 1)
		{
			$msg = "Sorry...This username already exist...";
		}
		else
		{
			$query = mysqli_query($db, "INSERT INTO users (UserID,Firstname,Lastname,Username,Password,Email)VALUES ('$id','$firstname','$lastname','$myusername','$mypassword','$email')");
			if($query)
			{
				$msg = "Thank You! you are now registered.";
				sleep(3);
				header("location:login.php");
				exit();


			}
		}
	}
?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>Create your account</title>
    <link rel="stylesheet" href="CSS/register.css" />
</head>

<body>


    <div class="Top background">
        <form method="post" action="">
            <h1> Register </h1>
            <input type="text" placeholder="Firstname" name="firstname">
            <input type="text" placeholder="Lastname" name="lastname">
            <input type="email" placeholder="Email" name="email">
            <input type="text" placeholder="username" name="username">
            <input type="password" placeholder="Password" name="password">
            <input type="password" placeholder="Confirm Password" name="confirm">

            <input type="submit" name="submit" value="Join">
			
        </form>






    </div>
    <div class="Bottom"></div>
			<td colspan="2" align="center" class="error" ><?php echo $msg;?></td>
    <body>

</html>