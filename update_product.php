<?php

$connection = mysqli_connect('localhost', 'root', '', 'hasan');

if (!$connection) {
    die("failed" . mysqli_error($connection));
}

$product_id = $_GET['edit'];

if (isset($_POST['update_product'])) {

    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $status = $_POST['status']; // Ensure this is a valid value: 'Avilable', 'Hide', 'Borrow'
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'img/uploaded_product/' . $product_image;

    if (empty($product_name) || empty($category) || empty($description) || empty($product_image)) {
        $message[] = 'Please fill out all fields!';
    } else {

        // Use prepared statement to prevent SQL injection
        $update_data = "UPDATE product SET product_name=?, description=?, category=?, status=?, product_image=? WHERE product_id = ?";
        $stmt = mysqli_prepare($connection, $update_data);
		
		
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sssssi", $product_name, $description, $category, $status, $product_image, $product_id);

        // Execute the update
        $upload = mysqli_stmt_execute($stmt);

        if ($upload) {
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            header('location:uploaded_product.php');
        } else {
            $message[] = 'Error updating product!';
        }

        mysqli_stmt_close($stmt);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/productstyles.css">
</head>
<body>


<div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($connection, "SELECT * FROM product WHERE product_id = '$product_id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">update the product</h3>
      <input type="text" class="box" name="product_name" value="<?php echo $row['product_name']; ?>" placeholder="enter the product name">
      <input type="text" class="box" name="description" value="<?php echo $row['description']; ?>" placeholder="enter the product description">
	   <div class="box">
		   <label> <h5>Category: </h5> </label>
			<select   name="category" required>            
			<option> <?php echo $row['category']; ?></option>
			<option>Electronics </option>
			<option>Kitchen Equipment</option>
			<option>Health Tools</option>
			<option>Servicing Tools</option>
			<option>Farming Tools</option>			  
			</select> </div>
			
			<div class="box">
		   <label> <h5>Status: </h5> </label>
			<select   name="status" required>            
			<option> <?php echo $row['status']; ?></option>
			<option>Avilable </option>
			<option>Hide</option>
			<option>Borrow</option>
						  
			</select> </div>
      <input type="file" class="box" name="product_image"  accept="image/png, image/jpeg, image/jpg"  placeholder="enter the product image">
      <input type="submit" value="update product" name="update_product" class="btn">
      <a href="uploaded_product.php" class="btn">go back!</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>