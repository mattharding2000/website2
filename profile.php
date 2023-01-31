<?php
session_start();
include('config.php');
if(strlen($_SESSION['user'])==0)
  { 
    header('location:index.php');
  }
  else{
    if(isset($_POST['update']))
    {
      $fname=$_POST['name'];
      $mobile=$_POST['phone'];
      $email=$_POST['email']; 
      $sql="UPDATE User SET fullname='$fname', mobile='$mobile', email='$email'";
      
      if(mysqli_query($conn,$sql))
      {
        echo "<script>alert('Successfully Updated');</script>";
      }else{
        echo "<script>alert('Something went wrong. Please try again');</script>";
      }
    }
?>
<!DOCTYPE html>
<html lang="">
<head>
<title>Celestial Agency</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<!-- Top Background Image Wrapper -->
<div class="bgded" style="background-image:url('images/87-872287_hd-modeling-photography-background.jpg');"> 
  <div class="wrapper row1">
  <div class="row hoc">
      <div class="col-sm-12">
      <div id="logo" class="col-sm-6" style="margin-top: 15px; margin-bottom: 15px; ">
        <img src="images/logo.jpg" style="width: 100px; height: 100px;"/>
      </div>
      <div id="quickinfo" class="col-sm-6" style="padding: 40px 0; text-align: center;">
        <div class="col-sm-6">
          <strong>Tel:</strong><br>
            +00 (123) 456 7890
        </div>
        <div class="col-sm-6">
          <strong>Mail:</strong><br>
            company@gmail.com
        </div>
      </div></div>
    </div>
    <nav id="mainav" class="hoc clear"> 
      <ul class="clear">
      <li class="active"><a href="index.php">Home</a></li>
          <li><a  href="index.php">About Us</a></li>
          <li><a href="index.php">Services</a></li>
          <li><a href="index.php">Products</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="index.php">Team</a></li>
          <li><a href="index.php">Contact Us</a></li>
      </ul>
    </nav>
  </div>
  
  
  
  <div class="wrapper">
    <div id="breadcrumb" class="hoc clear">
      <h6 class="heading">Profile</h6>
      <a href="logout.php" class="btn" style="background:#9D8D65;color:white;height:40px; width:100px; border:1px solid white; border-radius:10px" >
      Logout
  </a>
    </div>
  </div>
  
</div>
<!-- End Top Background Image Wrapper -->



<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="group">
      <div class="row">
        <div class="col-sm-12">
          <div id="comments">
            <?php 
            $uid=$_SESSION['user'];
            $c=0;
            $sql = "SELECT *  from user WHERE id='$uid'";
            $result=mysqli_query($conn, $sql);
            if(mysqli_num_rows($result))
            {
              while ($row = mysqli_fetch_assoc($result))
              { 
                ?>
                <form action="" method="post" id="profile"  class="tabcontent">
                  <h2>Profile Settings</h2>
                  <div class="col-sm-4">
                    <label for="name">Full Name <span>*</span></label>
                    <input type="text" name="name" id="name" value="<?php echo htmlentities($row['fullname']);?>" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="email">Phone <span>*</span></label>
                    <input type="text" name="phone" id="phone" value="<?php echo htmlentities($row['mobile']);?>" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="comment">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlentities($row['email']);?>" required>
                  </div>
                  <div class="col-sm-12">
                    <input type="submit" name="update" value="Update" style="background:#9D8D65;color:white;">
                  </div>
                </form>
                <?php 
              }
            } 
            ?>
          </div>
        </div>
        <div class="col-sm-12">
        <hr>
        <div id="meeting">
              <h2>Meeting Details</h2>
              <div class="scrollable">
                <table>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php 
                      $uid=$_SESSION['user'];
                      $c=0;
                      $sql = "SELECT *  from meeting WHERE user_id='$uid'";
                      $result=mysqli_query($conn, $sql);
                      if(mysqli_num_rows($result))
                      {
                        while ($row = mysqli_fetch_assoc($result))
                        { $c++;
                          ?>
                            <td><?php echo htmlentities($c);?></td>
                            <td><?php echo htmlentities($row['date']);?></td>
                            <td><?php echo htmlentities($row['time']);?></td>
                            <td><?php echo htmlentities($row['details']);?></td>
                            <?php 
                        }
                      } 
                      ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
  </main>
</div>

<div class="wrapper row4 bgded overlay" style="background-color: black;" id="Contact">
  <footer id="footer" class="hoc clear"> 
    <div class="one_third first">
      <h6 class="heading">get in Touch</h6>
      <ul class="nospace btmspace-30 linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          Street Name &amp; Number, Town, Postcode/Zip
          </address>
        </li>
        <li><i class="fa fa-phone"></i> +00 (123) 456 7890</li>
        <li><i class="fa fa-fax"></i> +00 (123) 456 7890</li>
        <li><i class="fa fa-envelope-o"></i> info@domain.com</li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="heading">Contact us</h6>
      
      <form method="post" action="#">
        <fieldset>
          <legend>Newsletter:</legend>
          <input class="btmspace-15" type="text" value="" placeholder="Name" style="background: white;">
          <input class="btmspace-15" type="text" value="" placeholder="Name" style="background: white;">
          <input class="btmspace-15" type="text" value="" placeholder="Email" style="background: white;">
          <button type="submit" value="submit">Submit</button>
        </fieldset>
      </form>
    </div>
    <div class="one_third">
      <h6 class="heading">Our company</h6>
      <ul class="nospace linklist">
        <li>
          <article>
            <h2 class="nospace font-x1"><a href="#">Vivamus cursus ante sed</a></h2>
            <time class="font-xs block btmspace-10" datetime="2045-04-06">Friday, 6<sup>th</sup> April 2045</time>
            <p class="nospace">Quis sem suscipit dapibus aenean malesuada vel tortor in consectetur [&hellip;]</p>
          </article>
        </li>
        <li>
          <article>
            <h2 class="nospace font-x1"><a href="#">Tempus iaculis augue</a></h2>
            <time class="font-xs block btmspace-10" datetime="2045-04-05">Thursday, 5<sup>th</sup> April 2045</time>
            <p class="nospace">Morbi nulla elit dictum vitae nibh id elementum vehicula tellus mauris [&hellip;]</p>
          </article>
        </li>
      </ul>
    </div>
  </footer>
</div>




<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    
  </div>
</div>



<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>
<?php
}?>