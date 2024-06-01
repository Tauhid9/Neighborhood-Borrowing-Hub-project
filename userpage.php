<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css\userpage.css">
	
	
	<style>
    body {
        
    }
      .status-box {
        text-align: center;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color:#FFA07A; /* Set your desired background color */
        margin: 10px; /* Add margin for spacing */
    }

    .container-fluid {
        display: flex;
		padding:50px;
		
        justify-content: space-around; /* Align divs side by side */
    }
</style>
	
</head>
<body>
   
    <!-- First Navigation Bar for User Information -->
    <header class="py-5">
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
<hr >
    <!-- Second Navigation Bar for Navigation Links -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link px-5" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-5" href="userprofile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-5" href="product_list.php">Product List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-5" href="uploaded_product.php">Upload</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-5" href="borrow_list.php">Borrowing</a>
            </li>
        </ul>
    </nav>
	
	
	
	<div class="container-fluid">
        

		
		<div class="status-box px-3">
            <?php
            $connection = mysqli_connect('localhost', 'root', '', 'hasan');

            if (!$connection) {
                die("failed" . mysqli_error($connection));
            }
			$u_id=$_SESSION['user_id'];

            $sql = "SELECT COUNT(*) as total_rowsmp FROM product where user_id=$u_id";
            $result = mysqli_query($connection, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                echo "Number of My uploaded Product: " . $row['total_rowsmp'];
            } else {
                echo "Error: " . mysqli_error($connection);
            }

            mysqli_close($connection);
            ?>
        </div>
		
		<div class="status-box px-3">
            <?php
            $connection = mysqli_connect('localhost', 'root', '', 'hasan');

            if (!$connection) {
                die("failed" . mysqli_error($connection));
            }
			$u_id=$_SESSION['user_id'];

            $sql = "SELECT COUNT(*) as total_rowsbp FROM borrow where borrower_id=$u_id  AND request='Accept'";
            $result = mysqli_query($connection, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                echo "Number of Borrowed Product: " . $row['total_rowsbp'];
            } else {
                echo "Error: " . mysqli_error($connection);
            }

            mysqli_close($connection);
            ?>
        </div>
		
    </div>
   
    <!-- Content Goes Here -->

    <!-- Include Bootstrap JS (jQuery and Popper.js are required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
