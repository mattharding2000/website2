<?php
  error_reporting(0);
  include('config.php');
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
      <h6 class="heading">Gallery</h6>
    </div>
  </div>
  
</div>
<!-- End Top Background Image Wrapper -->



<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    
    <div class="content"> 
      
      <div id="gallery">
        <figure>
          <header class="heading">Our Amazing Products</header>
          <figcaption>Gallery Description Goes Here</figcaption>
        </figure>
        <div class="wrapper row3" id="Products">
          <section class="hoc container clear"> 
            <div class="row">
              <?php 
                $sql = "SELECT *  from product";
                $result=mysqli_query($conn, $sql);
                if(mysqli_num_rows($result))
                {
                  while ($row = mysqli_fetch_assoc($result))
                  { ?>
                    <div class="col-sm-4">
                      <figure style="height: 200px; width: 300px;"><a class="imgover" href="#">
                        <img src="images/<?php echo htmlentities($row['image']);?>" alt="" style="height: 200px;width: 300px;object-fit: cover;"></a>
                      </figure>
                      <br>
                      <h4 class="heading"><?php echo htmlentities($row['name']);?></h4>
                      <p><?php echo htmlentities($row['Details']);?></p>
                    </div>
                    
                    <?php 
                  }
                } 
              ?>
            </div>
          </section>
        </div>
      </div>
    </div>
    
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>


<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
   
  </div>
</div>



<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>