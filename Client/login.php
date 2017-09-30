<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $mypassword= md5($mypassword);
      
      $sql = "SELECT UserID FROM users WHERE Username = '$myusername' and Password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['myusername']="something";
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="CSS/Login.css" />
</head>

<body>


    <div class="Top background">
        <form action = "" method = "POST">
            <h1> Sign In </h1>

            <input type="text" placeholder="username" name="username">
            <input type="password" placeholder="Confirm Password" name="password">
            <input type="submit" name="submit" value="Sign In">
            <p> New to Teamanager ? <a href="register.php">register here</a></p>

            <td colspan="2" align="center" class="error" ><?php echo $error;?></td>
        </form>


    </div>
    <div class="Bottom"></div>

    <body>

</html>