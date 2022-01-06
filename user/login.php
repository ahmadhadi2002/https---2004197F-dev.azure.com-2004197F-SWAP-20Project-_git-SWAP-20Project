<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['user_id'])) {
    header("Location: welcome.php");
    
}

if (ISSET($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password' AND status='1'";
    $result = mysqli_query($conn, $sql);
    if ($result -> num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['ID'];
        $_SESSION['user_role'] = $row['role'];
        $_SESSION['user_department'] = $row['department'];
        $_SESSION['user_name'] = $row['name'];
        header("Location: welcome.php");
        
    } else {
        echo "<script>alert('Error Logging In, please check that your account details are correct and verified')</script>";
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text">Login with email</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
        </form>
    </div>
</body>
</html>