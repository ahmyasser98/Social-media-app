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
	<title>Search</title>
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
	#find_people{
		
		padding: 40px 50px;
	}
	#result_posts{
		
		padding: 40px 50px;
	}
	#search_user{
		padding: 10px;
		font-size: 17px;
		border-radius: 1px solid grey;
		float: left;
		width: 80%;
		background: #f1f1f1;
	}
	#search_button{
		float: left;
		width: 20%;
		padding: 10px;
		font-size: 17px;
		border: 1px solid grey;
		border-left: none;
		cursor: pointer;
	}

</style>
<body>
	<div class='row'>
		<div class="col-sm-12">
			<div class='row'>
				<div class='col-sm-4'>
				</div>
				<div class='col-sm-4'>
					<form class="Search" action="">
						<input type="text" placeholder="Search Friend" name="searchuser" id="search_user">
						<button class="btn btn-info" type="submit" name="search_user_btn" id="search_button">Search</button>
					</form>
				</div>
				<div class="col-sm-4">
				</div>
			</div><br><br>
			<?php
				if (isset($_GET['search_user_btn'])) {
					$search_query = htmlentities($_GET['searchuser']);
					$get_user = "select * from users where fname like '%$search_query%' OR lname like '%$search_query%' OR username like '%$search_query%' OR hometown like '%$search_query%' OR phonenumber like '%$search_query%' OR email like '%$search_query%'";
					$run_user = mysqli_query($con,$get_user);
					while($row_user=mysqli_fetch_array($run_user)) {
						$user_email = $row_user['email'];
						$user_username = $row_user['username'];
						$user_image = $row_user['profilepicture'];
						echo "
							<div class='row'>
								<div class='col-sm-3'>
								</div>
								<div class='col-sm-6'>
									<div class='row' id='find_people'>
										<div class='col-sm-4'>
											<a href='userprofile.php?u_mail=$user_email'>
												<img src='$user_image' class='img-circle' width='150px' height='140px' title='$user_username' style='float:left; margin:1px;'/>
											</a>
										</div><br><br>
										<div class='col-sm-6'>
											<a  href='userprofile.php?u_mail=$user_email' style='text-decoration:none;cursor:pointer;color:#3897f0;' href='userprofile.php'>
												<strong><h2>$user_username</h2></strong>
											</a>
										</div>
										<div class='col-sm-3'>
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
</body>
</html>