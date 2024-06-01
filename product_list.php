<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'hasan');

if (!$connection) {
    die("failed" . mysqli_error($connection));
}

if (isset($_POST['upload_product'])) {
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'img/uploaded_product/' . $product_image;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add a CSS rule to set a fixed height for the card images */
        .card-img-top {
            height: 200px; /* Adjust the height as needed */
            object-fit: cover; /* This ensures the image scales and maintains its aspect ratio */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Product List</h1>
        <a href="userpage.php" class="btn btn-primary mb-2">Home</a>
        <div class="row">
            <?php
            $u_id = $_SESSION['user_id'];
            $query = "SELECT * FROM product INNER JOIN user ON product.user_id = user.user_id  where status='Avilable' AND user.user_id !=$u_id";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col-md-4 mb-4'>
                        <div class='card'>
                            <div class='card-body'>
                                <img src='img/uploaded_product/{$row['product_image']}' class='card-img-top' alt='{$row['product_name']}'>
                                <h5 class='card-title mt-2'>Name: {$row['product_name']}</h5>
                                <p class='card-text'>Location: {$row['address']}</p>
                                <a href='borrow_product.php?borrow={$row['product_id']}' class='btn btn-primary'>Borrow</a>
                            </div>
                        </div>
                    </div>";
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
