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
	#profile-img{
		position: absolute;
		top: 40px;
		left:-165px;
	}
	#update_profile{
		position: relative;
		top: -33px;
		cursor: pointer;
		left: 93px;
		border-radius: 4px;
		background-color: rgba(0,0,0,0.1);
		transform: translate(-50%,-50%);
	}
	#button_profile{
		position: absolute;
		top: 95%;
		left: 50%;
		cursor: pointer;
		transform: translate(-50%,-50%);
	}
	#own_posts{
		border: 5px solid #e6e6e6;
		padding: 40px 50px;
	}
	#post_img{
		height: 300px;
		width: 100%;
	}
</style>
<body>
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-2">
			<?php
				echo "
					<div id='profile-img'>
						<img src='$profilepicture' alt='Profile' class='img-circle' width='180px' height='185px'>
						<form action='profile.php' method='post' enctype='multipart/form-data'>
							<label id='update_profile'> Select Profile
								<input type='file' name='u_image' size='60' />
							</label>
							<button id='button_profile' name='update' class='btn btn-info'>Update Profile</button>
						</form>
					</div>
				";
			?>	
		</div>
		<?php
			if(isset($_POST['update'])){
				$profilepic = $_FILES['u_image']['name'];
				$image = $_FILES['u_image']['tmp_name'];
				$profilepicc="";
				if ($profilepic=='') {
					echo "<script>alert('Please select a profile picture!')</script>";
					echo "<script>window.open('profile.php','_self')</script>";
					exit();
				}
				else{
					move_uploaded_file($image,"profilepics/$profilepic");
					$profilepicc = "profilepics/$profilepic";
					$update="update users set profilepicture='$profilepicc' where email='$email'";
					$run_update = mysqli_query($con,$update);
					$update2 = "insert into post (posteremail, poster_name, caption, image, timeposted, isPublic) values('$email', '$username', 'new profile picture!', '$profilepicc', NOW(), TRUE)";
					$run_update2 = mysqli_query($con,$update2);
					if ($run_update) {
						echo "<script>window.open('profile.php','_self')</script>";
					}
				}
			}
		?>
		<div class="col-sm-2"></div>
		<div class="col-sm-2" style="background-color: #e6e6e6;text-align: center;position: absolute;left: 40px;top: 350px;border-radius: 5px;">
			<?php
				echo "
					<center><h2><strong>About</strong></h2></center>
					<center><h4><strong>$username</strong></h4></center>
					<p><strong><i style='color:grey;'>$aboutme</i></strong></p>
					<p><strong>Relationship status: </strong> $martialstatus</p><br>
					<p><strong>Gender: </strong> $gender</p><br>
					<p><strong>Date of birth: </strong> $birthdate</p><br>
					<p><strong>Phone number: </strong> $phonenumber</p><br>
					<p><strong>Lives in: </strong> $country</p><br>
				";
			?>
		</div>
		<div class="col-sm-6" style="left: -400px;">
			<?php
				$getpost = "select * from post where posteremail='$email' ORDER by post_id DESC";
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
					if (strlen($upload_image) >=1 && strlen($caption) == 0){
						echo "
							<div id='own_posts'>
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
									<div class=col-sm-12>
										<img id='posts-img' src='$upload_image' style='height:350px;'>
									</div>
								</div>

							</div>
						";
					}
					else if (strlen($upload_image) >=1 && strlen($caption) >= 1){
						echo "
							<div id='own_posts'>
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
									<div class=col-sm-12>
										<p><h4>$caption</h4></p>
										<img id='posts-img' src='$upload_image' style='height:350px;'>
									</div>
								</div>
							</div>
						";
					}
					else{
						echo "
							<div id='own_posts'>
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
									<div class=col-sm-12>
										<p><h4>$caption</h4></p>
									</div>
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