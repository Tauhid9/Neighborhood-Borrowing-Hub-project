<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'hasan');

if (!$connection) {
    die("failed" . mysqli_error($connection));
}
$product_id = $_GET['borrow'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the required fields are set in the $_POST array
        if (isset($_POST['why_need'], $_POST['borrowing_date'], $_POST['return_date'])) {
            $why_need = $_POST['why_need'];
            $borrowing_date = $_POST['borrowing_date'];
            $return_date = $_POST['return_date'];
            $borrower_id = $_SESSION['user_id'];

            // Insert data into the database
            $query = "INSERT INTO borrow VALUES ('NULL','$borrower_id', '$product_id', '$why_need', '$borrowing_date', '$return_date','Accept')";
            
            $result = mysqli_query($connection, $query);
			
			$sql="UPDATE product SET   status='Borrow' WHERE product_id = $product_id";
			$data = mysqli_query($connection, $sql);

            if ($result) {
                echo "Borrow request submitted successfully!";
            } else {
                echo "Error submitting borrow request: " . mysqli_error($connection);
            }
        } else {
            // Handle error if required fields are not set
            echo "Please fill out all required fields!";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            display: flex;
            align-items: left;
            justify-content: left;
            height: 10vh;
            background-color: #f8f9fa;
        }

        .container-left {
            width: 30%;
            text-align: center;
            padding: 30px;
        }

        .container-right {
            width: 70%;
            padding: 30px;
        }

        .card {
            margin-top: 20px;
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container-left">
	<?php 
	
	if (isset($_GET['borrow'])) {
    
    $query = "SELECT * FROM product INNER JOIN user ON product.user_id = user.user_id WHERE product_id = $product_id";
    $result = mysqli_query($connection, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $product_name = $row['product_name'];
        $category = $row['category'];
        $description = $row['description'];
        $product_image = $row['product_image'];
        $address = $row['address'];
        $phone = $row['phone'];
    } else {
        // Handle error if the product is not found
        echo "Product not found!";
        exit;
    }
} else {
    // Handle error if product_id is not provided in the URL
    echo "Product ID not provided!";
    exit;
}
	
	
	?>
        
        <a href="product_list.php" class="btn btn-primary mb-2">Back to Product List</a>
        <div class="card">
            <img src="img/uploaded_product/<?php echo $product_image; ?>" class="card-img-top" alt="<?php echo $product_name; ?>">
            <div class="card-body">
                <h5 class="card-title">Name: <?php echo $product_name; ?></h5>
                <p class="card-text">Category: <?php echo $category; ?></p>
                <p class="card-text">Description: <?php echo $description; ?></p>
                <p class="card-text">Location: <?php echo $address; ?></p>
            </div>
        </div>
    </div>
	
	

    <div class="container-right">
	
	
	
	<h1>Borrow This Product</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="why_need">Why do you need this product?</label>
                <textarea class="form-control" id="why_need" name="why_need" ></textarea>
            </div>
            <div class="form-group">
                <label for="borrowing_date">Borrowing Date</label>
                <input type="date" class="form-control" id="borrowing_date" name="borrowing_date" required>
            </div>
            <div class="form-group">
                <label for="borrowing_date">Return Date</label>
                <input type="date" class="form-control" id="borrowing_date" name="return_date" required>
            </div>
            <button type="submit" name="borrow" class="btn btn-success">Request</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
