<?php
	$con = mysqli_connect("localhost","root","","socialmedia");
?>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a href="timeline.php" class="navbar-brand">Social Network</a>
		</div>
		<div class="collapse navbar-collapse" id="#bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<?php
					
					$mail = $_SESSION['email'];
					$user = "select * from users where email='$mail'";
					$run = mysqli_query($con,$user);
					$row = mysqli_fetch_array($run);
					$username = $row['username'];
					$firstname = $row['fname'];
					$lastname = $row['lname'];
					$email = $row['email'];
					$password = $row['password'];
					$profilepicture = $row['profilepicture'];
					$gender = $row['gender'];
					$birthdate = $row['birthdate'];
					$phonenumber = $row['phonenumber'];
					$martialstatus = $row['martialstatus'];
					$country = $row['hometown'];
					$aboutme = $row['aboutme'];
					$posts = "select * from post where posteremail = '$email'";
					$run_posts = mysqli_query($con,$posts);
					$posts_num = mysqli_num_rows($run_posts);
				?>
				<li><a href='profile.php'><?php echo "$username"; ?></a></li>
				<li><a href='timeline.php'>Home</a></li>
				<li><a href='search.php'>Search</a></li>
				<li><a href='friends.php'>Friends</a></li>
				<?php
					echo "
					<li class='dropdown'>
						<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span><i class='glyphicon glyphicon-chevron-down'></i></span></a>
						<ul class='dropdown-menu'>
							<li>
								<a href='friendrequests.php'>Friend Requests</a>
							</li>
							<li>
								<a href='editprofile.php'>Edit profile</a>
							</li>
							<li role='separator' class='divider'></li>
							<li>
								<a href='logout.php'>Logout</a>
							</li>
						</ul>
					</li>
					";
				?>
			</ul>
		</div>
	</div>
</nav>