<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

 $connection= mysqli_connect('localhost','root','','hasan'); //connecting the phpmyadmin database.

	if(!$connection)
	{
		die("failed". mysqli_error($connection));
	}
	



if(isset($_POST[''])){
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
		
		$u_id=$_SESSION[user_id];

   if(empty($name) || empty($email) || empty($address) || empty($phone) || empty($gender) || empty($religion) || empty($dob) || empty($image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE user SET name='$name', email='$email',address='$address', phone='$phone', gender='$gender',religoin='$religoin',dob='dob',image='image'  WHERE user_id = '$u_id'";
      $upload = mysqli_query($connection, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:userprofile.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css\profile.css">
</head>
<body>
  <!-- First Navigation Bar for User Information -->
    <header class="py-5" >
        <div class="company">
            <img class="logo" src="img\logo\logo.png" width="50" height="50" alt="Company Logo">
            <h5>Neighborhood Borrowing Hub</h5>
        </div>
        <div class="user-info">
            <span id="username"><?php echo $_SESSION["name"] ?></span>
            <img src="img/user/image_icon.png" width="60" height="60" alt="User Picture">
			<a href="logout.php">Logout</a>
        </div>
    </header>
<hr>
    <!-- Second Navigation Bar for Navigation Links -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link px-5" href="userpage.php">Home</a>
            </li>
			  
		</ul>
            
    </nav>





    <div class="container mt-5">
	 <?php
	$u_id=$_SESSION['user_id'];

   $select = mysqli_query($connection, "SELECT * FROM user where user_id=$u_id");
   
   ?>
        <h2>User Profile</h2>
        <hr>

        <div class="row">
            <div class="col-md-4">
                <!-- Display User Image -->
                <img src="img/user/image_icon.png" width="60px" height="80px" alt="User Image" class="img-fluid">
				<p>image</p>
            </div>
            <div class="col-md-8">
                <h3>User Information</h3>
				<?php while($user = mysqli_fetch_assoc($select)){ ?>
                <form  action="profile.php" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>">
                    </div>
                    <div   class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>">
                    <!--</div>
                    <div class="form-group"> -->
                        <label for="phone">Phone:</label>
                        <input type="tel" name="phone" class="form-control" value="<?php echo $user['phone']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $user['address']; ?>">
                    </div>
					
					<div   class="col-sm-5" class="form-group">
					  <label for="gender">Gender</label>
					  <select class="form-control" id="sel1" >
					    <option><?php echo $user['gender']; ?></option>
						<option>Male</option>
						<option>Female</option>
						<option>Others</option>
						
					  </select>
					</div>
                    <div  class="col-sm-5" class="form-group">
					  <label for="religoin">Religoin</label>
					  <select class="form-control" id="sel1" >
					   <option><?php echo $user['religoin']; ?></option>
						 <option>Muslim</option>
						  <option>Hindu</option>
						  <option>Buddhist</option>
						  <option>Christian</option>
						  <option>Others</option>
						
					  </select>
					</div>
					
                    <div  class="col-sm-5" class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" name="dob" class="form-control" value="<?php echo $user['dob']; ?>">
                    </div>
					<!-- Image Upload -->
                    <div class="form-group">
                        <label for="image">Profile Image:</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update Profile</button> 
					
                </form>
				<?php } ?>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
