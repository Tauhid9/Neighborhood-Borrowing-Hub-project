<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'hasan');

if (!$connection) {
    die("failed" . mysqli_error($connection));
}

if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'img/uploaded_product/' . $product_image;
}

if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];
    mysqli_query($connection, "DELETE FROM Product WHERE product_id = $product_id");
    header('location:uploaded_product.php');
}
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
                    <a type="button" class="btn btn-primary nav-link active" href="adminpage.php">Home</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php
        $u_id = $_SESSION['user_id'];
        $select = mysqli_query($connection, "SELECT * FROM product");
        ?>
		<h2><center>Product List</center> </h2>
        <div class="product-display">
            <table border='1' class="product-display-table">
                <thead>
                    <tr>
                        <th>Product id</th>
                        <th>User id</th>
                        <th>Product image</th>
                        <th>Product name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                    <tr>
                        <td><?php echo $row['product_id']; ?></td>
                        <td>
                            <!-- Add a link to view user details -->
                            <a href="#" class="btn btn-info">
                                <i class="fas fa-eye"></i> <?php echo $row['user_id']; ?>
                            </a>
                        </td>
                        <td><img src="img/uploaded_product/<?php echo $row['product_image']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>
                            <a href="admin_product_list.php?delete=<?php echo $row['product_id']; ?>" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
