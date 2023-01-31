<?php
session_start();
require_once("config.php");
if(isset($_POST['login']))
{
  $email=$_POST['lemail'];
  $pass=md5($_POST['lpass']);
  $sql ="SELECT * FROM user WHERE email='$email' and password='$pass'";
  $result=mysqli_query($conn, $sql);
	if(mysqli_num_rows($result))
	{
    $_SESSION['login']=$_POST['lemail']; 
    while($row = mysqli_fetch_assoc($result)){
      $_SESSION['user']=$row['id'];
    }
    $currentpage='profile.php';
    echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
  } else{
    echo "<script>alert('Invalid Details');</script>";
  }
}

if(isset($_POST['reg']))
{
  $fname=$_POST['fname'];
  $mobile=$_POST['mobile'];
  $email=$_POST['remail']; 
  $password=md5($_POST['rpass']); 
  $sql="INSERT INTO  user(`fullname`, `mobile`, `email`, `password`) VALUES('$fname','$mobile','$email','$password')";
  
  if(mysqli_query($conn,$sql))
  {
    echo "<script>alert('Registration successfull. Now you can login');</script>";
  }else{
    echo "<script>alert('Something went wrong. Please try again');</script>";
  }
}

  //Contact Form- Sending Email 
  use PHPMailer\PHPMailer\PHPMailer;

  require_once 'phpmailer/Exception.php';
  require_once 'phpmailer/PHPMailer.php';
  require_once 'phpmailer/SMTP.php';

  $mail = new PHPMailer(true);

  $alert = '';

  if(isset($_POST['submit'])){
    $name = $_POST['yourname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try{
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'your@gmail.com'; // Gmail address which you want to use as SMTP server
      $mail->Password = 'password'; // Gmail address Password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = '587';

      $mail->setFrom('your@gmail.com'); // Gmail address which you used as SMTP server
      $mail->addAddress('example@gmail.com'); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

      $mail->isHTML(true);
      $mail->Subject = 'Message Received (Contact Page)';
      $mail->Body = "<h3>Name : $name <br>Email: $email <br>Message : $message</h3>";

      $mail->send();
      echo "<script>alert('Thank you for contacting us.');</script>";
    } catch (Exception $e){
      echo "<script>alert('Somthing went wrong. please try again shortly.');</script>";
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
<div class="bgded" style="background-image:url('images/Halloween-2.jpg');"> 
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
          <li class="active"><a href="index.html">Home</a></li>
          <li><a  href="#aboutUS">About Us</a></li>
          <li><a href="#Services">Services</a></li>
          <li><a href="#Products">Products</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="#Team">Team</a></li>
          <li><a href="#Contact">Contact Us</a></li>
        </ul>
      </nav>
  </div>

  <div id="pageintro" class="hoc clear"> 
    <article>
      <p>Celestial Agency</p>
      <h3 class="heading">Where dreams take flight</h3>
      <div class="inspace-10 borderedbox" style="height: auto;width: 400px; margin-left: auto; margin-right: auto;">
        <div class="tab">
          <button class="tablinks" onclick="openCity(event, 'loginfm')">Login</button>
          <button class="tablinks" onclick="openCity(event, 'regfm')">Register</button>
        </div>
        
          <form id="loginfm" class="tabcontent" method="post" action="">
            <h4 class="">Login</h4>
            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control" id="exampleInputEmail1" name="lemail" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="lpass" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary" name="login">Submit</button>
          </form>
          <form id="regfm" class="tabcontent" method="post" action="">
            <h4 class="">Register</h4>
            <div class="form-group">
              <label for="fname">Full Name</label>
              <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter Full Name">
            </div>
            <div class="form-group">
              <label for="fname">Mobile</label>
              <input type="text" class="form-control" id="mobile"  name="mobile" length="11" placeholder="Enter Mobile Number">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control" id="exampleInputEmail1" name="remail" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="rpass" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary" name="reg">Submit</button>
          </form>
      </div>
      
    </article>
  </div>
</div>
<style>
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: none;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #9D8D65;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: none;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  text-align: left;
}
</style>
<script>
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  </script>
     
<div class="wrapper row3" id="aboutUS">
  <main class="hoc container clear"> 
    <div class="sectiontitle">
      <h6 class="heading">We Offer</h6>
      <p>Justo vel tortor in vitae nisl ut commodo mattis.</p>
    </div>
    <ul class="nospace group services">
      <li class="one_third first">
        <article><a href="#"><i class="icon btmspace-30 fa fa-ioxhost"></i></a>
          <h6 class="heading">Sem ut rhoncus</h6>
          <p>Litora torquent per conubia nostra per inceptos himenaeos sed sodales augue ut dui rhoncus finibus [&hellip;]</p>
          <footer><a href="#">Read More</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article><a href="#"><i class="icon btmspace-30 fa fa-ioxhost"></i></a>
          <h6 class="heading">Risus blandit class</h6>
          <p>Ut sit amet vestibulum eros in imperdiet ipsum nulla non varius justo suspendisse nisi tortor [&hellip;]</p>
          <footer><a href="#">Read More</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article><a href="#"><i class="icon btmspace-30 fa fa-ioxhost"></i></a>
          <h6 class="heading">Aptent taciti sociosqu</h6>
          <p>Condimentum et magna malesuada bibendum justo mauris pulvinar erat eget nisl volutpat malesuada [&hellip;]</p>
          <footer><a href="#">Read More</a></footer>
        </article>
      </li>
    </ul>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<div class="wrapper row2">
  <section class="hoc container clear"> 
    <div class="sectiontitle">
      <h6 class="heading">About Us</h6>
      <p>Congue arcu id lacus vehicula iaculis curabitur.</p>
    </div>
    <div class="group">
      <div class="one_half first">
        <p>Et varius nunc id ornare erat donec eget gravida justo nulla et dui erat phasellus gravida iaculis neque sit amet.</p>
        <p class="btmspace-50">Lacinia fusce ac enim posuere mauris finibus elementum quisque quis convallis quam quisque rhoncus placerat urna a malesuada morbi aliquet risus a ultrices pulvinar.</p>
        <ul class="nospace group">
          <li class="one_half first">
            <article><a href="#"><i class="icon btmspace-30 fa fa-joomla"></i></a>
              <h6 class="heading font-x1">Eros libero semper</h6>
              <p>Arcu mauris nullam sed feugiat orci dignissim metus interdum fermentum donec ut elit </p>
            </article>
          </li>
          <li class="one_half">
            <article><a href="#"><i class="icon btmspace-30 fa fa-institution"></i></a>
              <h6 class="heading font-x1">Purus ac varius</h6>
              <p>Quis velit ullamcorper ornare ut sit amet nunc maecenas aliquet ex et dui pharetra a </p>
            </article>
          </li>
        </ul>
      </div>
      <div class="one_half"><img class="inspace-10 borderedbox" src="images/photo-2copy.jpg" alt=""></div>
    </div>
  </section>
</div>

<div class="wrapper bgded overlay" style="background-image:url('images/photo-4.jpg');" id="Services">
  <section class="hoc container clear"> 
    <div class="sectiontitle">
      <h6 class="heading">Our Services</h6>
      <p>Sagittis dui pulvinar nullam sit amet cursus eros.</p>
    </div>
    <ul class="nospace group">
      <li class="one_quarter first">
        <article><a href="#"><i class="icon btmspace-30 fa fa-ioxhost"></i></a>
          <h6 class="heading font-x1">Consectetur metus</h6>
          <p>Vel lorem tristique semper cum sociis natoque penatibus et magnis dis parturient</p>
        </article>
      </li>
      <li class="one_quarter">
        <article><a href="#"><i class="icon btmspace-30 fa fa-ioxhost"></i></a>
          <h6 class="heading font-x1">Aenean luctus lacinia</h6>
          <p>Montes nascetur ridiculus mus quisque ultricies massa sapien vel porta leo ultricies</p>
        </article>
      </li>
      <li class="one_quarter">
        <article><a href="#"><i class="icon btmspace-30 fa fa-ioxhost"></i></a>
          <h6 class="heading font-x1">Velit cursus arcu</h6>
          <p>Nec curabitur pretium tellus sed justo elementum pharetra mauris laoreet felis dictum</p>
        </article>
      </li>
      <li class="one_quarter">
        <article><a href="#"><i class="icon btmspace-30 fa fa-ioxhost"></i></a>
          <h6 class="heading font-x1">Vitae morbi efficitur</h6>
          <p>Est lobortis auctor nullam ac orci et risus auctor dignissim eu vel sem quisque ultrices</p>
        </article>
      </li>
    </ul>
  </section>
</div>

<div class="wrapper row3" id="Products">
  <section class="hoc container clear"> 
    <div class="sectiontitle">
      <h6 class="heading">Our Popular Products</h6>
      <p>Erat orci eget sodales ipsum ultricies nec.</p>
    </div>
    <div class="group latest">
      <article class="one_third first">
        <figure style="height: 200px; width: 300px;"><a class="imgover" href="#"><img src="images/photo-3.jpg" alt="" style="height: 200px;width: 300px;object-fit: cover;"></a></figure>
        <h4 class="heading">Vitae mauris et mattis</h4>
        <ul class="nospace meta">
          <li><i class="fa fa-user"></i> <a href="#">Admin</a></li>
          <li><i class="fa fa-tag"></i> <a href="#">Category</a></li>
          <li><i class="fa fa-comments"></i> <a href="#">6 Comments</a></li>
        </ul>
        <p>Posuere erat nisi hendrerit lorem facilisis tincidunt est quam ac tortor morbi neque tortor venenatis</p>
        <footer><a href="#">Read More</a></footer>
      </article>
      <article class="one_third">
        <figure style="height: 200px;  width: 300px;"><a class="imgover" href="#"><img src="images/photo-1.jpg" alt="" style="height: 200px; width: 300px; object-fit: cover;"></a></figure>
        <h4 class="heading">Ornare urna in sit</h4>
        <ul class="nospace meta">
          <li><i class="fa fa-user"></i> <a href="#">Admin</a></li>
          <li><i class="fa fa-tag"></i> <a href="#">Category</a></li>
          <li><i class="fa fa-comments"></i> <a href="#">6 Comments</a></li>
        </ul>
        <p>Sit amet sodales in accumsan ullamcorper lorem maecenas dui magna laoreet mollis fringilla eget egestas</p>
        <footer><a href="#">Read More</a></footer>
      </article>
      <article class="one_third">
        <figure style="height: 200px;  width: 300px;"><a class="imgover" href="#"><img src="images/photo-5.png" alt="" style="height: 200px;  width: 300px; object-fit: cover;"></a></figure>
        <h4 class="heading">Amet eleifend enim in</h4>
        <ul class="nospace meta">
          <li><i class="fa fa-user"></i> <a href="#">Admin</a></li>
          <li><i class="fa fa-tag"></i> <a href="#">Category</a></li>
          <li><i class="fa fa-comments"></i> <a href="#">6 Comments</a></li>
        </ul>
        <p>Eget dolor nullam sed porttitor lacus aliquam pulvinar rutrum maximus duis tempor risus nec tellus</p>
        <footer><a href="#">Read More</a></footer>
      </article>
    </div>
  </section>
</div>

<div class="wrapper row2" id="Team">
  <section class="hoc container clear"> 
    <div class="sectiontitle">
      <h6 class="heading">Our Team</h6>
      <p>Erat orci eget sodales ipsum ultricies nec.</p>
    </div>
    <div class="group latest" style="text-align: center;">
      <article class="one_third first">
        <figure style="height: 300px; width: 300px;">
          <img src="images/avatar-1.jpg" alt="" style="height: 300px;width: 300px; object-fit: cover;">
        </figure>
        <h4 class="heading">Ann Luvis</h4>
        <p style="color: #9D8D65;">CEO</p>
        <p>Posuere erat nisi hendrerit lorem facilisis tincidunt est quam ac tortor morbi neque tortor venenatis</p>
      </article>
      <article class="one_third">
        <figure style="height: 300px;  width: 300px;">
          <img src="images/avatar.jpg" alt="" style="height: 300px; width: 300px; object-fit: cover;">
        </figure>
        <h4 class="heading">Ann Luvis</h4>
        <p style="color: #9D8D65;">CEO</p>
        <p>Sit amet sodales in accumsan ullamcorper lorem maecenas dui magna laoreet mollis fringilla eget egestas</p>
      </article>
      <article class="one_third">
        <figure style="height: 300px;  width: 300px;">
          <img src="images/avatar-2.jpg" alt="" style="height: 300px;  width: 300px; object-fit: cover;">
        </figure>
        <h4 class="heading">Ann Luvis</h4>
        <p style="color: #9D8D65;">CEO</p>
        <p>Eget dolor nullam sed porttitor lacus aliquam pulvinar rutrum maximus duis tempor risus nec tellus</p>
      </article>
    </div>
  </section>
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
      
      <form method="post" action="">
          <input class="btmspace-15" type="text" placeholder="Name" name="yourname" style="background: white; color:black; ">
          <input class="btmspace-15" type="email" placeholder="Email" name="email" style="background: white; color:black;">
          <input class="btmspace-15" type="text" placeholder="Message" name="message" style="background: white; color:black;">
          <button type="submit" value="submit" name="submit">Submit</button>
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

<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>