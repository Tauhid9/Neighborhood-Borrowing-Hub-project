<?php
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
   $status= $_POST['status'];
   
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'img/uploaded_product/'.$product_image;

};
if(isset($_GET['delete'])){
   $product_id = $_GET['delete'];
   mysqli_query($connection, "DELETE FROM product WHERE product_id = $product_id");
   header('location:uploaded_product.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Uploaded Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/productstyles.css">

</head>
<body>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     
     
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav px-3">
            <li class="nav-item px-3">
              <a type="button" class="btn btn-primary nav-link active" href="userpage.php">Home</a>
            </li>
            <li class="nav-item px-3">
              <a type="button" class="btn btn-primary nav-link active" href="add_product.php">Add New</a>
            </li>
          </ul>
        </div>
      
    </nav>
   
<div class="container">


    <?php
	$u_id=$_SESSION['user_id'];

   $select = mysqli_query($connection, "SELECT * FROM product where user_id=$u_id");
   
   ?>
  <div class="product-display">
    <table class="product-display-table" style="border-collapse: collapse; width: 100%; border: 1px solid #ddd;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px;">Product id</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Product image</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Product name</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Category</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Description</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Status</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Action</th>
            </tr>
        </thead>
        <?php while($row = mysqli_fetch_assoc($select)){ ?>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $row['product_id']; ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;"><img src="img/uploaded_product/<?php echo $row['product_image']; ?>" height="100" alt=""></td>
                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $row['product_name']; ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $row['category']; ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $row['description']; ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo $row['status']; ?></td>
                <td style="border: 1px solid #ddd; padding: 8px;">
                    <a href="update_product.php?edit=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
                    <a href="uploaded_product.php?delete=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>


</div>


</body>
</html>