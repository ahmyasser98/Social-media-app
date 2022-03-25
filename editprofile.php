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
	<title>Settings</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="row">
		<div class="col-sm-2">
		</div>
		<div class="col-sm-8">
			<form action="" method="post" enctype="multipart/form-data">
				<table class="table table-bordered table-hover">
					<tr align="center">
						<td colspan="6" class="active"><h2><?php echo $username; ?></h2></td>
					</tr>
					<tr>
						<td style="font-weight: bold;">About me</td>
						<td>
							<input class="form-control" type="text" name="aboutme" required value="<?php echo $aboutme; ?>">
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Status</td>
						<td>
							<select class="form-control" name="status">
								<option>Single</option>
								<option>Engaged</option>
								<option>Married</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Hometown</td>
						<td>
							<input class="form-control" type="text" name="hometown" required value="<?php echo $country; ?>">
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Phone number</td>
						<td>
							<input class="form-control" type="text" name="phonenumber" required value="<?php echo $phonenumber; ?>">
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Birthdate</td>
						<td>
							<input class="form-control" type="date" name="birthdate" required value="<?php echo $birthdate; ?>">
						</td>
					</tr>
					<tr align="right">
						<td colspan="6">
							<input type="submit" class="btn btn-info" name="update"  value="Update">
						</td>
					</tr>
				</table>
			</form>

		</div>
		<div class="col-sm-2">
		</div>
	</div>
</body>
</html>
<?php
	if (isset($_POST['update'])) {

		$about_me = htmlentities($_POST['aboutme']);
		$status = htmlentities($_POST['status']);
		$home_town = htmlentities($_POST['hometown']);
		$phone_number = htmlentities($_POST['phonenumber']);
		$birth_date = htmlentities($_POST['birthdate']);
		$update_user = "update users set aboutme='$about_me', martialstatus='$status', hometown='$home_town', phonenumber='$phone_number', birthdate='$birth_date' WHERE email='$email' ";
		$run_user = mysqli_query($con,$update_user);
		if ($run_user) {
			echo "<script>window.open('profile.php','_self')</script>";
		}
	}
?>