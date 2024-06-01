<?php

$connection= mysqli_connect('localhost','root','','hasan');

// Check connection
if(!$connection)
	{
		die("failed". mysqli_error($connection));
	}
	
//  View User Data
$sql = "SELECT * FROM user";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // Display user data in an HTML table
	 echo "<a href='adminpage.php' >Home</a> ";
    echo '<table width="100%" border="1" cellpadding="5" cellspacing="0">';
	echo "  <caption>User List</caption>";
    echo '<tr bgcolor="#ddd"><th>User_ID</th><th>Name</th>
	<th>Email</th><th>Address</th> <th>Phone</th> <th>Gender</th>
	<th>Religion</th><th>Date of Birth</th><th> View </th><th> Delete </th></tr>';

    while ($row = $result->fetch_assoc()) {
		if($row['user_type']=='admin')
		{
			continue;
		}
       else{
		    echo "<tr>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
		echo "<td>" . $row['address'] . "</td>";
		echo "<td>" . $row['phone'] . "</td>";
		echo "<td>" . $row['gender'] . "</td>";
		echo "<td>" . $row['religoin'] . "</td>";
		echo "<td>" . $row['dob'] . "</td>";
		
        echo "<td><a href='userpage.php?id=" . $row['user_id'] . "'>View</a></td> ";
        echo "<td> <a href='#'>Delete</a> </td>";
            
        echo "</tr>";
	   }
    }
    echo "</table>";
	
	 
} else {
    echo "No users found.";
}

//  Delete User Data
// Create a "delete.php" file to handle delete actions

//  Update User Data
// Create an "edit.php" file to handle update actions

//  Close the database connection
$connection->close();
?>
