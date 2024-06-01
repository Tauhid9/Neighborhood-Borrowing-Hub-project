<?php
session_start();
	$email=$_POST['email'];
	$password=$_POST['password'];
	

	$connection= mysqli_connect('localhost','root','','hasan');  //connecting the phpmyadmin database.


	if(!$connection)
	{
		die("failed". mysqli_error($connection));
	}

	$query = $connection->prepare("SELECT * FROM user WHERE email=? "); //Select value from the database.

	$query->bind_param("s",$email);

	$query->execute();

	$query_result=$query->get_result();

	if($query_result->num_rows>0)
	{
		$data = $query_result->fetch_assoc();
		if($data['password'] == $password)
		{
			 if($data['user_type']=='user')
			 {
				 $_SESSION['user_id']=$data['user_id'];
				 $_SESSION['name']=$data['name'];
				 header('location:userpage.php');
			 }
			 else if($data['user_type']=='admin')
			 {
				  $_SESSION['user_id']=$data['user_id'];
				 $_SESSION['name']=$data['name'];
				include('adminpage.php');
			 }
		}
		else 
		{
			echo "Invalid email or password";  //If email or password is wrong then it shows invalid email or password.
		}
	}
	else 
	{
		echo "You need to sign up first";  //If the user did not registerd then it show you need to sign up first.
	}

?>