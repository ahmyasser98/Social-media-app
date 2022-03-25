<?php
	session_start();
	$con = mysqli_connect("localhost","root","","socialmedia");
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$user = "select * from users where email='$email' AND password='$password'";
	$query = mysqli_query($con,$user);
	$check = mysqli_num_rows($query);
	if (isset($_POST['login'])) {
		if($check == 1){
			$_SESSION['email'] = $email;
			header("Location: timeline.php");
		}
		else{
			echo "<script>alert('Incorrect email or password!')</script>";
			echo "<script>window.open('login.php','_self')</script>";
			exit();
		}
	}
?>