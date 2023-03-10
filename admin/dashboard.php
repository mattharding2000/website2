<?php
	session_start();
	error_reporting(0);
	include('includes/config.php');
	if(strlen($_SESSION['alogin'])==0)
	{	
		header('location:index.php');
	}
	else{
		if(isset($_POST['submit']))
		{
			$password=md5($_POST['password']);
			$newpassword=md5($_POST['newpassword']);
			$username=$_SESSION['alogin'];
			$sql ="SELECT password FROM admin WHERE email='$username' and password='$password'";
			$results = mysqli_query($conn,$sql);
			if(mysqli_num_rows($results))
			{
				$con="update admin set password='$newpassword' where email='$username'";
				$result = mysqli_query($conn,$con);
				if(mysqli_query($conn,$sql))
				{
					echo "<script>alert('Successfully Updated');</script>";
				}else{
					echo "<script>alert('Something went wrong. Please try again');</script>";
				}
			}
			else {
				$error="Your current password is not valid.";	
			}
		}
		?>
		<!doctype html>
		<html lang="en" class="no-js">
			<head>
				<meta charset="UTF-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
				<meta name="description" content="">
				<meta name="author" content="">
				<meta name="theme-color" content="#3e454c">

				<title>Admin Dashboard</title>

				<!-- Font awesome -->
				<link rel="stylesheet" href="css/font-awesome.min.css">
				<!-- Sandstone Bootstrap CSS -->
				<link rel="stylesheet" href="css/bootstrap.min.css">
				<!-- Bootstrap Datatables -->
				<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
				<!-- Bootstrap social button library -->
				<link rel="stylesheet" href="css/bootstrap-social.css">
				<!-- Bootstrap select -->
				<link rel="stylesheet" href="css/bootstrap-select.css">
				<!-- Bootstrap file input -->
				<link rel="stylesheet" href="css/fileinput.min.css">
				<!-- Awesome Bootstrap checkbox -->
				<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
				<!-- Admin Stye -->
				<link rel="stylesheet" href="css/style.css">
				<style>
					.col {
                    float: left;
                    width: 31%;
					height: 100px;
               }
               .rw:after {
                    content: "";
                    display: table;
                    clear: both;
               }
				</style>
			</head>
			<body>
				<?php include('includes/header.php');?>
				<div class="ts-main-content">
					<?php include('includes/leftbar.php');?>
					<div class="content-wrapper">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<h2 class="page-title">Dashboard</h2>
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-6">
														<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
															<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
															else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
															<div class="form-group">
																<label class="col-sm-4 control-label">Current Password</label>
																<div class="col-sm-8">
																	<input type="password" class="form-control" name="password" id="password" required>
																</div>
															</div>
															<div class="hr-dashed"></div>
															<div class="form-group">
																<label class="col-sm-4 control-label">New Password</label>
																<div class="col-sm-8">
																	<input type="password" class="form-control" name="newpassword" id="newpassword" required>
																</div>
															</div>
															<div class="hr-dashed"></div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Confirm Password</label>
																<div class="col-sm-8">
																	<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
																</div>
															</div>
															<div class="hr-dashed"></div>							
															<div class="form-group">
																<div class="col-sm-8 col-sm-offset-4">	
																	<button class="btn btn-primary" name="submit" type="submit" style="width:150px; font-size:14px; font-family:'Arial'">Save changes</button>
																</div>
															</div>
														</form>
													</div>
													<div class="col-md-6">
														<div class="panel">
															<img src="../images/logo.jpg" height="400"/>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Loading Scripts -->
						<script src="js/jquery.min.js"></script>
						<script src="js/bootstrap-select.min.js"></script>
						<script src="js/bootstrap.min.js"></script>
						<script src="js/jquery.dataTables.min.js"></script>
						<script src="js/dataTables.bootstrap.min.js"></script>
						<script src="js/Chart.min.js"></script>
						<script src="js/fileinput.js"></script>
						<script src="js/chartData.js"></script>
						<script src="js/main.js"></script>
	
						<!-- <script>
							window.onload = function(){
								// Line chart from swirlData for dashReport
								var ctx = document.getElementById("dashReport").getContext("2d");
								window.myLine = new Chart(ctx).Line(swirlData, {
									responsive: true,
									scaleShowVerticalLines: false,
									scaleBeginAtZero : true,
									multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
								}); 
								// Pie Chart from doughutData
								var doctx = document.getElementById("chart-area3").getContext("2d");
								window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

								// Dougnut Chart from doughnutData
								var doctx = document.getElementById("chart-area4").getContext("2d");
								window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});
							}
						</script> -->
				</body>
		</html>
		<?php 
	} 
?>