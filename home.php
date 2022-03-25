<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
	body{
		overflow-x: hidden;
		background-image: url("pics/arr.jpeg");
	}
	#signup{
		width: 20%;
		border-radius: 30px;
	}
	#login{
		width: 20%;
		border-radius: 30px;
	}
	
</style>
<body>
	
	<div class="row">
		<div class="col"><br><br><br><br><br><br><br><br><br><br><br><br>
			<form action="signup.php" method="post">

				<center><button id="signup" class="btn btn-info btn-lg" name="signup">Sign Up</button></center>	
			</form><br>
			<form action="login.php" method="post">
				<center><button id="login" class="btn btn-info btn-lg" name="login">Login</button></center>
			</form>
		</div>
	</div>
</body>
</html>