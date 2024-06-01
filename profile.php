<?php

$connection= mysqli_connect('localhost','root','','hasan');

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_GET['user_id']))
{
        $user_id = intval($_GET['user_id']);
        //We check if the user exists
        $sql = mysql_query('SELECT * FROM user WHERE user_id="'.$user_id.'"');
        if(mysql_num_rows($sql)>0)
        {
                $user = mysql_fetch_array($sql);
                //We display the user datas

     Update user information in the database.
    $query = "UPDATE user SET 
              image = '$image_path', 
              name = '$name', 
              email = '$email', 
              phone = '$phone', 
              address = '$address', 
              gender = '$gender', 
              religion = '$religion', 
              dob = '$dob' 
              WHERE id = $user_id";

    if (mysqli_query($connection, $query)) {
        // Redirect back to the profile page with a success message.
        header("Location: profile.html?message=Profile updated successfully");
    } else {
        // Handle the update error.
        echo "Error updating profile: " . mysqli_error($connection);
    } 
}
}

// Close the database connection.
mysqli_close($connection);
?>
