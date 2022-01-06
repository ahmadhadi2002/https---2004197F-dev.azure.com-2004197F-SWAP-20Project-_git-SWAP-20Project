<?php 

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

include 'config.php';

if (isset($_POST["submit"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $contact = mysqli_real_escape_string($conn, $_POST["contact"]);
    
        if (isset($_FILES["photo"])) {
            $photo_name = $_FILES["photo"]["name"];
            $photo_tmp_name = $_FILES["photo"]["tmp_name"];
            $photo_size = $_FILES["photo"]["size"];
            $photo_new_name = rand() . $photo_name;
            
            if ($photo_size > 5242880) {
                echo "<script>alert('Please insert a photo that is below 5MB')</script>";
            } else {
                $sql = "UPDATE user SET name='$name', address='$address', contact='$contact', photo='$photo_new_name' WHERE ID='{$_SESSION['user_id']}'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>alert('Profile Update Succesful')</script>";
                    move_uploaded_file($photo_tmp_name, "uploads/" . $photo_new_name);
                    echo $conn->error;
                } else {
                    echo "<script>alert('Error Occurred, Update Unsuccessful')</script>";
                }
            }
        }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>
<body>
    <div>
    	<form action="" method="post" enctype="multipart/form-data">	
    		<?php 
    		
    		$sql = "SELECT * FROM user WHERE ID='{$_SESSION["user_id"]}'";
    		$result = mysqli_query($conn, $sql);
    		if (mysqli_num_rows($result) > 0) {
    		    while ($row = mysqli_fetch_assoc($result)) {
    		?>
    		
    		<div>
    			<label for="name">Name</label>
    			<input type="text" id="name" name="name" placeholder="Full Name" value="<?php echo $row['name']; ?>" required>
    		</div>
    		<div>
    			<label for="email">Email</label>
    			<input type="email" id="email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" disabled required>
    		</div>
    		<div>
    			<label for="password">Password</label>
    			<input type="password" id="password" name="password" placeholder="Password" value="<?php echo $row['password']; ?>" disabled required>
    		</div>
    		<div>
    			<label for="address">Address</label>
    			<input type="text" id="address" name="address"  placeholder="Address" value="<?php echo $row['address']; ?>"" required>
    		</div>
    		<div>
    			<label for="contact">Phone Number</label>
    			<input type="tel" id="contact" name="contact" placeholder="Phone Number" value="<?php echo $row['contact']; ?>" required>
    		</div>
    		<div>
    			<label for="photo">Photo</label>
    			<input type="file" accept="image/*" id="photo" name="photo">
    		</div>
    		<img src="uploads/<?php echo $row["photo"]; ?>" width="150px" height="auto" alt="">
    		        
    		<?php
    		
    		    }
    		}
    		
    		?>
    		
    		<div>
    			<button type="submit" name="submit" >Update Profile</button>
    		</div>
    		<a href="delete.php">Delete Account</a>
    		<a href="logout.php">Logout</a>
    		<a href="changepassword.php">Change Password</a> 
    		<br> <br>
    		<table>
    		<tr>
    <th><button class="editbtn" formaction="/project/plan&comment/index.php">Task planner</button></td></tr>
    <tr><th><button class='editbtn' formaction='/project/projectdelon/manage_users_new.php' >Roles allocation</button> </td></tr>

    <th><button class="editbtn" formaction="/project/announcement/show.php">Announcement</button></td></tr>
<tr>
</table>
    		
    	</form>
    </div>
</body>
</html>