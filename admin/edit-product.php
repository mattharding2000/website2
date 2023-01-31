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
			if(!empty($_FILES["img1"]["name"])){
				try {
					$id=$_POST['pid'];
					$pname=$_POST['pname'];
					$pcat=$_POST['pcat'];
					$pdet=$_POST['pdet'];
					$image1=$_FILES["img1"]["name"];
					move_uploaded_file($_FILES["img1"]["tmp_name"],"../images/".$image1);
	
					$sql="UPDATE `product` SET `name`='$pname',`category`='$pcat',`image`='$image1',`Details`='$pdet' WHERE id='".$id."' ";
				
					if(mysqli_query($conn,$sql))
					{
						echo "<script>alert('Successfully Updated');</script>";
					}else{
						echo "<script>alert('Something went wrong. Please try again');</script>";
					}
				} catch(PDOException $e) {
					  echo $sql . "<br>" . $e->getMessage();
					$msg= "Something went wrong. Please Try Again";
				}
			}
			else{
				try {
					$id=$_POST['pid'];
					$pname=$_POST['pname'];
					$pcat=$_POST['pcat'];
					$pdet=$_POST['pdet'];

					$sql="UPDATE `product` SET `name`='$pname',`category`='$pcat',`Details`='$pdet' WHERE id='".$id."' ";
				
					if(mysqli_query($conn,$sql))
					{
						echo "<script>alert('Successfully Updated');</script>";
					}else{
						echo "<script>alert('Something went wrong. Please try again');</script>";
					}
				} catch(PDOException $e) {
					  echo $sql . "<br>" . $e->getMessage();
					$msg= "Something went wrong. Please Try Again";
				}
			}
			

		}?>
		<!doctype html>
		<html lang="en" class="no-js">
			<head>
				<meta charset="UTF-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
				<meta name="description" content="">
				<meta name="author" content="">
				<meta name="theme-color" content="#3e454c">
				<title>Vehicle Rental Portal | Admin Edit Vehicle Info</title>
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
					.errorWrap {
    					padding: 10px;
    					margin: 0 0 20px 0;
    					background: #fff;
    					border-left: 4px solid #dd3d36;
    					-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    					box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
					}
					.succWrap{
    					padding: 10px;
    					margin: 0 0 20px 0;
    					background: #fff;
    					border-left: 4px solid #5cb85c;
    					-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    					box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
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
									<h2 class="page-title">Edit Product</h2>
										<div class="row">
											<div class="col-md-12">
												<div class="panel panel-default">
													<div class="panel-heading">Basic Info</div>
													<div class="panel-body">
														<?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> 
													</div><?php } ?>
													<?php 
														$id=$_GET['id'];
														$sql ="SELECT * from product where id='$id'";
														$result=mysqli_query($conn, $sql);
														if(mysqli_num_rows($result))
														{
														while ($row = mysqli_fetch_assoc($result))
														{ 	?>
																<form method="post" class="form-horizontal" name="editVehicle" enctype="multipart/form-data">
																<input type="hidden" name="pid" class="form-control"  value="<?php echo htmlentities($row['id'])?>" required>
																	<div class="form-group">
																		<label class="col-sm-2 control-label">Product Name<span style="color:red">*</span></label>
																		<div class="col-sm-4">
																			<input type="text" name="pname" class="form-control"  value="<?php echo htmlentities($row['name'])?>" required>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-sm-2 control-label">Category<span style="color:red">*</span></label>
																		<div class="col-sm-4">
																			<input type="text" name="pcat" class="form-control"  value="<?php echo htmlentities($row['category'])?>" required>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-sm-2 control-label">Details<span style="color:red">*</span></label>
																		<div class="col-sm-4">
																			<input type="text" name="pdet" class="form-control"  value="<?php echo htmlentities($row['Details'])?>" required>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-sm-2 control-label">Image<span style="color:red">*</span></label>
																		<div class="col-sm-4">
																			<img src="../images/<?php echo htmlentities($row['image'])?>" width="300"/>
																			<input type="file" name="img1">
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-8 col-sm-offset-8" >
																			<button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%; width:150px; font-size:14px; font-family:'Arial'">Save changes</button>
																		</div>
																	</div>
																</form>
																<?php
															}}
															?>
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
			</body>
		</html>
		<?php 
	}
?>