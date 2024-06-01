<?php
session_start();
  $connection= mysqli_connect('localhost','root','','hasan'); //connecting the phpmyadmin database.

	if(!$connection)
	{
		die("failed". mysqli_error($connection));
	}
	

if(isset($_POST['borrow'])){

   $product_name = $_POST['product_name'];
   $address = $_POST['address'];
   $phone = $_POST['phone'];
   $borrowing_date = $_POST['borrowing_date'];
   $return_date = $_POST['return_date'];
   $request = $_POST['request'];
   
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'img/uploaded_product/'.$product_image;

};


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Borrowed List</title>
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
           
          </ul>
        </div>
      
    </nav>
   
<div class="container">


    <?php
	$borrower_id=$_SESSION['user_id'];
	
	 $query = "SELECT *
          FROM borrow
          JOIN product ON borrow.product_id = product.product_id
          JOIN user ON product.user_id = user.user_id
          WHERE borrower_id ='$borrower_id' AND borrow.request ='Accept' ";

$result = mysqli_query($connection, $query);

   
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
		    <th>Product id</th>
            <th>Product image</th>
            <th>Product name</th>
            <th>Address</th>
			<th>Phone</th>
            <th>Borrowing date</th>
            <th>Return date</th>
            <th>Request</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($result)){ ?>
         <tr>
		    <td><?php echo $row['product_id']; ?></td>
            <td><img src="img/uploaded_product/<?php echo $row['product_image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['address']; ?></td>
			<td><?php echo $row['phone']; ?></td>
			<td><?php echo $row['borrowing_date']; ?></td>
			<td><?php echo $row['return_date']; ?></td>
			
			<td style="background-color:green;">
            <b><font face="Arial, Helvetica, sans-serif"><?php echo $row['request']; ?></font></b>
        </td>
           
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>