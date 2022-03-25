<?php
	$con = mysqli_connect("localhost","root","","socialmedia");
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$country = $_POST['country'];
	$gender = $_POST['gender'];
	$birthdate = $_POST['birthdate'];
	$username = $firstname." ".$lastname;
	$sql_mail = "select * from users where email = '$email'";
	$res = mysqli_query($con,$sql_mail);
	$profilepic = "";
	if (isset($_POST['signup'])) {
		
		if ($password!=$password2) {
			echo "<script>alert('Two passwords do not match!')</script>";
			echo "<script>window.open('signup.php','_self')</script>";
			exit();	
		}
		elseif (mysqli_num_rows($res) > 0) {
			echo "<script>alert('Email already taken!')</script>";
			echo "<script>window.open('signup.php','_self')</script>";
			exit();	
		}
		else{
			if ($gender == "Male") {
			$profilepic = "profilepics/male.jpg";
			}
			elseif ($gender == "Female") {
				$profilepic = "profilepics/female.jpg";
			}
			$pass = md5($password);
			$insert = "insert into users (fname,lname,username,email,password,hometown,gender,profilepicture,birthdate,martialstatus,aboutme,phonenumber) values ('$firstname','$lastname','$username','$email','$pass','$country','$gender','$profilepic','$birthdate','Single','Hi I am new here!','')";
			$query = mysqli_query($con,$insert);
			if ($query) {
				echo "<script>alert('Account created successfully')</script>";
				echo "<script>window.open('login.php','_self')</script>";
			}

		}
		

	}

?>