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
	<title>Pofile</title>
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
	#prof{
		left: 50px;
	}
	#buton{
		position: relative;
		left: 180px;
	}
	#bttton{
		position: absolute;
		left: 195px;
	}
	#own_posts{
		position: relative;
		left: 50%;
		top: -500px;
		border: 5px solid #e6e6e6;
		padding: 40px 50px;
		width: 90%;
	}
	#posts_img{
		height: 300px;
		width: 100%;
	}
</style>
<body>
	<div class="row">
		<?php
			if (isset($_GET['u_mail'])) {
				$u_mail = $_GET['u_mail'];
			}
			if ($u_mail == "") {
				echo "<script>window.open('timeline.php','_self')</script>";
			}
		?>
		<div class="col-sm-12">
			<?php
				if (isset($_GET['u_mail'])) {
					$user_email = $_GET['u_mail'];
					$select = "select * from users where email='$user_email'";
					$run = mysqli_query($con,$select);
					$row = mysqli_fetch_array($run);
					$mail = $row['email'];
					$image = $row['profilepicture'];
					$name = $row['username'];
					$aboutme = $row['aboutme'];
					$country = $row['hometown'];
					$birthdate = $row['birthdate'];
					$gender = $row['gender'];
					$phonenumber = $row['phonenumber'];
					$status = $row['martialstatus'];
					echo "
						<div class='row'>
							<div class='sol-sm-1'>
							</div>
							<center>
								<div style='background-color: #e6e6e6;' class='col-sm-3' id='prof'>
									<h2>$name</h2>
									<img class='img-circle' src='$image' width='150' height='150'>
									<br><br>
									<ul class='list-group'>
										<li class='list-group-item' title='Describtion'><strong>$aboutme</strong></li>
										<li class='list-group-item' title='Gender'><strong>$gender</strong></li>
										<li class='list-group-item' title='Birth date'><strong>$birthdate</strong></li>
										<li class='list-group-item' title='Country'><strong>$country</strong></li>
										<li class='list-group-item' title='Phone number'><strong>$phonenumber</strong></li>
										<li class='list-group-item' title='Status'><strong>$status</strong></li>
									</ul>
								</div>
							</center>
						</div>
					";
					$user = $_SESSION['email'];
					$get_user = "select * from users where email='$user'";
					$run_user = mysqli_query($con,$get_user);
					$row_user = mysqli_fetch_array($run_user);
					$user_mail = $row_user['email'];
					if ($user_email == $user_mail) {
						echo "<a href='editprofile.php?u_mail=$user_mail' class='btn btn-success'  id='bttton'>Edit Profile</a><br><br>";
					}
					else{
						echo "<form method='post'>
								<button class='btn btn-success' id='buton' name='add'>Add Friend</button>
							</form>
						";
					}	
				}
			?>
			<?php
				if (isset($_POST['add'])) {
					$friend_email = $_GET['u_mail'];
					$email1 = $email;
					$email2 = $friend_email;
					$friend_request = "insert into friend (email1, email2, isFriend) values ('$email1', '$email2', FALSE)";
					$run_request = mysqli_query($con,$friend_request);
					if ($run_request) {
						echo "<script>window.open('timeline.php','_self')</script>";
					}
					exit();
				}
			?>
			<div class="col-sm-8">
				<?php
					if (isset($_GET['u_mail'])) {
						$umail = $_GET['u_mail'];
					}
					$get_posts = "select * from post where posteremail='$umail' ORDER by post_id DESC";
					$run_posts = mysqli_query($con,$get_posts);
					while ($row_posts = mysqli_fetch_array($run_posts)) {
						$post_id = $row_posts['post_id'];
						$posteremail = $row_posts['posteremail'];
						$caption = $row_posts['caption'];
						$upload_image = $row_posts['image'];
						$timeposted = $row_posts['timeposted'];
						$user = "select * from users where email='$posteremail'";
						$run_user = mysqli_query($con,$user);
						$row_user = mysqli_fetch_array($run_user);
						$username = $row_user['username'];
						$userimage = $row_user['profilepicture'];
						if (strlen($upload_image) >=1 && strlen($caption) == 0){
							echo "
								<div id='own_posts'>
									
									<div class='row'>
										<div class='col-sm-12'>
											<p><img src='$userimage' class='img-circle' width='100px' height='100px'></p>
										</div>
										<div class='col-sm-6'>
											<h3><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='userprofile.php?u_mail=$umail'>$username</a></h3>
											<h4><small style='color: black;'><strong>$timeposted</strong></small></h4>
										</div>
										<div class='col-sm-4'>
										</div>
									</div>
									<div class='row'>
										<div class='col-sm-12'>
											<img id='post-img' src='$upload_image' style='height: 350px'>
										</div>
									</div>
									
								</div>
							";
						}
						else if (strlen($upload_image) >=1 && strlen($caption) >= 1){
							echo "
								<div id='own_posts'>
									
									<div class='row'>
										<div class='col-sm-12'>
											<p><img src='$userimage' class='img-circle' width='100px' height='100px'></p>
										</div>
										<div class='col-sm-6'>
											<h3><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='userprofile.php?u_mail=$umail'>$username</a></h3>
											<h4><small style='color: black;'><strong>$timeposted</strong></small></h4>
										</div>
										<div class='col-sm-4'>
										</div>
									</div>
									<div class='row'>
										<div class='col-sm-12'>
											<p><h4>$caption</h4></p>
											<img id='post-img' src='$upload_image' style='height: 350px'>
										</div>
									</div>
									
								</div>
							";
						}
						else{
							echo "
								<div id='own_posts'>
									
									<div class='row'>
										<div class='col-sm-12'>
											<p><img src='$userimage' class='img-circle' width='100px' height='100px'></p>
										</div>
										<div class='col-sm-6'>
											<h3><a style='text-decoration: none; cursor: pointer; color: #3897f0;' href='userprofile.php?u_mail=$umail'>$username</a></h3>
											<h4><small style='color: black;'><strong>$timeposted</strong></small></h4>
										</div>
										<div class='col-sm-4'>
										</div>
									</div>
									<div class='row'>
										<div class='col-sm-12'>
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
	</div>
	
	
</body>
</html>