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
	<title>Friend Requests</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<?php
				$get_req = "select * from friend where isFriend='0' ORDER by friend_id DESC";
				$run_req = mysqli_query($con,$get_req);
				while ($row_req = mysqli_fetch_array($run_req)) {
					$email1 = $row_req['email1'];
					$email2 = $row_req['email2'];
					if ($email2 == $email) {
						$get_friend = "select * from users where email='$email1'";
						$run_friend = mysqli_query($con,$get_friend);
						$row_friend = mysqli_fetch_array($run_friend);
						$user_name = $row_friend['username'];
						$user_image = $row_friend['profilepicture'];
						echo "
							<div class='row'>
								<div class='col-sm-3'>
								</div>
								<div class='col-sm-6'>
									<div class='row' id='find_people'>
										<div class='col-sm-4'>
											
											<img src='$user_image' class='img-circle' width='150px' height='140px' title='$user_name' style='float:left; margin:1px;'/>
											
										</div><br><br>
										<div class='col-sm-6'>
											<a style='text-decoration:none;color:#3897f0;'>
												<strong><h2>$user_name</h2></strong>
											</a>
										</div>
										<div class='col-sm-3'>
											<form method='post'>
												<button class='btn btn-success' id='accept_btn' name='accept'>Accept</button>
												<button class='btn btn-success' id='ignore_btn' name='ignore'>Ignore</button>
											</form>
										</div>
									</div>
								</div>
								<div class='col-sm-4'>
								</div>
							</div><br>
						";
					}
				}
			?>
		</div>
	</div>
	<?php 
		if (isset($_POST['accept'])) {
			$accepted = "update friend set isFriend='1' where email1='$email1'";
			$run_update = mysqli_query($con,$accepted);
			if ($run_update) {
				echo "<script>window.open('friendrequests.php','_self')</script>";
			}
		}
		if (isset($_POST['ignore'])) {
			$ignored = "delete from friend where email1='$email1'";
			$run_delete = mysqli_query($con,$ignored);
			if ($run_delete) {
				echo "<script>window.open('friendrequests.php','_self')</script>";
			}
		}
	?>
</body>
</html>