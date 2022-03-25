<!DOCTYPE html>
<?php
	session_start();
	include("header.php");
	if (!isset($_SESSION['email'])) {
		header("location: home.php");
	}
?>
<html>
<head>
	<?php
		$mail = $_SESSION['email'];
		$user = "select * from users where email='$mail'";
		$run = mysqli_query($con,$user);
		$row = mysqli_fetch_array($run);
		$username = $row['username'];
	?>
	<title><?php echo "$username"; ?></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
	body{
		overflow-x: hidden;
	}

	label{
		padding: 7px;
		display: table;
		color: #fff;
	}
	input[type="file"]{
		display: none;
	}
	#content{
		width: 70%;
	}
	#uploadimagebutton{
		position: absolute;
		top: 50.5%;
		right: 13%;
		min-width: 100px;
		max-width: 100px;
		border-radius: 4px;
		transform: translate(-50%,-50%);
	}
	#btnpost{
		max-width: 25%;
		min-width: 25%;
	}
	#insertpost{
		background-color: #fff;
		border: 2px solid #e6e6e6;
		padding: 40px 50px;
	}
	#posts{
		border: 5px solid #e6e6e6;
		padding: 40px 50px;
	}
	#postimage{
		padding-top: 5px;
		padding-right: 10px;
		min-width: 102%;
		max-width: 50%;
	}
	#singleposts{
		border: 5px solid #e6e6e6;
		padding: 40px 50px;
	}
</style>
<body>
	<div class="row">
		<div class="col-sm-12" id="insert_post">
			<center>
			<form action="timeline.php" method="post" id="f" enctype="multipart/form-data">
				<textarea class="form-control" id="content" rows="4" name="content" placeholder="What's in your mind, <?php echo $firstname; ?>?"></textarea><br>
				<label class="btn btn-warning" id="uploadimagebutton">Select Image
					<input type="file" name="upload_image" size="30">
				</label>
				
				<button id="btnpost" class="btn btn-success" name="submit">Post</button>
				</center>
			</form>
			
			<?php
				if(isset($_POST['submit'])){
					$caption = htmlentities($_POST['content']);
					$upload_image = $_FILES['upload_image']['name'];
					$image_tmp = $_FILES['upload_image']['tmp_name'];
					$image_upload = "";
					if (strlen($upload_image) >=1 && strlen($caption) >= 1) {
						move_uploaded_file($image_tmp,"postpics/$upload_image");
						$image_upload = "postpics/$upload_image";
						$insert_post = "insert into post (posteremail, poster_name, caption, image, timeposted, isPublic) values('$email', '$username', '$caption', '$image_upload', NOW(), TRUE)";
						$run_post = mysqli_query($con, $insert_post);
						if ($run_post) {
							echo "<script>window.open('timeline.php','_self')</script>";
						}
						exit();
					}
					else{
						if($upload_image == '' && $caption == ''){
							echo "<script>alert('Error occured while uploading!')</script>";
							echo "<script>window.open('timeline.php','_self')</script>";
							exit();
						}
						else{
							if ($caption == '') {
								move_uploaded_file($image_tmp,"postpics/$upload_image");
								$image_upload = "postpics/$upload_image";
								$insert_post = "insert into post (posteremail, poster_name, caption, image, timeposted, isPublic) values('$email', '$username', '', '$image_upload', NOW(), TRUE)";
								$run_post = mysqli_query($con, $insert_post);
								if ($run_post) {
									echo "<script>window.open('timeline.php','_self')</script>";
								}
								exit();
							}
							else{
								$insert_post = "insert into post (posteremail, poster_name, caption, timeposted, isPublic) values('$email', '$username', '$caption', NOW(), TRUE)";
								$run_post = mysqli_query($con, $insert_post);
								if ($run_post) {
									echo "<script>window.open('timeline.php','_self')</script>";
								}
								exit();
							}
						}
					}
				} 
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<br>
			<?php
				$getpost = "select * from post ORDER by post_id DESC";
				$runpost = mysqli_query($con,$getpost);
				while ($row_post = mysqli_fetch_array($runpost)) {
					$post_id = $row_post['post_id'];
					$posteremail = $row_post['posteremail'];
					$caption = $row_post['caption'];
					$upload_image = $row_post['image'];
					$timeposted = $row_post['timeposted'];
					$poster = "select * from users where email='$posteremail'";
					$run_poster = mysqli_query($con,$poster);
					$row_poster = mysqli_fetch_array($run_poster);
					$poster_name = $row_poster['username'];
					$poster_image = $row_poster['profilepicture'];
					if (strlen($upload_image) >=1 && strlen($caption) == 0) {
						echo "
							<div class='row'>
								<div class='col-sm-3'>
								</div>
								<div id='posts' class='col-sm-6'>
									<div class='row'>
										<div class='col-sm-2'>
											<p><img src='$poster_image' class='img-circle' width='100px' height='100px'></p>
										</div>
										<div class='col-sm-6'>
											<h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='userprofile.php'>$poster_name</a></h3>
											<h4><small style='color:black;'><strong>$timeposted</strong></small></h4>
										</div>
										<div class='col-sm-4'>
										</div>
									</div>
									<div class='row'>
										<div class='col-sm-8'>
											<img id='posts-img' src='$upload_image' style='height:350px;'>
										</div>
									</div><br>
								</div>
								<div class='col-sm-3'>
								</div>
							</div>
						";
					}
					else if (strlen($upload_image) >=1 && strlen($caption) >= 1) {
						echo "
							<div class='row'>
								<div class='col-sm-3'>

								</div>
								<div id='posts' class='col-sm-6'>
									<div class='row'>
										<div class='col-sm-2'>
											<p><img src='$poster_image' class='img-circle' width='100px' height='100px'></p>
										</div>
										<div class='col-sm-6'>
											<h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='userprofile.php'>$poster_name</a></h3>
											<h4><small style='color:black;'><strong>$timeposted</strong></small></h4>
										</div>
										<div class='col-sm-4'>
										</div>
									</div>
									<div class='row'>
										<div class='col-sm-8'>
											<h4>$caption</h4>
											<img id='posts-img' src='$upload_image' style='height:350px;'>
										</div>
									</div><br>
								</div>
								<div class='col-sm-3'>
								</div>
							</div>
						";
					}
					else{
						echo "
							<div class='row'>
								<div class='col-sm-3'>

								</div>
								<div id='posts' class='col-sm-6'>
									<div class='row'>
										<div class='col-sm-2'>
											<p><img src='$poster_image' class='img-circle' width='100px' height='100px'></p>
										</div>
										<div class='col-sm-6'>
											<h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='userprofile.php'>$poster_name</a></h3>
											<h4><small style='color:black;'><strong>$timeposted</strong></small></h4>
										</div>
										<div class='col-sm-4'>
										</div>
									</div>
									<div class='row'>
										<div class='col-sm-8'>
											<p><h4>$caption</h4></p>
										</div>
									</div><br>
								</div>
								<div class='col-sm-3'>
								</div>
							</div>
						";
					}
				}
			?>
		</div>
	</div>
</body>
</html>
