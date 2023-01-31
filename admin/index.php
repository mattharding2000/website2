<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	$sql ="SELECT email,password FROM admin WHERE email='$email' and password='$password'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result))
	{
		$_SESSION['alogin']=$_POST['email'];
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
	} else{
  		echo "<script>alert('Invalid Details');</script>";
	}	
}
?>
<!DOCTYPE html>
<!-- Designined by CodingLab - youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Admin Panel </title>
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container" style="width:300px">
    <div class="title">Admin Login</div>
    <div class="content" style="width:500px">
      <form action="" method="POST" >
        <div class="user-details">
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" placeholder="Enter your email" name="email" required>
            <br><br>
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" name="password" required>
            <div class="button">
              <input type="submit" value="Login" name="login">
            </div>
          </div>
        </div>
        
      </form>
    </div>
  </div>

</body>
</html>
