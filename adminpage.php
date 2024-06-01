<?php
session_start();

if(!isset($_SESSION["user_id"]))
{
	 
	header('location:login.php');
}
    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom CSS styles -->
    <link rel="stylesheet" href="css\adminpage.css">
	
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
    <hr >
    <!-- Second Navigation Bar for Navigation Links -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link px-3" " href="#">Home</a>
            </li>
            <li class="nav-item">
                <a  class="nav-link px-3" href="adminprofile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3"  href="admin_product_list.php">Item List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-3"  href="user_list.php">User List</a>
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

            $sql = "SELECT COUNT(*) as total_rows FROM user where user_type='user'";
            $result = mysqli_query($connection, $sql);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                echo "Number of Users: " . $row['total_rows'];
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

            $sql2 = "SELECT COUNT(*) as total_rowsp FROM product";
            $data = mysqli_query($connection, $sql2);

            if ($data) {
                $row1 = mysqli_fetch_assoc($data);
                echo "Number of Products: " . $row1['total_rowsp'];
            } else {
                echo "Error: " . mysqli_error($connection);
            }
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
