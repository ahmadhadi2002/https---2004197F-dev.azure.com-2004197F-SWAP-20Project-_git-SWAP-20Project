<?php 

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please Sign In First')</script>";
    header("Location: login.php");
}

include 'config.php';

if (isset($_POST["submit"])) {
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
    $cfmpassword = mysqli_real_escape_string($conn, md5($_POST["cfmpassword"]));
    
    if ($password === $cfmpassword) {

                $sql = "UPDATE user SET password='$password' WHERE ID='{$_SESSION['user_id']}'";
                $result = mysqli_query($conn, $sql);
                echo "<script>alert('Password successful change')</script>";
    }
     else {
        echo "<script>alert('Password does not match')</script>";
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
    			<label for="password">Password</label>
    			<input type="password" id="password" name="password" placeholder="Password" required>
    		</div>
    		<div>
    			<label for="cfmpassword">Confirm Password</label>
    			<input type="password" id="cfmpassword" name="cfmpassword" placeholder="Confirm Password"  required>
    		</div>
    	
    		<?php
    		
    		    }
    		}
    		
    		?>
    		
    		<div>
    			<button type="submit" name="submit" >Update Profile</button>
    		</div>
    		<a href="delete.php">Delete Account</a>
    		<a href="logout.php">Logout</a>
    		<a href="welcome.php">Back</a>
    	</form>
    </div>
</body>
</html>