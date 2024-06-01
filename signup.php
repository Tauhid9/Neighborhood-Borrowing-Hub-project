<?php

$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$gender=$_POST['gender'];
$religoin=$_POST['religion'];
$dob=$_POST['dob'];
$password = $_POST['password'];
$user_type;
 $image = $_FILES['image']['name'];
   $product_image_tmp_name = $_FILES['image']['tmp_name'];
   $product_image_folder = 'img/user/'.$image;

$con_password = $_POST['con_password'];

		if($password!=$con_password)
		{
			die("Password did not match"); // IF both password and confirm password did not match 
			                               // while signup then it show password didnot match.
		}
		$connection= mysqli_connect('localhost','root','','hasan'); //connecting the phpmyadmin database.

	if(!$connection)
	{
		die("failed". mysqli_error($connection));
	}
	

	$query = "INSERT INTO user VALUES ('NULL','$name', '$email','$address','$phone','$gender','$religoin','$dob','$password','$image','user')"; //Inserting values to the database.

	$final=mysqli_query($connection,$query);
	
	if($final){
		echo"Registration Successful..."; //If everything filled correctly then output shows registration successful.
	    header('location:regsuccessfull.html');
	}
	else{
		echo"Email already in used.";
		// While registration the mail user entered is already used by someone else then it shows 
		header('location:regnotsuccessfull.html');							   // email already in used.
	}

?>
