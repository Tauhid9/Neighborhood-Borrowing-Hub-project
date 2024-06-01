<?php
ini_set('session.cache_limiter','public');
session_start();
  $connection= mysqli_connect('localhost','root','','hasan'); //connecting the phpmyadmin database.

	if(!$connection)
	{
		die("failed". mysqli_error($connection));
	}
	

if(isset($_POST['add_product'])){
	

   $product_name = $_POST['product_name'];
   $category = $_POST['category'];
    $description = $_POST['description'];
    $status ;
	$u_id=$_SESSION['user_id'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'img/uploaded_product/'.$product_image;

   if(empty($product_name) || empty($category) || empty($description) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO product VALUES('NULL','$product_name', '$description','$category','Avilable','$product_image','$u_id')";
      $upload = mysqli_query($connection,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add product</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/productstyles.css">

</head>
<body>


   
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <textarea type="text" placeholder="enter product description" name="description" rows="2" class="box"></textarea>
		<!-- <input type="text" placeholder="enter product category" name="category" class="box"> -->
		   <div class="box">
		   <label> <h5>Category: </h5> </label>
			<select   name="category" required>            
			<option>Electronics </option>
			<option>Kitchen Equipment</option>
			<option>Health Tools</option>
			<option>Servicing Tools</option>
			<option>Farming Tools</option>
						  
			</select> </div>
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
		 <a href="uploaded_product.php" class="btn">go back!</a>
      </form>

   </div>

</div>


</body>
</html>